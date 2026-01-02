<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventOrder;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class EventOrderController extends Controller
{
    public function buy(Request $request, Event $event)
    {
        // ✅ Validasi
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;
        $total    = $event->price * $quantity;

        // ✅ Generate Order ID
        $orderId = 'EVT-' . time() . '-' . auth()->id();

        // ✅ SIMPAN KE DATABASE (STATUS PENDING)
        $order = EventOrder::create([
            'user_id'     => auth()->id(),
            'event_id'    => $event->id,
            'order_id'    => $orderId,
             'quantity'  => 1, // 👈 WAJIB
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        // ✅ MIDTRANS CONFIG
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = false; // sandbox
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        // ✅ PARAMS MIDTRANS
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $total,
            ],
            'item_details' => [
                [
                    'id'       => $event->id,
                    'price'    => $event->price,
                    'quantity' => $quantity,
                    'name'     => $event->title,
                ],
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ],
        ];

        // ✅ SNAP TOKEN
        $snapToken = Snap::getSnapToken($params);

        return view('home.event-payment', compact('snapToken', 'order'));
    }
}
