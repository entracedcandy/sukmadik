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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->tinyInteger('hari');
            $table->foreignId('id_golongan');
            $table->foreign('id_golongan')->references('id_golongan')->on('golongan')->onDelete('cascade');
            $table->foreignId('id_semester');
            $table->foreign('id_semester')->references('id_semester')->on('semester')->onDelete('cascade');
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
