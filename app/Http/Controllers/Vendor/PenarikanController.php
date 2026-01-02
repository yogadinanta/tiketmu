<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penarikan;

class PenarikanController extends Controller
{
    /**
     * Halaman penarikan vendor
     */
    public function index()
    {
        $user = auth()->user();

        return view('vendor.penarikan.index', [
            'saldo' => $user->saldo,
            'penarikans' => Penarikan::where('user_id', $user->id)
                ->latest()
                ->get()
        ]);
    }

    /**
     * Simpan pengajuan penarikan
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'jumlah'       => 'required|numeric|min:10000',
            'bank'         => 'required|string|max:100',
            'no_rekening'  => 'required|string|min:6|max:20',
        ]);

        // Cek saldo cukup
        if ($request->jumlah > $user->saldo) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }

        DB::transaction(function () use ($request, $user) {

            // Simpan penarikan
            Penarikan::create([
                'user_id'      => $user->id,
                'jumlah'       => $request->jumlah,
                'bank'         => $request->bank,
                'no_rekening'  => $request->no_rekening,
                'status'       => 'diproses',
                'refunded'     => false,
            ]);

            // Potong saldo
            $user->decrement('saldo', $request->jumlah);
        });

        return redirect()
            ->route('vendor.penarikan.index')
            ->with('success', 'Pengajuan penarikan berhasil dikirim.');
    }

    /**
     * Tolak penarikan (ADMIN)
     */
    public function reject($id)
    {
        $penarikan = Penarikan::with('user')->findOrFail($id);

        // Hanya bisa ditolak jika masih diproses
        if ($penarikan->status !== 'diproses') {
            return back()->with('error', 'Penarikan sudah diproses.');
        }

        DB::transaction(function () use ($penarikan) {

            // Update status
            $penarikan->update([
                'status' => 'ditolak',
            ]);

            // Refund saldo (anti double refund)
            if (!$penarikan->refunded) {
                $penarikan->user->increment('saldo', $penarikan->jumlah);

                $penarikan->update([
                    'refunded' => true,
                ]);
            }
        });

        return back()->with('success', 'Penarikan ditolak & saldo dikembalikan.');
    }
}
