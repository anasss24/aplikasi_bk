<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('guru_bk', function (Blueprint $table) {
            $table->id('guru_id');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guru_bk');
    }
};
