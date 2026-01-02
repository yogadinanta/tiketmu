<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventOrder;
use Illuminate\Support\Facades\Auth;

class ScanTiketController extends Controller
{
public function index()
{
    $vendor = Auth::user();

    $scans = EventOrder::whereNotNull('scanned_at')
        ->whereHas('event', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })
        ->with('event')
        ->latest('scanned_at')
        ->take(20)
        ->get();

    return view('vendor.scan.index', compact('scans'));
}


    public function scan(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string'
        ]);

        $vendor = Auth::user();

        // pastikan yang login adalah vendor
        if ($vendor->role !== 'vendor') {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak'
            ], 403);
        }

        // CEK ORDER TIKET EVENT
        $order = EventOrder::where('order_id', $request->order_id)
            ->whereHas('event', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->id);
            })
            ->with('event')
            ->first();

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket tidak ditemukan atau bukan milik event Anda'
            ], 404);
        }

        if ($order->status !== 'paid') {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket belum dibayar'
            ], 403);
        }

        if ($order->scanned_at) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket sudah digunakan'
            ], 409);
        }

        // UPDATE SCAN
        $order->update([
            'scanned_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tiket valid, selamat datang!',
            'data' => [
                'order_id' => $order->order_id,
                'event' => $order->event->title,
                'time' => now()->format('d M Y H:i')
            ]
        ]);
    }
}
