<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        // Ambil semua vendor dari database
        $vendors = Vendor::all();

        // Kirim ke view 'kreator.blade.php'
        return view('kreator', compact('vendors'));
    }
}
