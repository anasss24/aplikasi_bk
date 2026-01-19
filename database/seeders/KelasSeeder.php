<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            // RPL - Rekayasa Perangkat Lunak
            ['kode_kelas' => 'RPL-X', 'nama_kelas' => 'Rekayasa Perangkat Lunak 1', 'jurusan_id' => 1, 'tingkat' => 10],
            ['kode_kelas' => 'RPL-XI', 'nama_kelas' => 'Rekayasa Perangkat Lunak 2', 'jurusan_id' => 1, 'tingkat' => 11],
            ['kode_kelas' => 'RPL-XII', 'nama_kelas' => 'Rekayasa Perangkat Lunak 3', 'jurusan_id' => 1, 'tingkat' => 12],
            
            // TKR - Teknik Kendaraan Ringan
            ['kode_kelas' => 'TKR-X', 'nama_kelas' => 'Teknik Kendaraan Ringan 1', 'jurusan_id' => 2, 'tingkat' => 10],
            ['kode_kelas' => 'TKR-XI', 'nama_kelas' => 'Teknik Kendaraan Ringan 2', 'jurusan_id' => 2, 'tingkat' => 11],
            ['kode_kelas' => 'TKR-XII', 'nama_kelas' => 'Teknik Kendaraan Ringan 3', 'jurusan_id' => 2, 'tingkat' => 12],
            
            // TPM - Teknik Pemesinan
            ['kode_kelas' => 'TPM-X', 'nama_kelas' => 'Teknik Pemesinan 1', 'jurusan_id' => 3, 'tingkat' => 10],
            ['kode_kelas' => 'TPM-XI', 'nama_kelas' => 'Teknik Pemesinan 2', 'jurusan_id' => 3, 'tingkat' => 11],
            ['kode_kelas' => 'TPM-XII', 'nama_kelas' => 'Teknik Pemesinan 3', 'jurusan_id' => 3, 'tingkat' => 12],
            
            // TITL - Teknik Instalasi Tenaga Listrik
            ['kode_kelas' => 'TITL-X', 'nama_kelas' => 'Teknik Instalasi Tenaga Listrik 1', 'jurusan_id' => 4, 'tingkat' => 10],
            ['kode_kelas' => 'TITL-XI', 'nama_kelas' => 'Teknik Instalasi Tenaga Listrik 2', 'jurusan_id' => 4, 'tingkat' => 11],
            ['kode_kelas' => 'TITL-XII', 'nama_kelas' => 'Teknik Instalasi Tenaga Listrik 3', 'jurusan_id' => 4, 'tingkat' => 12],
        ];

        foreach ($kelas as $data) {
            Kelas::create($data);
        }
    }
}