<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayat_konseling', function (Blueprint $table) {
            $table->id('riwayat_id');
            $table->foreignId('jadwal_id')->constrained('jadwal_konseling', 'jadwal_id')->onDelete('cascade');
            $table->string('topik');
            $table->longText('isi_konseling');
            $table->longText('tindak_lanjut')->nullable();
            $table->string('status_tindak_lanjut')->nullable(); // belum_dilaksanakan, sedang_berjalan, selesai
            $table->string('lampiran_url')->nullable();
            $table->foreignId('created_by')->constrained('guru_bk', 'guru_id')->onDelete('cascade');
            $table->date('tanggal_riwayat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_konseling');
    }
};
