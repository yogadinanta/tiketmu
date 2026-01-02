<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Deposit;
use App\Models\User;
use App\Models\EventOrder;

Route::post('/midtrans/callback', function (Request $request) {

    Log::info('MIDTRANS CALLBACK MASUK', $request->all());

    // ======================================================
    // VALIDASI SIGNATURE MIDTRANS
    // ======================================================
    $serverKey = config('services.midtrans.server_key');

    $signatureKey = hash(
        'sha512',
        $request->order_id .
        $request->status_code .
        $request->gross_amount .
        $serverKey
    );

    if ($signatureKey !== $request->signature_key) {
        Log::error('SIGNATURE MIDTRANS TIDAK VALID', [
            'order_id' => $request->order_id
        ]);

        return response()->json(['message' => 'Invalid signature'], 403);
    }

    // ======================================================
    // DEPOSIT (TOP UP SALDO)
    // ORDER ID: DEP-xxxx
    // ======================================================
    if (str_starts_with($request->order_id, 'DEP-')) {

        $deposit = Deposit::where('order_id', $request->order_id)->first();

        if (!$deposit) {
            Log::error('DEPOSIT TIDAK DITEMUKAN', [
                'order_id' => $request->order_id
            ]);
            return response()->json(['message' => 'Deposit not found'], 404);
        }

        // 🔒 Anti double callback
        if ($deposit->status === 'success') {
            Log::info('CALLBACK DEPOSIT DUPLIKAT', [
                'order_id' => $deposit->order_id
            ]);
            return response()->json(['message' => 'Already processed'], 200);
        }

        switch ($request->transaction_status) {

            case 'settlement':
            case 'capture':

                DB::transaction(function () use ($deposit, $request) {

                    $deposit->update([
                        'status'  => 'success',
                        'payload' => json_encode($request->all())
                    ]);

                    $user = User::where('id', $deposit->user_id)
                        ->lockForUpdate()
                        ->first();

                    $user->update([
                        'saldo' => $user->saldo + (float) $deposit->amount
                    ]);

                    Log::info('SALDO USER DITAMBAHKAN', [
                        'user_id' => $user->id,
                        'amount'  => $deposit->amount
                    ]);
                });
                break;

            case 'pending':
                $deposit->update([
                    'status'  => 'pending',
                    'payload' => json_encode($request->all())
                ]);
                break;

            default:
                $deposit->update([
                    'status'  => 'failed',
                    'payload' => json_encode($request->all())
                ]);
                break;
        }

        return response()->json(['message' => 'Deposit callback OK'], 200);
    }

    // ======================================================
    // EVENT / PEMBELIAN TIKET
    // ORDER ID: EVT-xxxx
    // ======================================================
    if (str_starts_with($request->order_id, 'EVT-')) {

        $order = EventOrder::where('order_id', $request->order_id)->first();

        if (!$order) {
            Log::error('EVENT ORDER TIDAK DITEMUKAN', [
                'order_id' => $request->order_id
            ]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 🔒 Anti double callback
        if ($order->status === 'paid') {
            Log::info('CALLBACK EVENT DUPLIKAT', [
                'order_id' => $order->order_id
            ]);
            return response()->json(['message' => 'Already paid'], 200);
        }

        switch ($request->transaction_status) {

            case 'settlement':
            case 'capture':
                $order->update([
                    'status'  => 'paid',
                    'payload' => json_encode($request->all())
                ]);
                break;

            case 'pending':
                $order->update([
                    'status'  => 'pending',
                    'payload' => json_encode($request->all())
                ]);
                break;

            default:
                $order->update([
                    'status'  => 'failed',
                    'payload' => json_encode($request->all())
                ]);
                break;
        }

        return response()->json(['message' => 'Event order callback OK'], 200);
    }

    // ======================================================
    // ORDER ID TIDAK DIKENAL
    // ======================================================
    Log::warning('ORDER ID MIDTRANS TIDAK DIKENAL', [
        'order_id' => $request->order_id
    ]);

    return response()->json(['message' => 'Unknown order type'], 400);
});
