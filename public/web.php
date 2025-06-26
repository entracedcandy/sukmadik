<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AuthDosenController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Middleware\onlydosen;
use App\Livewire\ShowJadwal;




Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/pilih-kampus/{id_kampus}', [LandingController::class, 'pilihKampus'])->name('pilih.kampus');
Route::get('/jurusan/{id_kampus}', [LandingController::class, 'indexjurusan'])->name('landing.jurusan');
Route::post('/pilih-jurusan/{id_kampus}/{id_jurusan}', [LandingController::class, 'pilihJurusan'])->name('pilih.jurusan');
Route::get('/prodi/{id_kampus}/{id_jurusan}', [LandingController::class, 'indexprodi'])->name('landing.prodi');
Route::post('/pilih-prodi/{id_kampus}/{id_prodi}', [LandingController::class, 'pilihProdi'])->name('pilih.prodi');
Route::get('/dashboard/{id_kampus}/{id_prodi}', [DashboardController::class, 'welcome'])->name('dashboard.welcome');

Route::get('/{id_kampus}/{id_prodi}/test', ShowJadwal::class);

Route::get('/kampus/{id_kampus}/{id_prodi}/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');


Route::post('/kampus/{id_kampus}/{id_prodi}/dosen', [MahasiswaController::class, 'cariSesiTersedia'])->name('mahasiswa.cariSesiTersedia');

// Route::get('/debug/{id_kampus}/{id_prodi}', [LandingController::class, 'debug'])->name('debug');

Route::get('/kampus/{id_kampus}/{id_prodi}/mahasiswa/j', [MahasiswaController::class, 'showJadwal'])->name('mahasiswa.jadwal');
Route::post('/mahasiswa/cari-sesi-tersedia', [MahasiswaController::class, 'cariSesiTersedia'])->name('mahasiswa.cariSesiTersedia');
Route::post('/{id_kampus}/{id_prodi}/dosen/d', [AuthDosenController::class, 'login'])->name('try.logind');
Route::post('/{id_kampus}/{id_prodi}/logout-dosen', [AuthDosenController::class, 'logout'])->name('logout.dosen');
Route::get('kampus/{id_kampus}/{id_prodi}/login-dosen', [AuthDosenController::class, 'showLoginForm'])->name('login.dosen');
Route::middleware('Onlydosen')->group(function () {
    Route::get('kampus/{id_kampus}/{id_prodi}/dosen/dashboard', [DashboardDosenController::class, 'index'])->name('dosen.d');
});


// Route::get('/{id_kampus}/{id_}/dosen/dashboard', function () {return view('dosen.dashboard');});

Route::get('/dosen', function () {
    return view('dosen.login');
});





// Route::post('/pilih-prodi/{id_kampus}', [LandingController::class, 'indexprodi'])->name('pilih.prodi');



// Route::get('/get-user-schedule', [ScheduleController::class, 'getUserSchedule']);



// Mahasiswa
// Route::get('/mhs/', function () {
//     return view('mahasiswa.pengajuanbimbingan');
// });



// Route::get('/mhs/s', function () {
//     return view('mahasiswa.ketersediaansesi');
// });

//Welcome

// Route::get('/dashboard', function () {
//     return view('dashboard.welcome');
// });

// Route::get('/', function () {
//     return view('dashboard.welcome');
// });


//Admin
Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/admin/d', function () {
    return view('admin.dashboard');
});

Route::get('/admin/ds', function () {





    return view('admin.dosen');
});

Route::get('/admin/jd', function () {
    return view('admin.jadwal');
});

Route::get('/admin/jm', function () {
    return view('admin.jam');
});

Route::get('/admin/ju', function () {
    return view('admin.jurusan');
});

Route::get('/admin/k', function () {
    return view('admin.kampus');
});

Route::get('/admin/m', function () {
    return view('admin.matkul');
});

Route::get('/admin/pe', function () {
    return view('admin.pengguna');
});

Route::get('/admin/pr', function () {
    return view('admin.prodi');
});




//Dosen



Route::get('/dosen/p', function () {
    return view('dosen.presensi');
});

Route::get('/dosen/b', function () {
    return view('dosen.bimbingan');
});










// Route::get('/t', function () {
//     return view('crashsite');
// });