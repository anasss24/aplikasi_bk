<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SimulateForgotPasswordPost extends Command
{
    protected $signature = 'test:forgot-password-post';
    protected $description = 'Simulate the forgot password POST request';

    public function handle()
    {
        $this->info('========== Simulating Forgot Password POST ==========');
        
        // Get the test user
        $user = User::where('email', 'test@example.com')->first();
        
        if (!$user) {
            $this->error('Test user not found!');
            return;
        }
        
        $this->info("User: {$user->name} ({$user->email})");
        
        // Simulate what PasswordResetLinkController::store() does
        $this->info("\n1. Generating OTP...");
        $otpCode = $user->generateOtp();
        $this->info("   ✓ OTP Generated: {$otpCode}");
        $this->info("   ✓ OTP Expires: {$user->otp_expires_at}");
        
        // Check the OTP in database
        $dbUser = User::find($user->id);
        $this->info("\n2. Verifying OTP in database...");
        $this->info("   DB OTP: {$dbUser->otp_code}");
        $this->info("   DB Expires: {$dbUser->otp_expires_at}");
        
        // Simulate session storage
        $this->info("\n3. Simulating session storage...");
        session()->put('reset_email', $user->email);
        $this->info("   ✓ Session put: reset_email = {$user->email}");
        
        // Verify session
        $sessionEmail = session('reset_email');
        $this->info("   ✓ Session get: reset_email = {$sessionEmail}");
        
        // Test OTP validation
        $this->info("\n4. Testing OTP validation...");
        $isValid = $user->isOtpValid($otpCode);
        $this->info("   Is OTP '{$otpCode}' valid? " . ($isValid ? 'YES' : 'NO'));
        
        // Test with wrong OTP
        $wrongOtp = '000000';
        $isValidWrong = $user->isOtpValid($wrongOtp);
        $this->info("   Is OTP '{$wrongOtp}' valid? " . ($isValidWrong ? 'YES' : 'NO'));
        
        $this->info("\n========== Test Complete ==========");
    }
}
