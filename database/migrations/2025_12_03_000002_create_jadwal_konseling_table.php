<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal_konseling', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru_bk', 'guru_id')->onDelete('cascade');
            $table->dateTime('jadwal_datetime');
            $table->string('status')->default('diajukan'); // diajukan, disetujui, batal
            $table->text('catatan_admin')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('lokasi')->nullable();
            $table->string('metode')->default('offline'); // offline, online
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_konseling');
    }
};
