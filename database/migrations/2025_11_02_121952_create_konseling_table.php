<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('konseling', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->date('tanggal_konseling');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('jenis_konseling', ['akademik', 'sosial', 'karir', 'pribadi']);
            $table->text('masalah');
            $table->text('tindakan')->nullable();
            $table->enum('status', ['terjadwal', 'selesai', 'dibatalkan'])->default('terjadwal');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konseling');
    }
};