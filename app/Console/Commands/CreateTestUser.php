<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateTestUser extends Command
{
    protected $signature = 'user:create-test {email=test@example.com} {password=password123}';
    protected $description = 'Create a test user for development';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        if (User::where('email', $email)->exists()) {
            $this->info("User with email {$email} already exists");
            return;
        }

        $user = User::factory()->create([
            'email' => $email,
            'password' => $password,
        ]);

        $this->info("Test user created successfully!");
        $this->info("Email: {$user->email}");
        $this->info("Password: {$password}");
    }
}
