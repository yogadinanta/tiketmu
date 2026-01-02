<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class TiketController extends Controller
{

    public function download(Request $request)
{
    $orderId = $request->query('order_id');

    $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();

    if (! $transaksi->isPaid()) {
        abort(403, 'Tiket belum dibayar');
    }

    $pdf = Pdf::loadView('vendor.tiket.pdf', [
        'transaksi' => $transaksi
    ])->setPaper('A4', 'portrait');

    return $pdf->download('E-Ticket-' . $transaksi->order_id . '.pdf');
}
    public function index(Request $request)
    {
        $orderId = $request->query('order_id');

        if (!$orderId) {
            abort(404);
        }

        $transaksi = Transaksi::where('order_id', $orderId)->firstOrFail();

        // Validasi status pembayaran
        if ($transaksi->status !== 'paid') {
            return redirect('/')
                ->with('error', 'Pembayaran belum selesai');
        }

        return view('vendor.tiket.index', compact('transaksi'));
    }
}
