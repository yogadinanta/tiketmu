<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\SendOtpMail;

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
     * Proses login tahap 1 (cek email & password, lalu kirim OTP)
     */
    public function loginPost(Request $request)
    {
        // Validasi form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Auth::validate(['email' => $request->email, 'password' => $request->password])) {
            return back()->with('error', 'Email atau password salah.');
        }

        // Generate OTP 6 angka
        $otp = rand(100000, 999999);

        // Simpan OTP + masa berlaku 5 menit
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Kirim OTP ke email user
        Mail::to($user->email)->send(new SendOtpMail($otp));

        // Simpan email ke session untuk proses verifikasi
        session(['verify_email' => $user->email]);

        return redirect()
            ->route('otp.verify.page')
            ->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    /**
     * Verifikasi kode OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        // Ambil email dari session
        $email = session('verify_email');

        if (!$email) {
            return redirect()->route('login')->with('error', 'Session OTP hilang. Silakan login ulang.');
        }

        // Ambil user
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }

        // Cek OTP benar & belum expired
        if ($user->otp != $request->otp) {
            return back()->with('error', 'Kode OTP salah.');
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'Kode OTP sudah kadaluarsa.');
        }

        // Hapus OTP setelah berhasil
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Login user
        Auth::login($user);
        session()->forget('verify_email');

        // Arahkan berdasarkan role
        $role = $user->role ?? 'user';

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'vendor':
                return redirect()->route('vendor.dashboard');
            default:
                return redirect()->route('user.home');
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Anda telah logout.');
    }
}
