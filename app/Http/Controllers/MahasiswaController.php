<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\Kampus;
use App\Models\Jurusan;
use App\Models\Golongan;
use App\Models\semester;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User; // Pastikan model User diimpor

class MahasiswaController extends Controller
{
    public function index($id_kampus, $id_prodi)
    {
        // Mengambil objek Kampus dan memuat relasi bertingkatnya:
        // kampus -> jurusan (banyak)
        // jurusan -> prodi (banyak)
        // prodi -> usersDosen (banyak, yaitu user dengan level 'dosen')
        $kampus = Kampus::with(['jurusan.prodi.user']) // Menggunakan relasi 'usersDosen'
                        ->findOrFail($id_kampus);

        
        $jurusans = $kampus->jurusan; // Koleksi Jurusan dari kampus ini
        $prodis = collect();
        foreach ($jurusans as $jurusan) {
            if ($jurusan->relationLoaded('prodi')) {
                $prodis = $prodis->concat($jurusan->prodi);
            }
        }

        $prodil = $prodis->firstWhere('id_prodi', $id_prodi);
        $id_jurusan = $prodil->id_jurusan;
        // --- BAGIAN YANG DIUBAH/Disesuaikan ---
        // Mengumpulkan semua User (Dosen) dari Prodi yang terkait
        // Karena relasi di Prodi::usersDosen() sudah memfilter 'level' = 'dosen',
        // kita hanya perlu menggabungkan hasilnya.
        $usersDosen = collect();
        foreach ($prodis as $prodi) {
            if ($prodi->relationLoaded('usersDosen')) { // Mengakses relasi 'usersDosen'
                $usersDosen = $usersDosen->concat($prodi->usersDosen);
            }
        }

        $semesters = Semester::all();
        // --- AKHIR BAGIAN YANG DIUBAH/Disesuaikan ---

        return view('mahasiswa.pengajuanbimbingan', compact('kampus', 'jurusans', 'prodis', 'usersDosen', 'semesters','id_kampus','id_prodi','id_jurusan'));

    }




    public function showJadwal($id_kampus, $id_prodi, Request $request)
    {

        $dosens = User::where('level', 2)->where('id_prodi', $id_prodi)->get();
        $semesters = Semester::all();
        $golongans = Golongan::all();

        $dosenId = $request->input('dosen_id');
        $semesterId = $request->input('semester');        
        $jadwals = collect();

        // Definisikan slot waktu standar
        $timeSlots = [];
        for ($i = 8; $i <= 16; $i++) {
            $timeSlots[] = sprintf('%02d:00', $i) . ' - ' . sprintf('%02d:00', $i + 1);
        }

        $query = Jadwal::with([
            'sesi.detail_sesi.matkul.user',
            'sesi.detail_sesi.pengajuan_bimbingan.user',
            'sesi.detail_sesi.pengajuan_bimbingan.semester'
        ]);

        // Filter berdasarkan semester jika dipilih
        if (!empty($semesterId)) {
            $query->where('id_semester', $semesterId);
        }

        // Filter berdasarkan dosen jika dipilih
        if (!empty($dosenId)) {
            $query->whereHas('sesi.detail_sesi', function ($qDetailSesi) use ($dosenId) {
                $qDetailSesi->where(function ($q) use ($dosenId) {
                    $q->whereHas('matkul', function ($qMatkul) use ($dosenId) {
                        $qMatkul->where('id_user', $dosenId);
                    })->orWhereHas('pengajuan_bimbingan', function ($qPengajuan) use ($dosenId) {
                        $qPengajuan->where('id_user', $dosenId);
                    });
                });
            });

        }

        $jadwals = $query->get()->sortBy('Hari')->groupBy('Hari');

        // Menangani pesan peringatan jika tidak ada filter yang dipilih dan tidak ada jadwal
        if (empty($dosenId) && empty($semesterId) && $jadwals->isEmpty()) {
             $warningMessage = 'Silahkan pilih dosen atau semester untuk melihat jadwal.';
        } elseif ((!empty($dosenId) || !empty($semesterId)) && $jadwals->isEmpty()) {
            $warningMessage = 'Tidak ada jadwal yang tersedia untuk kriteria yang dipilih.';
        }

        return view('mahasiswa.jadwalbimbingan', compact('jadwals', 'dosenId','semesterId', 'dosens', 'id_kampus', 'id_prodi', 'semesters', 'warningMessage', 'timeSlots'));
    }

}