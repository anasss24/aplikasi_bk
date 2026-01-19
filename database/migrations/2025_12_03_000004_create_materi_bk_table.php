<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materi_bk', function (Blueprint $table) {
            $table->id('materi_id');
            $table->foreignId('guru_id')->constrained('guru_bk', 'guru_id')->onDelete('cascade');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->string('kategori'); // kelas10, kelas11, kelas12, umum
            $table->string('file_url')->nullable();
            $table->string('url_eksternal')->nullable();
            $table->date('tanggal_upload');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materi_bk');
    }
};
