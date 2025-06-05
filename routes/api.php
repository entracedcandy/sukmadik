<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BimbinganController;

Route::prefix('pengajuan-bimbingan')->group(function () {
    Route::get('/', [BimbinganController::class, 'index']);       // GET all
    Route::post('/', [BimbinganController::class, 'store']);      // POST new
    Route::get('/{id}', [BimbinganController::class, 'show']);    // GET detail
    Route::put('/{id}', [BimbinganController::class, 'update']);  // PUT update status
    Route::delete('/{id}', [BimbinganController::class, 'destroy']); // DELETE
});


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});