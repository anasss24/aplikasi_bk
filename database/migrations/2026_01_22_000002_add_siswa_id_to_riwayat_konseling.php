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
            if (!Schema::hasColumn('riwayat_konseling', 'siswa_id')) {
                $table->unsignedBigInteger('siswa_id')->nullable()->after('riwayat_id');
                $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_konseling', function (Blueprint $table) {
            if (Schema::hasColumn('riwayat_konseling', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }
        });
    }
};
