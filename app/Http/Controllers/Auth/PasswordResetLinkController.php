<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpVerificationMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset request dengan OTP.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ], [
            'g-recaptcha-response.required' => 'Silakan verifikasi reCAPTCHA.',
            'g-recaptcha-response.recaptcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
        }

        // Generate OTP
        $otpCode = $user->generateOtp();

        // Send OTP ke email
        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email', ['error' => $e->getMessage()]);
            return back()->withErrors(['email' => 'Gagal mengirim OTP ke email. Silakan coba lagi.']);
        }

        // Store email di session untuk verifikasi OTP
        session()->put('reset_email', $request->email);

        return redirect()->route('password.verify-otp')
                        ->with('status', 'OTP telah dikirim ke email Anda. Silakan cek email untuk kode OTP.');
    }
}
