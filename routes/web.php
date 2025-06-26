<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardDosenController;


Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/pilih-kampus/{id_kampus}', [LandingController::class, 'pilihKampus'])->name('pilih.kampus');
Route::get('/jurusan/{id_kampus}', [LandingController::class, 'indexjurusan'])->name('landing.jurusan');
Route::post('/pilih-jurusan/{id_kampus}/{id_jurusan}', [LandingController::class, 'pilihJurusan'])->name('pilih.jurusan');
Route::get('/prodi/{id_kampus}/{id_jurusan}', [LandingController::class, 'indexprodi'])->name('landing.prodi');
Route::post('/pilih-prodi/{id_kampus}/{id_prodi}', [LandingController::class, 'pilihProdi'])->name('pilih.prodi');
Route::get('/dashboard/{id_kampus}/{id_prodi}', [DashboardController::class, 'welcome'])->name('dashboard.welcome');
Route::get('/kampus/{id_kampus}/{id_prodi}/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/kampus/{id_kampus}/{id_prodi}/mahasiswa/j', [MahasiswaController::class, 'showJadwal'])->name('mahasiswa.jadwal');

Route::get('/kampus/{id_kampus}/{id_prodi}/mahasiswa/pengajuan', [MahasiswaController::class, 'pengajuanBimbingan'])->name('mahasiswa.pengajuanbimbingan');



Route::post('/{id_kampus}/{id_prodi}/dosen/d', [AuthDosenController::class, 'login'])->name('try.logind');



Route::get('kampus/{id_kampus}/{id_prodi}/login-dosen', [DosenController::class, 'showLoginForm'])->name('formlogin.dosen');
Route::post('kampus/{id_kampus}/{id_prodi}/login-dosen', [DosenController::class, 'login'])->name('login.dosen');
Route::post('kampus/{id_kampus}/{id_prodi}/logout-dosen', [DosenController::class, 'logout'])->name('logout.dosen');
Route::get('kampus/{id_kampus}/{id_prodi}/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
Route::get('kampus/{id_kampus}/{id_prodi}/bimbingan', [DosenController::class, 'bimbingan'])->name('dosen.bimbingan');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
