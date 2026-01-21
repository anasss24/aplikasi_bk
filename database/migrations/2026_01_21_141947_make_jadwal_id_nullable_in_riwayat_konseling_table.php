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
            // Make jadwal_id nullable
            $table->foreignId('jadwal_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_konseling', function (Blueprint $table) {
            $table->foreignId('jadwal_id')->nullable(false)->change();
        });
    }
};
