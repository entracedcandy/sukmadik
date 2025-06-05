<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DetailSesi;

class JadwalController extends Controller
{
    public function showJadwal($id_kampus, $id_prodi, Request $request)
    {
        $dosens = User::where('level', 2)->get();
        $semesters = Semester::all();

        $dosenId = $request->input('dosen_id');
        $semesterId = $request->input('semester');        

        $warningMessage = null;
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

        return view('mahasiswa.jadwalbimbingan', compact('jadwals', 'dosenId','semesterId', 'dosens', 'id', 'semesters', 'warningMessage', 'timeSlots'));
    }
}