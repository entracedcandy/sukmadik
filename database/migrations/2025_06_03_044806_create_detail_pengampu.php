<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('detail_pengampu', function (Blueprint $table) {
    //         $table->id('id_pengampu');
    //         $table->foreignId('id_pengampu1');
    //         $table->foreign('id_pengampu1')->references('id_user')->on('user')->onDelete('cascade');
    //         $table->foreignId('id_pengampu2')->nullable();
    //         $table->foreign('id_pengampu2')->references('id_user')->on('user')->onDelete('cascade');
    //         $table->foreignId('id_matkul');
    //         $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('cascade');
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('detail_pengampu');
    // }
};
