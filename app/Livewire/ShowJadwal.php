<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Semester;

class ShowJadwal extends Component
{   
    public $selectedSemester;
    public $selectedDosen;

    public $selectedDosenInput;
    public $selectedSemesterInput;

    // Deklarasikan properti publik untuk menerima parameter
    public $id_kampus;
    public $id_prodi;

    // Method mount() akan dipanggil saat komponen diinisialisasi
    // Parameter dari route atau atribut Blade akan otomatis masuk ke sini
   public function mount($id_kampus, $id_prodi)
{
    $this->id_kampus = $id_kampus;
    $this->id_prodi = $id_prodi;

    // SET default kosong
    $this->selectedDosen = '';
    $this->selectedSemester = '';
    $this->selectedDosenInput = '';
    $this->selectedSemesterInput = '';
}


    public function applyFilter()
{
    $this->selectedDosen = $this->selectedDosenInput;
    $this->selectedSemester = $this->selectedSemesterInput;
}


    public function render()
{
   

    $listDosen = User::where('level', 2)
        ->where('id_prodi', $this->id_prodi)
        ->get();

    $listSemester = Semester::where('status', 1)->get();

    // Query data dosen beserta relasi jadwalnya
    $dosenQuery = User::with([
        'detail_jadwal' => function ($q) {
            $q->whereNotNull('id_matkul')
              ->whereNotNull('id_ruangan')
              ->whereNotNull('id_golongan')
              ->orderBy('id_ruangan')
              ->orderBy('id_sesi');
        },
        'detail_jadwal.jadwal',
        'detail_jadwal.matkul',
        'detail_jadwal.ruangan',
        'detail_jadwal.golongan',
        'detail_jadwal.sesi',
    ])
    ->where('level', 2)
    ->where('id_prodi', $this->id_prodi);

    // Filter dosen
    if ($this->selectedDosen) {
        $dosenQuery->where('id', $this->selectedDosen);
    }

    // Filter semester (di dalam detail_jadwal)
    if ($this->selectedSemester) {
        $dosenQuery->whereHas('detail_jadwal', function ($q) {
            $q->where('semester_id', $this->selectedSemester);
        });
    }

    $query = $dosenQuery->get();

    return view('livewire.show-jadwal', [
        'query' => $query,
        'listSemester' => $listSemester,
        'listDosen' => $listDosen,
    ]);
}
}