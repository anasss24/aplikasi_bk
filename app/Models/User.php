<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'otp_code',
        'otp_expires_at',
        'is_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
            'is_verified' => 'boolean'
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Generate OTP code dan simpan ke database
     */
    public function generateOtp(): string
    {
        $otpCode = sprintf("%06d", mt_rand(1, 999999));

        $this->update([
            'otp_code' => $otpCode,
            'otp_expires_at' => now()->addMinutes(10)
        ]);

        return $otpCode;
    }

    /**
     * Check if OTP valid (matching code dan belum expired)
     */
    public function isOtpValid(string $otpCode): bool
    {
        return $this->otp_code === $otpCode && 
               $this->otp_expires_at && 
               $this->otp_expires_at->isFuture();
    }
}