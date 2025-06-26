<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kampus;
use App\Models\User;

class DashboardController extends Controller
{
    public function welcome($id_kampus, $id_prodi) // Parameter $id akan otomatis terisi dari URL
    {
        // Cari data kampus berdasarkan ID yang diterima dari URL
        $kampus = Kampus::find($id_kampus);

        // Optional: Lakukan pengecekan jika kampus tidak ditemukan
        if (!$kampus) {
            // Jika ID tidak valid atau kampus tidak ditemukan, redirect kembali ke halaman landing
            // atau tampilkan halaman error
            return redirect()->route('landing')->with('error', 'Kampus tidak ditemukan atau ID tidak valid.');
        }

        $filterStatus = request()->get('status', 1); 


        $query = User::with([
        'detail_jadwal' => function ($q) use ($filterStatus) {
            $q->whereNotNull('id_matkul')
            ->whereNotNull('id_ruangan')
            ->whereNotNull('id_golongan')
             ->whereHas('jadwal', function ($sub) use ($filterStatus) {
                $sub->where('status', $filterStatus);
            })
            ->orderBy('id_ruangan') 
            ->orderBy('id_sesi');  
        },
        'detail_jadwal.jadwal',
        'detail_jadwal.matkul.pengampuutama',
        'detail_jadwal.matkul.pengampukedua',
        'detail_jadwal.golongan',
        'detail_jadwal.ruangan',
        'detail_jadwal.sesi',
        ])
        ->where('level', 2)
        ->where('id_prodi', $id_prodi)
        ->get();



        return view('dashboard.welcome', compact('kampus', 'id_kampus', 'id_prodi','query'));
}}