<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Jurusan; 
use App\Models\Kampus; 
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AddJurusan extends Component
{
     use WithPagination, WithoutUrlPagination; 

    public $id_kampus;
    public $id_prodi;
    public $Countprodi = null;
    public $namma_jurusan;
    public $InsertKampus;
    public $InsertJurusan;
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
        'InsertKampus' => 'required',
    ]);

    Jurusan::create([
        'nama_jurusan' => $this->InsertJurusan,
        'id_kampus' => $this->InsertKampus
    ]);
    session()->flash('success', 'Data berhasil ditambahkan.');

    $this->reset('InsertJurusan', 'InsertKampus');
    $this->dispatch('close-tambah-modal');
    $this->resetPage();

    
    }


    public function editKampus($id)
    {
    $kampus = Jurusan::with('kampus')->find($id);

    $this->selectedId = $id;
    $this->InsertJurusan = $kampus->nama_jurusan;
    $this->InsertKampus = $kampus->kampus->id_kampus;
    }


    public function updateKampus()
    {
        $this->validate([
        'InsertJurusan' => 'required',
        'InsertKampus' => 'required',
        ]);


        Jurusan::where('id_jurusan', $this->selectedId)->update([
        'nama_jurusan' => $this->InsertJurusan,
        'id_kampus' => $this->InsertKampus
            

    ]);



    session()->flash('success', 'Data berhasil diperbarui.');
    $this->reset(['InsertJurusan', 'InsertKampus', 'selectedId']);
    $this->dispatch('close-edit-modal');
    $this->resetPage();

}




    public function showDetail($id)
    {
        $this->selectedDetail = Jurusan::with('kampus','prodi')->find($id);
        $this->Countprodi = $this->selectedDetail->prodi->count();
        
    }

    public function delete($id)
    {
        $this->selectedDetail = Jurusan::find($id);
        $this->selectedDetail->delete();
        $this->resetPage();
        
    }

    
    public function render()
    {
        $query = jurusan::with('kampus')->paginate(8);
        $listkampus = Kampus::all();

        return view('livewire.add-jurusan', [
            'query' =>  $query,
            'listkampus' => $listkampus
        ]);
    }
}
