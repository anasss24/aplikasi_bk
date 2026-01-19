<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GuruBK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruBKSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah email sudah ada
        $userExists = User::where('email', 'gurubk@gmail.com')->exists();

        if (!$userExists) {
            // Buat user guru BK
            $user = User::create([
                'name' => 'Guru BK',
                'email' => 'gurubk@gmail.com',
                'password' => Hash::make('gurubk123'),
                'role' => 'guru_bk',
                'is_verified' => true,
                'email_verified_at' => now(),
            ]);

            // Buat data guru BK
            GuruBK::create([
                'user_id' => $user->id,
                'nip' => '19800101200501001',
                'nama' => 'Guru BK',
            ]);

            $this->command->info("Guru BK created successfully!");
            $this->command->info("Email: gurubk@gmail.com");
            $this->command->info("Password: gurubk123");
        } else {
            $this->command->info("Guru BK with email 'gurubk@gmail.com' already exists!");
        }
    }
}
