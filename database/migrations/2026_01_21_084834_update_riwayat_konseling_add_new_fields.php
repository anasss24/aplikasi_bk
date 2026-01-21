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
        Schema::table('riwayat_konseling', function (Blueprint $table) {
            // Cek dan tambah kolom hanya jika belum ada
            if (!Schema::hasColumn('riwayat_konseling', 'guru_id')) {
                $table->unsignedBigInteger('guru_id')->nullable();
            }
            if (!Schema::hasColumn('riwayat_konseling', 'waktu_mulai')) {
                $table->time('waktu_mulai')->nullable();
            }
            if (!Schema::hasColumn('riwayat_konseling', 'durasi')) {
                $table->integer('durasi')->nullable()->comment('durasi dalam menit');
            }
            if (!Schema::hasColumn('riwayat_konseling', 'metode')) {
                $table->string('metode')->nullable();
            }
            if (!Schema::hasColumn('riwayat_konseling', 'lokasi')) {
                $table->string('lokasi')->nullable();
            }
            if (!Schema::hasColumn('riwayat_konseling', 'progres')) {
                $table->text('progres')->nullable();
            }
            if (!Schema::hasColumn('riwayat_konseling', 'tanggal_follow_up')) {
                $table->date('tanggal_follow_up')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_konseling', function (Blueprint $table) {
            if (Schema::hasColumn('riwayat_konseling', 'guru_id')) $table->dropColumn('guru_id');
            if (Schema::hasColumn('riwayat_konseling', 'waktu_mulai')) $table->dropColumn('waktu_mulai');
            if (Schema::hasColumn('riwayat_konseling', 'durasi')) $table->dropColumn('durasi');
            if (Schema::hasColumn('riwayat_konseling', 'metode')) $table->dropColumn('metode');
            if (Schema::hasColumn('riwayat_konseling', 'lokasi')) $table->dropColumn('lokasi');
            if (Schema::hasColumn('riwayat_konseling', 'progres')) $table->dropColumn('progres');
            if (Schema::hasColumn('riwayat_konseling', 'tanggal_follow_up')) $table->dropColumn('tanggal_follow_up');
        });
    }
};
