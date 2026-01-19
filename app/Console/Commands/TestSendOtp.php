<?php

namespace App\Console\Commands;

use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestSendOtp extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'test:send-otp {email?}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Test mengirim OTP ke email';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $email = $this->argument('email') ?? 'admin@smkantartika1.sch.id';

    $this->info("Mengirim OTP ke: {$email}");

    // Cari user
    $user = User::where('email', $email)->first();

    if (!$user) {
      $this->error("User dengan email {$email} tidak ditemukan!");
      return 1;
    }

    // Generate OTP
    $otpCode = $user->generateOtp();

    // Kirim email
    try {
      Mail::to($user->email)->send(new OtpVerificationMail($otpCode, $user->name));
      $this->info("✓ Email OTP berhasil dikirim!");
      $this->line("Email: {$user->email}");
      $this->line("OTP Code: {$otpCode}");
      $this->line("OTP berlaku selama 10 menit");
      return 0;
    } catch (\Exception $e) {
      $this->error("✗ Gagal mengirim email: " . $e->getMessage());
      return 1;
    }
  }
}
