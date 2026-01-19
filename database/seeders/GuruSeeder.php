<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $gurus = [
            [
                'nip' => '196510051990031002',
                'nama_guru' => 'Dr. Surya Adi, M.Pd.',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Sidoarjo',
                'tanggal_lahir' => '1965-10-05',
                'alamat' => 'Jl. Pendidikan No. 123 Sidoarjo',
                'no_telepon' => '081234567890',
                'email' => 'surya.adi@smkantartika1.sch.id',
                'jabatan' => 'kepala_sekolah'
            ],
            [
                'nip' => '197803152005012001',
                'nama_guru' => 'Diana Sari, S.Pd., M.Psi.',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1978-03-15',
                'alamat' => 'Jl. Merpati No. 45 Sidoarjo',
                'no_telepon' => '081234567891',
                'email' => 'diana.sari@smkantartika1.sch.id',
                'jabatan' => 'konselor'
            ],
            [
                'nip' => '198204102008011002',
                'nama_guru' => 'Budi Santoso, S.Kom.',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Sidoarjo',
                'tanggal_lahir' => '1982-04-10',
                'alamat' => 'Jl. Teknologi No. 67 Sidoarjo',
                'no_telepon' => '081234567892',
                'email' => 'budi.santoso@smkantartika1.sch.id',
                'jabatan' => 'guru'
            ],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }
    }
}