<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Make columns nullable for auto-registration
            $table->string('jenis_kelamin')->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->string('no_telepon')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('jenis_kelamin')->nullable(false)->change();
            $table->string('tempat_lahir')->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
            $table->string('no_telepon')->nullable(false)->change();
        });
    }
};
