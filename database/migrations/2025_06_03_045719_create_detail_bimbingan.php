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
        Schema::create('detail_bimbingan', function (Blueprint $table) {
            $table->id('id_d_bimbingan');
            $table->string('email');
            $table->string('nama');
            $table->string('nim');
            $table->string('tujuan');
            $table->text('catatan')->nullable();
            $table->date('tanggal');
            $table->foreignId('id_sesi');
            $table->foreign('id_sesi')->references('id_sesi')->on('sesi')->onDelete('cascade');
            $table->foreignId('id_jadwal');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
             $table->foreignId('id_golongan')->nullable();
            $table->foreign('id_golongan')->references('id_golongan')->on('golongan')->onDelete('cascade');
            $table->foreignId('id_semester')->nullable();
            $table->foreign('id_semester')->references('id_semester')->on('semester')->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bimbingan');
    }
};
