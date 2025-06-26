<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\Kampus;
use App\Models\Ruangan;
use App\Models\Golongan;
use App\Models\semester;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
  
    public function index(Request $request, $id_kampus, $id_prodi)
{
    $selectedDosen = $request->input('dosen');     // ex: 4
    $selectedSemester = $request->input('semester'); // ex: 4

    $listSemester = DB::table('semester')->where('status', 1)->get();

    $listdosen = DB::table('user')
        ->where('level', 2)
        ->where('id_prodi', $id_prodi)
        ->get();

    $filterStatus = request()->get('status', 1);

    $jadwalkuliah = User::with([
        'detail_jadwal' => function ($q) use ($filterStatus) {
            $q->whereHas('jadwal', function ($sub) use ($filterStatus) {
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
        ->where('id_user', $selectedDosen)
        ->get();


        $jadwalbimbingan = User::with([
                           'detail_bimbingan' => function ($q) use ($filterStatus) {
                               $q->whereHas('jadwal', function ($sub) use ($filterStatus) {
                                   $sub->where('status', $filterStatus);
                               })
                               ->orderBy('id_sesi');
                           },
                           'detail_bimbingan.jadwal.user',
                           'detail_bimbingan.sesi',
                           'detail_bimbingan.golongan',
                           'detail_bimbingan.semester',
                       ])
                       ->where('level', 2) 
                       ->where('id_prodi', $id_prodi) 
                       ->where('id_user', $selectedDosen)
                       ->get();

    $gabungan = collect();

    // Gabungkan detail_jadwal dari semua user
    foreach ($jadwalkuliah as $user) {
        foreach ($user->detail_jadwal as $item) {
            $gabungan->push($item);
        }
    }

    // Gabungkan detail_bimbingan dari semua user
    foreach ($jadwalbimbingan as $user) {
        foreach ($user->detail_bimbingan as $item) {
            $gabungan->push($item);
        }
    }

    // Kelompokkan berdasarkan hari dari relasi jadwal
    $query = $gabungan->groupBy(fn($item) => optional($item->jadwal)->hari);


    return view('mahasiswa.jadwalbimbingan', [
        'query' => $query,
        'id_kampus' => $id_kampus,
        'id_prodi' => $id_prodi,
        'listSemester' => $listSemester,
        'listdosen' => $listdosen,
    ]);
}


    public function pengajuanbimbingan(Request $request, $id_kampus, $id_prodi)
    {
        // $kampus = Kampus::with(['jurusan'])->where('id_kampus', $id_kampus)->get();

        // $jurusan = collect();
        // foreach ($kampus as $kmp) {
        //     $jurusan = $jurusan->merge($kmp->jurusan);
        // }
        
        // $prodi = Prodi::with(['userDosen'])->where('id_prodi', $id_prodi)->get();

        // $userDosen = collect();
        // foreach ($prodi as $prd) {
        //     $userDosen = $userDosen->merge($prd->userDosen);
        // }

        
        
        // $jurusan = $kampus->jurusan;
        // $prodi = Prodi::with(['usersDosen'])->where('id_prodi', $id_prodi)->first();
        // $dosen = $prodi->usersDosen;
    
        // $golongan = Golongan::where('status', 0)->get();
        // $semester = Semester::where('status', 1)->get();


        

        
        return view('mahasiswa.pengajuanbimbingan', [
            // 'kampus' => $kampus,
            // 'prodi' => $prodi,
            // 'jurusan' => $jurusan,
            // 'dosen' => $userDosen,      
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
            // 'golongan' => $golongan,
            // 'semester' => $semester

        ]);
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


    //     // Lakukan jadwal untuk mencari detail jadwal
    //     $sesiTersedia = DetailJadwal::whereHas('jadwal', function ($jadwal) use ($id_kampus, $id_jurusan, $id_prodi, $id_semester, $id_dosen, $tanggal) {
    //         $jadwal->where('id_kampus', $id_kampus)
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


    // public function showJadwal($id_kampus, $id_prodi, Request $request)
    // {

    //     $dosens = User::where('level', 2)->where('id_prodi', $id_prodi)->get();
    //     $semesters = Semester::all();
    //     $golongans = Golongan::all();


    //     $dosenId = $request->input('dosen_id');
    //     $semesterId = $request->input('semester');        
    //     $jadwals = collect();

    //     // Definisikan slot waktu standar
    //     $timeSlots = [];
    //     for ($i = 8; $i <= 16; $i++) {
    //         $timeSlots[] = sprintf('%02d:00', $i) . ' - ' . sprintf('%02d:00', $i + 1);
    //     }

    //     $jadwal = Jadwal::with([
    //         'sesi.detail_sesi.matkul.user',
    //         'sesi.detail_sesi.pengajuan_bimbingan.user',
    //         'sesi.detail_sesi.pengajuan_bimbingan.semester'
    //     ]);

    //     // Filter berdasarkan semester jika dipilih
    //     if (!empty($semesterId)) {
    //         $jadwal->where('id_semester', $semesterId);
    //     }

    //     // Filter berdasarkan dosen jika dipilih
    //     if (!empty($dosenId)) {
    //         $jadwal->whereHas('sesi.detail_sesi', function ($qDetailSesi) use ($dosenId) {
    //             $qDetailSesi->where(function ($q) use ($dosenId) {
    //                 $q->whereHas('matkul', function ($qMatkul) use ($dosenId) {
    //                     $qMatkul->where('id_user', $dosenId);
    //                 })->orWhereHas('pengajuan_bimbingan', function ($qPengajuan) use ($dosenId) {
    //                     $qPengajuan->where('id_user', $dosenId);
    //                 });
    //             });
    //         });

    //     }

       

    //     // Menangani pesan peringatan jika tidak ada filter yang dipilih dan tidak ada jadwal
    //     if (empty($dosenId) && empty($semesterId) && $jadwals->isEmpty()) {
    //          $warningMessage = 'Silahkan pilih dosen atau semester untuk melihat jadwal.';
    //     } elseif ((!empty($dosenId) || !empty($semesterId)) && $jadwals->isEmpty()) {
    //         $warningMessage = 'Tidak ada jadwal yang tersedia untuk kriteria yang dipilih.';
    //     }

    //     return view('mahasiswa.jadwalbimbingan', compact('jadwals', 'dosenId','semesterId', 'dosens', 'id_kampus', 'id_prodi', 'semesters', 'warningMessage', 'timeSlots'));
    // }

  // public function index(Request $request, $id_kampus, $id_prodi)
    // {
    // $selectedDosen = $request->input('dosen');
    // $selectedSemester = $request->input('semester');
        
    // $listSemester = Semester::where('status', 1)->get();

    // $listdosen = User::where('level', 2)->where('id_prodi', $id_prodi)->get();

    // // Query data dosen beserta relasi jadwalnya
    // $jadwal = User::with([
    //     'jadwal.detail_jadwal' => function ($q) {
    //         $q->orderBy('id_ruangan')
    //           ->orderBy('id_sesi');
    //     },
    //     'jadwal.detail_jadwal',
    //     'jadwal.detail_jadwal.matkul',
    //     'jadwal.detail_jadwal.ruangan',
    //     'jadwal.detail_jadwal.golongan',
    //     'jadwal.detail_jadwal.sesi',
    // ])
    // ->where('level', 2)
    // ->where('id_prodi', $id_prodi);
    
    
    // if ($selectedDosen) {
    //     $jadwal->where('id_user', $selectedDosen);
    // }

    // if ($selectedSemester) {
    //     $jadwal->whereHas('jadwal', function ($q) use ($selectedSemester) {
    //         $q->where('id_semester', $selectedSemester);
    //     });
    // }

    // $query = $jadwal->get();


    

    // return view('mahasiswa.jadwalbimbingan', compact('id_kampus', 'id_prodi','query', 'listSemester', 'listdosen'));
    // }



    

}