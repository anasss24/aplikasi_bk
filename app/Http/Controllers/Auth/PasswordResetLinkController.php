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
     * Handle an incoming password reset link request dengan OTP.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info('DEBUG: POST /forgot-password called', ['email' => $request->email]);
        
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        $user = User::where('email', $request->email)->first();
        \Log::info('DEBUG: User found', ['email' => $request->email, 'user_id' => $user?->id]);
        
        if (!$user) {
            \Log::warning('DEBUG: User not found', ['email' => $request->email]);
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
        }

        // Generate OTP
        $otpCode = $user->generateOtp();
        \Log::info('DEBUG: OTP generated', ['otp' => $otpCode, 'expires' => $user->otp_expires_at]);

        // Send OTP ke email
        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
            \Log::info('DEBUG: Email sent successfully');
        } catch (\Exception $e) {
            \Log::error('DEBUG: Email sending failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['email' => 'Gagal mengirim OTP ke email. Silakan coba lagi.']);
        }

        // Store email di session untuk verifikasi OTP
        session()->put('reset_email', $request->email);
        \Log::info('DEBUG: Session set', ['reset_email' => $request->email]);

        \Log::info('DEBUG: About to redirect to password.verify-otp');
        return redirect()->route('password.verify-otp')
                        ->with('status', 'OTP telah dikirim ke email Anda. Silakan cek email untuk kode OTP.');
    }
}
