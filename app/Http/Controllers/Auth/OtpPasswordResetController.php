<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpVerificationMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpPasswordResetController extends Controller
{
    /**
     * Show the OTP verification form for password reset
     */
    public function showOtpForm(): RedirectResponse|View
    {
        $email = session('reset_email');
        
        if (!$email) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp-reset', ['email' => $email]);
    }

    /**
     * Verify OTP and show reset password form
     */
    public function verifyOtp(Request $request): RedirectResponse|View
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $email = session('reset_email');
        
        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                           ->withErrors(['email' => 'User tidak ditemukan.']);
        }

        // Validate OTP code dan check expiration
        if (!$user->isOtpValid($request->otp_code)) {
            return back()->withErrors(['otp_code' => 'Kode OTP tidak valid atau telah kadaluarsa. Silakan request OTP baru.']);
        }

        // OTP valid, store in session untuk digunakan di form reset password
        session()->put('reset_otp_verified', true);
        session()->put('reset_user_id', $user->id);

        return view('auth.reset-password-otp', ['email' => $email]);
    }

    /**
     * Update password setelah OTP verified
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        // Validate session
        if (!session('reset_otp_verified')) {
            return redirect()->route('password.request')
                           ->withErrors(['error' => 'Silakan verifikasi OTP terlebih dahulu.']);
        }

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userId = session('reset_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('password.request')
                           ->withErrors(['error' => 'User tidak ditemukan.']);
        }

        // Update password dan clear OTP
        $user->update([
            'password' => Hash::make($request->password),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Clear session
        session()->forget(['reset_email', 'reset_otp_verified', 'reset_user_id']);

        return redirect()->route('login')
                       ->with('status', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
    }

    /**
     * Resend OTP untuk reset password
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                           ->withErrors(['email' => 'User tidak ditemukan.']);
        }

        // Generate new OTP
        $otpCode = $user->generateOtp();

        // Send OTP ke email
        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengirim ulang OTP. Silakan coba lagi.']);
        }

        return back()->with('status', 'OTP baru telah dikirim ke email Anda.');
    }
}
