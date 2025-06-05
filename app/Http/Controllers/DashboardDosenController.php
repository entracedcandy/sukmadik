<?php

namespace App\Http\Controllers;


use App\Models\Semester;
use App\Models\matkul;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DetailSesi;

class DashboardDosenController extends Controller
{
    public function index($id_kampus, $id_prodi)
    {
    $user = Auth::user();

    // Ambil semua data detail_sesis milik user yang login + relasi
    $detailSesis = DetailSesi::with([
    'jadwal',
    'sesi',
    'matkul',
    'pengajuan_bimbingan.user',
    'pengajuan_bimbingan.semester'
])
->whereHas('matkul', function ($query) use ($user) {
    $query->where('id_user', $user->id); // id_use adalah foreign key ke users (dosen)
})
->orderByRaw("FIELD(jadwal.hari, 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu')")
->orderBy('sesi.jam', 'asc')
->get();

dd($detailSesis);


    // Buat daftar hari dalam seminggu
    $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];

    // Ambil semua sesi sebagai referensi waktu
    $sesis = \App\Models\Sesi::all();

    return view('dosen.dashboard', compact('detailSesis', 'sesis', 'hariList','id_kampus', 'id_prodi'));
    }
}
