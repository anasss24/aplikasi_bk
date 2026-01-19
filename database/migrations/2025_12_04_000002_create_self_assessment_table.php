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
        Schema::create('pertanyaan_assessments', function (Blueprint $table) {
            $table->id('pertanyaan_id');
            $table->string('teks');
            $table->string('kategori')->nullable();
        });

        Schema::create('self_assessments', function (Blueprint $table) {
            $table->id('assessment_id');
            $table->foreignId('siswa_id')->nullable()->constrained('siswa')->onDelete('set null');
            $table->date('tanggal_isi');
            $table->string('topik');
            $table->longText('isi_curhat');
            $table->integer('tingkat_stres');
            $table->timestamps();
        });

        Schema::create('self_assessment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->longText('jawaban');
            $table->integer('skor')->default(0);
            $table->timestamps();

            $table->foreign('assessment_id')->references('assessment_id')->on('self_assessments')->onDelete('cascade');
            $table->foreign('pertanyaan_id')->references('pertanyaan_id')->on('pertanyaan_assessments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_assessment_details');
        Schema::dropIfExists('self_assessments');
        Schema::dropIfExists('pertanyaan_assessments');
    }
};
