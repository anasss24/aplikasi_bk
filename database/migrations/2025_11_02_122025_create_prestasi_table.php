<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->string('jenis_prestasi');
            $table->string('tingkat');
            $table->string('nama_prestasi');
            $table->date('tanggal_prestasi');
            $table->text('deskripsi');
            $table->string('penyelenggara');
            $table->string('sertifikat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasi');
    }
};