<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Jadwal;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Semester;
use App\Models\Kampus;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Golongan;
use App\Models\Detail_Jadwal;
use App\Models\Pengajuan_Bimbingan;


class CariSesi extends Component
{   
    public $SelectedEmail;
    public $SelectedNama;
    public $SelectedNIM;
    public $SelectedTujuan;
    public $SelectedCatatan;
    public $SelectedTanggal;
    public $SelectedDosen;
    public $SelectedGolongan;
    public $SelectedSemester;
    public $SelectedSesi;
    public $id_kampus;
    public $id_jurusan;
    public $id_prodi;
    public $id_jadwal;
    public $listsesi=[];

    
    public function mount($id_kampus, $id_prodi)
    {
        $this->id_kampus = $id_kampus;
        $this->id_prodi = $id_prodi;
    }



    public function Filtersesi()
    {
        Carbon::setLocale('id');
        // $hari = Carbon::parse($this->SelectedTanggal)->translatedFormat('l');
        $hari = Carbon::parse($this->SelectedTanggal)->dayOfWeekIso; 

        if (in_array($hari, [6, 7])) {
        $this->reset('SelectedTanggal');
        $this->addError('SelectedTanggal', 'Tanggal tidak boleh hari Sabtu atau Minggu.'); 
    }else{
        $this->resetErrorBag('SelectedTanggal');
    }

    $dosen = $this->SelectedDosen;

     if($hari && $dosen == Null) {
            $this->addError('SelectedTanggal', 'Isi Semua Data terlebih dahulu');
        }
        
        // $jadwal = Jadwal::with(['detail_jadwal'])->where('id_user', $this->SelectedDosen)->where('id_semester', $this->SelectedSemester)->where('hari', $hari)->get();

    //    $detailKosong = Detail_Jadwal::with(['jadwal', 'sesi','detail_bimbingan'])
    // ->whereNull('id_matkul')
    // ->whereNull('id_ruangan')
    // ->whereNull('id_golongan')
    // ->whereHas('jadwal', function ($query) use ($dosen, $hari) {
    //     $query->where('id_user', $dosen)
    //           ->where('hari', $hari);
    // })
    // ->whereDoesntHave('detail_bimbingan', function ($q) {
    // })
    // ->get();


    
    $detailKosong = Jadwal::with(['detail_jadwal' => function ($query) {
        $query->whereNull('id_matkul')
              ->whereNull('id_ruangan')
              ->whereNull('id_golongan')
              ->whereDoesntHave('detail_bimbingan', function ($q) {
                  
              }); 
    }, 'detail_jadwal.sesi'
    ])
    ->where('id_user', $dosen)
    ->where('hari', $hari)
    ->where('status',1)->get();

    
    $getjadwal = $detailKosong->pluck('id_jadwal')->unique();
    $this->id_jadwal = $getjadwal->first();   
    $this->listsesi = $detailKosong->pluck('detail_jadwal')->flatten()->pluck('sesi')->unique();
    
    }


    public function Simpan()
    {
        $this->validate([
            'SelectedEmail' => 'required|email',
            'SelectedNama' => 'required|string|max:100',
            'SelectedNIM' => 'required|string|max:10|min:5',
            'SelectedTujuan' => 'required|string|max:100',
            'SelectedCatatan' => 'required|string|',
            'SelectedTanggal' => 'required|date',
            'SelectedDosen' => 'required|numeric',
            'SelectedGolongan' => 'required|numeric',
            'SelectedSemester' => 'required|numeric',
            'SelectedSesi' => 'required|numeric',
            'id_kampus' => 'required|numeric',
            'id_jurusan' => 'required|numeric',
            'id_prodi' => 'required|numeric',
            'id_jadwal' => 'required|numeric',

        ]);

        Pengajuan_Bimbingan::create([
            'email' => $this->SelectedEmail,
            'nama' => $this->SelectedNama,
            'nim' => $this->SelectedNIM,
            'tujuan' => $this->SelectedTujuan,
            'catatan' => $this->SelectedCatatan,
            'tanggal' => $this->SelectedTanggal,
            'id_user' => $this->SelectedDosen,
            'id_golongan' => $this->SelectedGolongan,
            'id_semester' => $this->SelectedSemester,
            'id_sesi' => $this->SelectedSesi,
            'id_kampus' => $this->id_kampus,
            'id_jurusan' => $this->id_jurusan,
            'id_prodi' => $this->id_prodi,
            'id_jadwal' => $this->id_jadwal
]);
        $this->reset(['SelectedEmail', 'SelectedNama', 'SelectedNIM', 'SelectedTujuan', 'SelectedCatatan', 'SelectedTanggal', 'SelectedDosen', 'SelectedGolongan', 'SelectedSemester', 'SelectedSesi', 'id_jadwal',]);

        session()->flash('success', 'Data berhasil disimpan!');
    }



    public function render()
    {
        $kampus = Kampus::where('id_kampus', $this->id_kampus)->get();

        
        
        $prodi = Prodi::with(['userDosen', 'jurusan'])->where('id_prodi', $this->id_prodi)->get();

        $jurusan = $prodi->pluck('jurusan');

        

        $userDosen = collect();
        foreach ($prodi as $prd) {
            $userDosen = $userDosen->merge($prd->userDosen);
        }

        foreach ($jurusan as $item) {
            $this->id_jurusan = $item->id_jurusan;
        }

        
        // $jurusan = $kampus->jurusan;
        // $prodi = Prodi::with(['usersDosen'])->where('id_prodi', $id_prodi)->first();
        // $dosen = $prodi->usersDosen;
    
        $golongan = Golongan::where('status', 0)->get();
        $semester = Semester::where('status', 1)->get();

        
        return view('livewire.cari-sesi', [
            'id_kampus' => $this->id_kampus,
            'id_prodi' => $this->id_prodi,
            'kampus' => $kampus,
            'prodi' => $prodi,
            'jurusan' => $jurusan,
            'dosen' => $userDosen,
            'golongan' => $golongan,
            'semester' => $semester,
            'liststatus' => $this->listsesi

    
        ]);
    }
}
