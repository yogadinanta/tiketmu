<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    /**
     * Halaman deposit vendor
     */
    public function index()
    {
        $deposits = Deposit::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('vendor.deposit.index', compact('deposits'));
    }

    /**
     * Generate Snap Token Midtrans
     */
    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|integer|min:10000|max:10000000',
        ]);

        $nominal = (int) $request->nominal;

        // ================= SIMPAN DEPOSIT =================
        $deposit = Deposit::create([
            'user_id' => auth()->id(),
            'nominal' => $nominal,
            'status' => 'pending',
        ]);

        // ================= ORDER ID =================
        $orderId = 'TOPUP-' . $deposit->id . '-' . time();
        $deposit->update(['order_id' => $orderId]);

        // ================= KONFIGURASI MIDTRANS =================
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // DEV ONLY
        if (!Config::$isProduction) {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
            ];
        }

        // ================= PARAMETER SNAP =================
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $nominal,
            ],
            'item_details' => [[
                'id' => 'DEP-' . $deposit->id,
                'price' => $nominal,
                'quantity' => 1,
                'name' => 'Deposit Saldo',
            ]],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => '08123456789',
            ],
        ];

        Log::info('MIDTRANS SNAP PARAMS', $params);

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            Log::error('MIDTRANS SNAP ERROR', [
                'message' => $e->getMessage(),
                'order_id' => $orderId,
            ]);

            $deposit->update(['status' => 'failed']);

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi',
            ], 500);
        }
    }

    /**
     * CALLBACK MIDTRANS
     * INI YANG MENENTUKAN STATUS & SALDO
     */
    public function callback(Request $request)
    {
        Log::info('MIDTRANS CALLBACK MASUK', $request->all());

        // ================= VALIDASI SIGNATURE =================
        $serverKey = config('midtrans.server_key');

        $signatureKey = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signatureKey !== $request->signature_key) {
            Log::warning('SIGNATURE KEY TIDAK VALID');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // ================= CARI DEPOSIT =================
        $deposit = Deposit::where('order_id', $request->order_id)->first();

        if (!$deposit) {
            Log::warning('ORDER ID TIDAK DITEMUKAN');
            return response()->json(['message' => 'Order not found'], 404);
        }

        // ================= CEGAH DOUBLE CALLBACK =================
        if ($deposit->status === 'success') {
            Log::info('CALLBACK SUDAH DIPROSES SEBELUMNYA');
            return response()->json(['message' => 'Already processed']);
        }

        // ================= STATUS BERHASIL =================
        if (in_array($request->transaction_status, ['settlement', 'capture'])) {

            DB::transaction(function () use ($deposit, $request) {

                // Update status deposit
                $deposit->update([
                    'status' => 'success',
                    'payload' => json_encode($request->all()),
                ]);

                // Tambah saldo user
                $user = User::find($deposit->user_id);
                $user->increment('saldo', $deposit->nominal);
            });

            Log::info('DEPOSIT BERHASIL & SALDO DITAMBAHKAN');
        }

        // ================= STATUS GAGAL =================
        if (in_array($request->transaction_status, ['expire', 'cancel', 'deny'])) {
            $deposit->update([
                'status' => 'failed',
                'payload' => json_encode($request->all()),
            ]);

            Log::info('DEPOSIT GAGAL / EXPIRE');
        }

        return response()->json(['message' => 'OK']);
    }
}
