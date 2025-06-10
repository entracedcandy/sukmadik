<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
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
        // prodi -> userDosen (banyak, yaitu user dengan level 'dosen')
        $kampus = Kampus::with(['jurusan.prodi.userDosen']) // Menggunakan relasi 'userDosen'
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
        // Karena relasi di Prodi::userDosen() sudah memfilter 'level' = 'dosen',
        // kita hanya perlu menggabungkan hasilnya.
        $userDosen = collect();
        foreach ($prodis as $prodi) {
            if ($prodi->relationLoaded('userDosen')) { // Mengakses relasi 'userDosen'
                $userDosen = $userDosen->concat($prodi->userDosen);
            }
        }

        

        $semesters = Semester::where('status', 1)->get();


        // --- AKHIR BAGIAN YANG DIUBAH/Disesuaikan ---

        return view('mahasiswa.pengajuanbimbingan', compact('kampus', 'jurusans', 'prodis', 'userDosen', 'semesters','id_kampus','id_prodi','id_jurusan'));

    }


    //  public function cariSesiBimbingan(Request $request)
    // {
    //     // Validasi input (penting!)
    //     $request->validate([
    //         'id_kampus' => 'required|integer',
    //         'id_jurusan' => 'required|integer',
    //         'id_prodi' => 'required|integer',
    //         'id_dosen' => 'required|integer',
    //         'id_semester' => 'required|integer',
    //         'tanggal' => 'required|date',
    //     ]);

    //     dd()

    //     $id_kampus = $request->input('id_kampus');
    //     $id_jurusan = $request->input('id_jurusan');
    //     $id_prodi = $request->input('id_prodi');
    //     $id_dosen = $request->input('id_dosen');
    //     $id_semester = $request->input('id_semester');
    //     $tanggal = $request->input('tanggal');

    //     $dt = Carbon::parse($tanggal);

    //     $hari = 'senin';


    //     // Lakukan query untuk mencari detail jadwal
    //     $sesiTersedia = DetailJadwal::whereHas('jadwal', function ($query) use ($id_kampus, $id_jurusan, $id_prodi, $id_semester, $id_dosen, $tanggal) {
    //         $query->where('id_kampus', $id_kampus)
    //               ->where('id_jurusan', $id_jurusan)
    //               ->where('id_prodi', $id_prodi)
    //               ->where('id_dosen', $id_dosen) // Asumsi id_dosen ada di tabel jadwal atau bisa diakses melalui relasi lain
    //               ->where('hari', $hari); // Asumsi ada kolom tanggal di tabel jadwal
    //     })
    //     ->whereNull('id_matkul') // Kriteria khusus: id_matkul = NULL
    //     ->where('status_sesi', 'tersedia') // Asumsi ada kolom status_sesi
    //     ->with(['jadwal.dosenUser']) // Eager load relasi yang diperlukan untuk menampilkan nama dosen, dll.
    //     ->get();

    //     // Siapkan data untuk dikirim kembali ke frontend
    //     $formattedSesi = $sesiTersedia->map(function ($sesi) {
    //         return [
    //             'id_detail_jadwal' => $sesi->id_detail_jadwal, // Sesuaikan dengan PK di detail_jadwal
    //             'waktu_mulai' => $sesi->waktu_mulai, // Ganti dengan nama kolom waktu Anda
    //             'waktu_selesai' => $sesi->waktu_selesai, // Ganti dengan nama kolom waktu Anda
    //             'ruangan' => $sesi->ruangan, // Ganti dengan nama kolom ruangan Anda
    //             'dosen_nama' => $sesi->jadwal->dosenUser->nama ?? 'N/A', // Akses nama dosen dari relasi
    //             'status_sesi' => $sesi->status_sesi, // Ganti dengan nama kolom status Anda
    //         ];
    //     });

    //     return response()->json($formattedSesi);
    // }


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

       

        // Menangani pesan peringatan jika tidak ada filter yang dipilih dan tidak ada jadwal
        if (empty($dosenId) && empty($semesterId) && $jadwals->isEmpty()) {
             $warningMessage = 'Silahkan pilih dosen atau semester untuk melihat jadwal.';
        } elseif ((!empty($dosenId) || !empty($semesterId)) && $jadwals->isEmpty()) {
            $warningMessage = 'Tidak ada jadwal yang tersedia untuk kriteria yang dipilih.';
        }

        return view('mahasiswa.jadwalbimbingan', compact('jadwals', 'dosenId','semesterId', 'dosens', 'id_kampus', 'id_prodi', 'semesters', 'warningMessage', 'timeSlots'));
    }

}