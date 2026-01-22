<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Console\Command;

class MigrateExistingUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:existing-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate existing siswa users to siswa table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all siswa users yang belum punya record di tabel siswa
        $users = User::where('role', 'siswa')->get();

        $count = 0;

        foreach ($users as $user) {
            // Check apakah sudah ada siswa record
            if (!Siswa::where('user_id', $user->id)->exists()) {
                Siswa::create([
                    'user_id' => $user->id,
                    'nis' => 'NIS-' . $user->id,
                    'nisn' => 'NISN-' . $user->id,
                    'nama_siswa' => $user->name,
                    'jenis_kelamin' => 'L',
                    'tempat_lahir' => '-',
                    'tanggal_lahir' => now()->subYears(15),
                    'alamat' => '-',
                    'no_telepon' => '-',
                    'email' => $user->email,
                    'kelas_id' => 1,
                ]);
                $count++;
                $this->info("Created siswa record for: {$user->name} ({$user->email})");
            }
        }

        $this->info("\n✅ Migration completed! Total records created: {$count}");
    }
}
