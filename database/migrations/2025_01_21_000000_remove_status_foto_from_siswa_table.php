<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['status', 'foto']);
        });
    }

    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'dropout'])->default('aktif')->after('email');
            $table->string('foto')->nullable()->after('status');
        });
    }
};
