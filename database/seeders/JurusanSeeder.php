<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            [
                'kode_jurusan' => 'TKJ',
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
                'deskripsi' => 'Jurusan yang mempelajari tentang jaringan komputer dan teknik komputer'
            ],
            [
                'kode_jurusan' => 'RPL',
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
                'deskripsi' => 'Jurusan yang mempelajari tentang pengembangan perangkat lunak'
            ],
            [
                'kode_jurusan' => 'MM',
                'nama_jurusan' => 'Multimedia',
                'deskripsi' => 'Jurusan yang mempelajari tentang desain dan produksi multimedia'
            ],
        ];

        foreach ($jurusan as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}