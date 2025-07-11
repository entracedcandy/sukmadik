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
        Schema::create('matkul', function (Blueprint $table) {
            $table->id('id_matkul');
            $table->string('nama_matkul');
            $table->foreignId('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade');
            $table->foreignId('id_semester');
            $table->foreign('id_semester')->references('id_semester')->on('semester')->onDelete('cascade');
            $table->foreignId('id_pengampu1');
            $table->foreign('id_pengampu1')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreignId('id_pengampu2')->nullable();
            $table->foreign('id_pengampu2')->references('id_user')->on('user')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkul');
    }
};
