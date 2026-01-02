<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\SaldoHistory;
use Illuminate\Support\Facades\Auth;

class VendorHistoryController extends Controller
{
    public function index()
    {
        $histories = SaldoHistory::with('deposit') // ambil relasi deposit
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('vendor.history.index', compact('histories'));
    }
}
