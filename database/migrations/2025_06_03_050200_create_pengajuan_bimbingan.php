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
        Schema::create('pengajuan_bimbingan', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->string('email');
            $table->string('nama');
            $table->string('nim');
            $table->string('tujuan');
            $table->text('catatan')->nullable();
            $table->date('tanggal');
            $table->string('status')->default('diajukan');
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreignId('id_kampus');
            $table->foreign('id_kampus')->references('id_kampus')->on('kampus')->onDelete('cascade');
            $table->foreignId('id_jurusan');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade');
            $table->foreignId('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade');
            $table->foreignId('id_semester');
            $table->foreign('id_semester')->references('id_semester')->on('semester')->onDelete('cascade');
            $table->foreignId('id_golongan');
            $table->foreign('id_golongan')->references('id_golongan')->on('golongan')->onDelete('cascade');
            $table->foreignId('id_sesi');
            $table->foreign('id_sesi')->references('id_sesi')->on('sesi')->onDelete('cascade');
            $table->foreignId('id_jadwal');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bimbingan');
    }
};
