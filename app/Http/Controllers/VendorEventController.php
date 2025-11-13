<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class VendorEventController extends Controller
{
    public function index()
    {
        // Ambil semua event milik vendor yang login
        $events = Event::where('vendor_id', auth()->id())->get();

        // Kirim data ke view dashboard vendor
        return view('admin.dash-vendor', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $vendor = auth()->user();

        // ✅ Cek saldo vendor langsung dari tabel users
        if ($vendor->saldo < 10000) {
            return redirect()->back()->with('error', 'Saldo Anda tidak mencukupi untuk menambahkan event (minimal Rp10.000).');
        }

        // ✅ Upload gambar (jika ada)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        // ✅ Simpan event baru
        Event::create([
            'vendor_id'   => $vendor->id,
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        // ✅ Kurangi saldo vendor sebesar Rp10.000
        $vendor->saldo -= 10000;
        $vendor->save();

        // ✅ Catat ke tabel saldo_histories
        DB::table('saldo_histories')->insert([
            'user_id'     => $vendor->id,
            'amount'      => 10000,
            'type'        => 'kurang',
            'description' => 'Biaya pembuatan event baru: ' . $request->title,
            'created_at'  => now(),
        ]);

        return redirect()
            ->route('vendor.dashboard')
            ->with('success', 'Event berhasil ditambahkan! Saldo Anda dikurangi Rp10.000 dan tercatat di riwayat.');
    }

    
}
