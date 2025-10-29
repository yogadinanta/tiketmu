<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman form register
     */
    public function show()
    {
        return view('auth.register'); // pastikan resources/views/auth/register.blade.php ada
    }

    /**
     * Proses register user baru
     */
    public function register(Request $request)
    {
        // 1️⃣ Debug awal (hapus nanti)
        // dd($request->all());

        // 2️⃣ Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'agree_terms' => 'accepted',
        ]);

        // 3️⃣ Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // hash password
            'role' => 'user', // default role
        ]);

        // 4️⃣ Debug user tersimpan (hapus kalau sudah yakin)
        // dd($user);

        // 5️⃣ Auto-login user baru
        Auth::login($user);

        // 6️⃣ Redirect ke halaman utama atau dashboard
        return redirect()->route('screen')->with('success', 'Akun berhasil dibuat dan login.');
    }
}
