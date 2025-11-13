<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaldoHistory;

class VendorHistoryController extends Controller
{
    public function index()
    {
        // Ambil riwayat saldo milik vendor yang login
        $histories = SaldoHistory::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.layouts.history', compact('histories'));
    }
}
