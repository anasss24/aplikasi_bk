<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_verified' => false,  // Belum verified, harus verifikasi OTP dulu
            'role' => 'siswa'  // Default role untuk register adalah siswa
        ]);

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        
        Log::info('User created for registration: ' . $user->email);

        // Generate OTP dan simpan ke database
        $otpCode = $user->generateOtp();
        session(['otp_code' => $otpCode, 'otp_email' => $user->email, 'otp_user_id' => $user->id]);
        
        Log::info('OTP generated and session created: ' . $otpCode . ' for user: ' . $user->id);

        // Kirim OTP via email
        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
            
            Log::info('Email OTP sent successfully to: ' . $user->email);
            
            return redirect('/verify-otp')->with([
                'success' => 'Pendaftaran berhasil! Kode OTP telah dikirim ke email Anda.',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email OTP saat registrasi: ' . $e->getMessage());
            
            Log::info('Redirecting to /verify-otp with warning for user: ' . $user->id);
            
            return redirect('/verify-otp')->with([
                'warning' => 'Pendaftaran berhasil, tetapi gagal mengirim email OTP. Silakan minta ulang OTP.',
            ]);
        }
    }
}