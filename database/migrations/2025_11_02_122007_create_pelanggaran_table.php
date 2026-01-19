<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->date('tanggal_pelanggaran');
            $table->string('jenis_pelanggaran');
            $table->text('keterangan');
            $table->integer('poin');
            $table->text('sanksi');
            $table->enum('status', ['tertunda', 'diproses', 'selesai'])->default('tertunda');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggaran');
    }
};