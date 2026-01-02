<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\EventOrder;

class VendorOrderController extends Controller
{
    public function index()
    {
        $vendorId = auth()->id(); // 🔥 vendor = user login

        $orders = EventOrder::with(['user', 'event'])
            ->whereHas('event', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->latest()
            ->paginate(10);

        return view('vendor.orders.index', compact('orders'));
    }
}
