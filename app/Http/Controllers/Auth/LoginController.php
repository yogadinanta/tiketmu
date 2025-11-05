<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input form login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah user memilih "ingat saya"
        $remember = $request->filled('remember');

        // Coba login
        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi sesi agar lebih aman (hindari session fixation)
            $request->session()->regenerate();

            // Arahkan berdasarkan role user
            $role = Auth::user()->role ?? 'user'; // fallback jika null

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'vendor':
                    return redirect()->route('vendor.dashboard');
                default:
                    return redirect()->route('user.home');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus sesi dan token agar tidak bisa digunakan lagi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah logout.');
    }
}
