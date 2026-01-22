<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Mail\OtpVerificationMail;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';
    protected $username = 'email';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ], [
            'g-recaptcha-response.required' => 'Silakan verifikasi reCAPTCHA.',
            'g-recaptcha-response.recaptcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Override sendLoginResponse untuk cek verifikasi OTP sebelum masuk dashboard
     * Method ini dipanggil saat user berhasil authenticate
     */
    protected function sendLoginResponse(Request $request)
    {
        $user = Auth::user();
        
        Log::info('User login attempt: ' . $user->email . ', is_verified: ' . (int)$user->is_verified);
        
        // Cek jika user belum verifikasi OTP
        if (!$user->is_verified) {
            Log::info('User belum verified, logout dan redirect ke verify-otp');
            
            Auth::logout();
            
            // Generate OTP baru
            $otpCode = $user->generateOtp();
            session(['otp_code' => $otpCode, 'otp_email' => $user->email, 'otp_user_id' => $user->id]);
            
            Log::info('OTP generated for login: ' . $otpCode);
            
            // Kirim OTP via email
            try {
                Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
                Log::info('Email OTP sent for login');
                
                return redirect('/verify-otp')->with([
                    'success' => 'Kode OTP telah dikirim ke email Anda. Silakan verifikasi akun Anda.',
                ]);
            } catch (\Exception $e) {
                Log::error('Gagal mengirim email OTP saat login: ' . $e->getMessage());
                
                return redirect('/verify-otp')->with([
                    'warning' => 'OTP telah di-generate tetapi gagal mengirim email. Silakan minta ulang OTP.',
                ]);
            }
        }
        
        Log::info('User verified, proceeding to dashboard');
        
        // User sudah verified, lanjutkan login normal
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    // Override redirectPath untuk role-based redirect
    protected function redirectPath()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return '/dashboard';
        } elseif ($user->role === 'guru_bk') {
            return '/dashboard';
        } else {
            return '/dashboard';
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}