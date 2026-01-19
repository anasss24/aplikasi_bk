<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DebugForgotPassword extends Command
{
    protected $signature = 'debug:forgot-password {email?}';
    protected $description = 'Debug forgot password flow';

    public function handle()
    {
        $email = $this->argument('email') ?? 'test@example.com';
        
        $this->info("=== DEBUG FORGOT PASSWORD FLOW ===\n");
        
        // 1. Check user exists
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("❌ User not found: {$email}");
            return;
        }
        $this->info("✓ User found: {$email}");
        
        // 2. Generate OTP
        $otpCode = $user->generateOtp();
        $this->info("✓ OTP Generated: {$otpCode}");
        
        // 3. Check OTP in database
        $user->refresh();
        $this->info("✓ OTP in DB: {$user->otp_code}");
        $this->info("✓ OTP Expires: {$user->otp_expires_at}");
        $this->info("✓ OTP Valid: " . ($user->isOtpValid() ? 'YES' : 'NO'));
        
        // 4. Test session
        \Illuminate\Support\Facades\Session::put('reset_email', $email);
        $this->info("✓ Session set: reset_email = {$email}");
        
        $sessionEmail = \Illuminate\Support\Facades\Session::get('reset_email');
        $this->info("✓ Session get: reset_email = {$sessionEmail}");
        
        if ($sessionEmail === $email) {
            $this->info("✓✓ SESSION WORKS!");
        } else {
            $this->error("❌ SESSION PROBLEM");
        }
        
        // 5. Test redirect
        $this->info("\n✓ To test flow:");
        $this->info("   1. Go to /forgot-password");
        $this->info("   2. Enter: {$email}");
        $this->info("   3. You should see verify OTP page");
        $this->info("   4. Enter OTP: {$otpCode}");
        $this->info("   5. You should see password reset form");
        $this->info("   6. Set new password");
        $this->info("\n=== END DEBUG ===");
    }
}
