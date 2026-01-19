<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    // Tampilkan form verifikasi OTP
    public function showVerificationForm()
    {
        return view('auth.verify-otp');
    }

    // Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|size:6'
        ]);

        // Cek apakah ini dari register atau login
        $user = Auth::check() ? Auth::user() : null;
        $userId = $user ? $user->id : session('otp_user_id');

        if (!$userId) {
            return redirect('/login')->with('error', 'Silakan login atau register terlebih dahulu.');
        }

        $user = $user ?? User::find($userId);

        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan.');
        }

        if (!$user->isOtpValid()) {
            return redirect('/verify-otp')->with('error', 'Kode OTP telah kadaluarsa. Silakan request OTP baru.');
        }

        if ($user->otp_code !== $request->otp_code) {
            return redirect('/verify-otp')->with('error', 'Kode OTP tidak valid.');
        }

        // Verifikasi berhasil
        $user->update([
            'is_verified' => true,
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        // Jika dari register (belum login), redirect ke login
        if (!Auth::check()) {
            session()->forget(['otp_code', 'otp_email', 'otp_user_id']);
            return redirect('/login')->with('success', 'Verifikasi berhasil! Silakan login dengan akun Anda.');
        }

        // Jika dari login, redirect ke dashboard
        return redirect('/dashboard')->with('success', 'Verifikasi berhasil! Selamat datang di Aplikasi BK.');
    }

    // Kirim ulang OTP
    public function resendOtp()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $otpCode = $user->generateOtp();

        // Kirim email OTP baru
        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
            
            return redirect('/verify-otp')->with('success', 'Kode OTP baru telah dikirim ke email Anda!');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email OTP: ' . $e->getMessage());
            return redirect('/verify-otp')->with('error', 'Gagal mengirim OTP. Silakan coba lagi.');
        }
    }
}