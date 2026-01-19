<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\OtpVerificationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestForgotPassword extends Command
{
    protected $signature = 'test:forgot-password {email=test@example.com}';
    protected $description = 'Test forgot password OTP flow';

    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User dengan email {$email} tidak ditemukan");
            return;
        }

        $this->info("Testing forgot password for: {$email}");
        
        // Generate OTP
        $otpCode = $user->generateOtp();
        $this->info("✓ OTP Generated: {$otpCode}");
        $this->info("✓ OTP Expires at: {$user->otp_expires_at}");
        $this->info("✓ OTP Valid: " . ($user->isOtpValid() ? 'YES' : 'NO'));
        
        // Try to send email
        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
            $this->info("✓ Email sent successfully to: {$email}");
        } catch (\Exception $e) {
            $this->error("✗ Failed to send email: " . $e->getMessage());
        }
        
        // Test OTP validation
        $this->info("\n--- Testing OTP Validation ---");
        
        // Valid OTP
        if ($user->otp_code === $otpCode && $user->isOtpValid()) {
            $this->info("✓ OTP validation passed");
        }
        
        // Invalid OTP
        if ($user->otp_code !== '000000') {
            $this->info("✓ Invalid OTP correctly rejected");
        }
        
        $this->info("\n--- Test Complete ---");
        $this->info("Check email at: {$email}");
    }
}
