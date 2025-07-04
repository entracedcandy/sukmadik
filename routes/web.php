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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Middleware\VerifyCsrfToken;




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





//Dosen
Route::get('dosen/{id_kampus}/{id_prodi}/login-dosen', [DosenController::class, 'showLoginForm'])->name('formlogin.dosen');
Route::post('dosen/{id_kampus}/{id_prodi}/login-dosen', [DosenController::class, 'login'])->name('login.dosen');
Route::post('dosen/{id_kampus}/{id_prodi}/logout-dosen', [DosenController::class, 'logout'])->name('logout.dosen');


Route::middleware(['Onlydosen'])->group(function () {
    Route::get('dosen/{id_kampus}/{id_prodi}/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('dosen/{id_kampus}/{id_prodi}/bimbingan', [DosenController::class, 'bimbingan'])->name('dosen.bimbingan');
});



//Admin
Route::get('admin/{id_kampus}/{id_prodi}/login-admin', [AdminController::class, 'showLoginForm'])->name('formlogin.admin');
Route::post('admin/{id_kampus}/{id_prodi}/login-admin', [AdminController::class, 'login'])->name('login.admin');
Route::post('admin/{id_kampus}/{id_prodi}/logout-admin', [AdminController::class, 'logout'])->name('logout.admin');


Route::middleware(['Onlyadmin'])->group(function () {
Route::get('admin/{id_kampus}/{id_prodi}/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/{id_kampus}/{id_prodi}/kampus', [AdminController::class, 'kampus'])->name('admin.kampus');
Route::get('admin/{id_kampus}/{id_prodi}/jurusan', [AdminController::class, 'jurusan'])->name('admin.jurusan');
Route::get('admin/{id_kampus}/{id_prodi}/prodi', [AdminController::class, 'prodi'])->name('admin.prodi');
Route::get('admin/{id_kampus}/{id_prodi}/mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
Route::get('admin/{id_kampus}/{id_prodi}/dosen', [AdminController::class, 'dosen'])->name('admin.dosen');
Route::get('admin/{id_kampus}/{id_prodi}/jadwal', [AdminController::class, 'jadwal'])->name('admin.jadwal');
Route::get('admin/{id_kampus}/{id_prodi}/bimbingan', [AdminController::class, 'bimbingan'])->name('admin.bimbingan');
Route::get('admin/{id_kampus}/{id_prodi}/jam', [AdminController::class, 'sesi'])->name('admin.sesi');
Route::get('admin/{id_kampus}/{id_prodi}/matkul', [AdminController::class, 'matkul'])->name('admin.matkul');

});






// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
