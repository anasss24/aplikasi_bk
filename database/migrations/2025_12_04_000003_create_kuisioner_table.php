<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pertanyaan_kuisioners', function (Blueprint $table) {
            $table->id('pertanyaan_id');
            $table->string('teks');
            $table->string('kategori')->nullable();
        });

        Schema::create('kuisioners', function (Blueprint $table) {
            $table->id('kuisioner_id');
            $table->foreignId('siswa_id')->nullable()->constrained('siswa')->onDelete('set null');
            $table->date('tanggal');
            $table->integer('skor_total')->default(0);
            $table->longText('komentar')->nullable();
            $table->timestamps();
        });

        Schema::create('kuisioner_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kuisioner_id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->longText('jawaban');
            $table->integer('skor')->default(0);
            $table->timestamps();

            $table->foreign('kuisioner_id')->references('kuisioner_id')->on('kuisioners')->onDelete('cascade');
            $table->foreign('pertanyaan_id')->references('pertanyaan_id')->on('pertanyaan_kuisioners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuisioner_details');
        Schema::dropIfExists('kuisioners');
        Schema::dropIfExists('pertanyaan_kuisioners');
    }
};
