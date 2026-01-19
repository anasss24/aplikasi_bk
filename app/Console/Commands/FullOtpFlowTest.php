<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FullOtpFlowTest extends Command
{
    protected $signature = 'test:full-otp-flow';
    protected $description = 'Test complete OTP flow from start to finish';

    public function handle()
    {
        $this->info("========== FULL OTP FLOW TEST ==========\n");

        // Step 1: Request OTP
        $this->info("STEP 1: Request OTP (forgot-password POST)");
        $user = User::where('email', 'test@example.com')->first();
        
        if (!$user) {
            $this->error("Test user not found!");
            return;
        }
        
        $this->info("  User: {$user->name} ({$user->email})");
        
        // Generate OTP (what PasswordResetLinkController::store() does)
        $otpCode = $user->generateOtp();
        $this->info("  ✓ OTP Generated: {$otpCode}");
        
        // Simulate session
        session()->put('reset_email', $user->email);
        $this->info("  ✓ Session: reset_email = {$user->email}");
        
        // Step 2: User enters OTP code
        $this->info("\nSTEP 2: User enters OTP code on verify-otp-reset form");
        $userEnteredOtp = $otpCode; // User enters the correct OTP
        $this->info("  User entered: {$userEnteredOtp}");
        
        // Verify OTP (what OtpPasswordResetController::verifyOtp() does)
        $emailFromSession = session('reset_email');
        $userFromDb = User::where('email', $emailFromSession)->first();
        
        $this->info("  Email from session: {$emailFromSession}");
        $this->info("  User from DB: {$userFromDb->email}");
        
        if ($userFromDb->isOtpValid($userEnteredOtp)) {
            $this->info("  ✓ OTP is VALID");
            session()->put('reset_otp_verified', true);
            session()->put('reset_user_id', $userFromDb->id);
            $this->info("  ✓ Session: reset_otp_verified = true");
            $this->info("  ✓ Session: reset_user_id = {$userFromDb->id}");
        } else {
            $this->error("  ✗ OTP is INVALID");
            return;
        }
        
        // Step 3: User resets password
        $this->info("\nSTEP 3: User enters new password on reset-password-otp form");
        
        if (!session('reset_otp_verified')) {
            $this->error("  ✗ Session reset_otp_verified not found!");
            return;
        }
        
        $userId = session('reset_user_id');
        $newPassword = 'newpassword123';
        $this->info("  New password: {$newPassword}");
        
        $userToUpdate = User::find($userId);
        if (!$userToUpdate) {
            $this->error("  ✗ User not found for ID: {$userId}");
            return;
        }
        
        $userToUpdate->update([
            'password' => Hash::make($newPassword),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
        
        $this->info("  ✓ Password updated");
        $this->info("  ✓ OTP cleared");
        
        // Clear session
        session()->forget(['reset_email', 'reset_otp_verified', 'reset_user_id']);
        $this->info("  ✓ Session cleared");
        
        // Step 4: Try to login with new password
        $this->info("\nSTEP 4: Test login with new password");
        $authAttempt = auth('web')->attempt([
            'email' => $userToUpdate->email,
            'password' => $newPassword,
        ]);
        
        if ($authAttempt) {
            $this->info("  ✓ Login with new password: SUCCESS");
            auth('web')->logout();
        } else {
            $this->error("  ✗ Login with new password: FAILED");
        }
        
        // Try with old password (should fail)
        $authAttemptOld = auth('web')->attempt([
            'email' => $userToUpdate->email,
            'password' => 'password123',
        ]);
        
        if (!$authAttemptOld) {
            $this->info("  ✓ Login with old password: CORRECTLY FAILED");
        } else {
            $this->error("  ✗ Login with old password: SHOULD HAVE FAILED");
            auth('web')->logout();
        }
        
        $this->info("\n========== TEST COMPLETE ==========");
    }
}
