<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Topup;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('MIDTRANS CALLBACK MASUK', $request->all());

        $orderId = $request->order_id;
        $status  = $request->transaction_status;

        $topup = Topup::where('order_id', $orderId)->first();

        if (!$topup) {
            Log::warning('Order ID tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        if (in_array($status, ['settlement', 'capture'])) {
            $topup->status = 'success';
        } elseif ($status === 'expire') {
            $topup->status = 'expired';
        } elseif ($status === 'cancel') {
            $topup->status = 'cancel';
        }

        $topup->save();

        return response()->json(['message' => 'OK']);
    }
}
