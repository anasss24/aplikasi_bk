<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Update existing jurusan data
        DB::table('jurusan')->truncate();
        
        DB::table('jurusan')->insert([
            ['id' => 1, 'kode_jurusan' => 'RPL', 'nama_jurusan' => 'Rekayasa Perangkat Lunak', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'kode_jurusan' => 'TKR', 'nama_jurusan' => 'Teknik Kendaraan Ringan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'kode_jurusan' => 'TPM', 'nama_jurusan' => 'Teknik Pemesinan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'kode_jurusan' => 'TITL', 'nama_jurusan' => 'Teknik Instalasi Tenaga Listrik', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        // Enable foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('jurusan')->truncate();
    }
};
