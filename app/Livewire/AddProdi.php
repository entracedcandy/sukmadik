<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Prodi; 
use App\Models\Jurusan; 
use App\Models\Kampus; 
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AddProdi extends Component
{
     use WithPagination, WithoutUrlPagination; 

    public $id_kampus;
    public $id_prodi;
    public $Countdosen = null;
    public $namma_jurusan;
    public $InsertProdi;
    public $InsertJurusan;
    public $EditProdi;
    public $EditJurusan;
    public $selectedId;
    public $selectedDetail = null;

    public function mount ($id_kampus, $id_prodi)
    {
        $this->id_kampus = $id_kampus;
        $this->id_prodi = $id_prodi;
    }


    public function storeJurusan()
    {
    $this->validate([
        'InsertJurusan' => 'required',
        'InsertProdi' => 'required',
    ]);

    Prodi::create([
        'nama_prodi' => $this->InsertProdi,
        'id_jurusan' => $this->InsertJurusan,
    ]);
    session()->flash('success', 'Data berhasil ditambahkan.');

    $this->reset('InsertJurusan', 'InsertProdi');
    $this->dispatch('close-tambah-modal');
    $this->resetPage();

    
    }


    public function editKampus($id)
    {
    $kampus = Prodi::with('jurusan','jurusan.prodi')->find($id);

    $this->selectedId = $id;
    $this->EditProdi = $kampus->nama_prodi;
    $this->EditJurusan = optional($kampus->jurusan)->id_jurusan;
    }


    public function updateKampus()
    {
        $this->validate([
        'EditProdi' => 'required',
        'EditJurusan' => 'required',
        ]);


        Prodi::where('id_prodi', $this->selectedId)->update([
        'nama_prodi' => $this->EditProdi,
        'id_jurusan' => $this->EditJurusan
        
    ]);



    session()->flash('success', 'Data berhasil diperbarui.');
    $this->reset(['EditProdi', 'EditJurusan', 'selectedId']);
    $this->dispatch('close-edit-modal');
    $this->resetPage();

}




    public function showDetail($id)
    {
        $this->selectedDetail = Prodi::with('jurusan','jurusan.prodi','userDosen')->find($id);
        $this->Countdosen = $this->selectedDetail->userDosen->count();
        
        
    }

    public function delete($id)
    {
        $this->selectedDetail = Prodi::find($id);
        $this->selectedDetail->delete();
        $this->resetPage();
        
    }

    
    public function render()
    {
        $query = Prodi::with('jurusan','jurusan.kampus')->paginate(8);

        $listkampus = Kampus::all();
        $listjurusan = Jurusan::with('kampus')->get();
        

        return view('livewire.add-prodi', [
            'query' =>  $query,
            'listkampus' => $listkampus,
            'listjurusan' => $listjurusan
        ]);
    }
}
