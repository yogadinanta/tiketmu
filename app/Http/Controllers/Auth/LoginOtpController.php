<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class LoginOtpController extends Controller
{
    public function verifyOtp(Request $request)
    {
        // Validasi OTP
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Email yang disimpan di session
        $email = session('verify_email');

        if (!$email) {
            return redirect()->route('login')->with('error', 'Sesi OTP hilang. Silakan login ulang.');
        }

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }

        // Cek OTP
        if ($user->otp != $request->otp) {
            return back()->with('error', 'OTP salah.');
        }

        // Cek OTP expired
        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'OTP sudah kadaluarsa.');
        }

        // Login jika OTP benar
        Auth::login($user);

        // Hapus OTP di database
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Hapus session OTP
        session()->forget('verify_email');

        // Redirect sesuai role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'vendor':
                return redirect()->route('vendor.dashboard');

            default:
                return redirect()->route('user.home');
        }
    }
}
