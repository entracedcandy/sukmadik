<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kampus;

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

        // Kirim objek $kampus ke view dashboard
        return view('dashboard.welcome', compact('kampus', 'id_kampus', 'id_prodi'));
}}