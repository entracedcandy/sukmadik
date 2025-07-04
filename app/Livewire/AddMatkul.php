<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sesi;
use App\Models\Matkul;
use Carbon\Carbon;

class AddMatkul extends Component
{
     public $selectedDetail = null;
     public $EditNama;
     public $EditStart;
     public $EditEnd;
     public $InsertNama;
     public $InsertProdi;
     public $InsertSemester;
     public $InsertPengampu1;
     public $InsertPengampu2;
     public $selectedId;

    public function storeKampus()
    {
    $this->validate([
        'InsertNama' => 'required',
        'InsertStart' => 'required',
        'InsertEnd' => 'required',
    ]);


    $Start = Carbon::createFromFormat('H:i', $this->InsertStart)->format('H:i:s');
    $End = Carbon::createFromFormat('H:i', $this->InsertEnd)->format('H:i:s');


    Sesi::create([
        'nama_sesi' => $this->InsertNama,
        'start' => $Start,
        'end' => $End,

    ]);
    session()->flash('success', 'Data berhasil ditambahkan.');

    $this->reset('InsertNama', 'InsertStart', 'InsertEnd');
    $this->dispatch('close-modal'); 
    }

    public function editKampus($id)
    {
    $kampus = Sesi::findOrFail($id);

    $this->selectedId = $id;
    $this->EditNama = $kampus->nama_sesi;
    $this->EditStart = $kampus->start;
    $this->EditEnd = $kampus->end;
    }

    public function updateKampus()
    {
    $this->validate([
        'EditNama' => 'required',
        'EditStart' => 'required',
        'EditNama' => 'required',
    ]);

    Sesi::where('id_sesi', $this->selectedId)->update([

        'nama_sesi' => $this->EditNama,
        'start' => $this->EditStart,
        'end' => $this->EditEnd 
    ]);

    session()->flash('success', 'Data berhasil diperbarui.');
     $this->reset('InsertNama', 'InsertStart', 'InsertEnd');
    $this->dispatch('close-modal'); 
    
    }

    public function delete($id)
    {
        $this->selectedDetail = Sesi::find($id);
        $this->selectedDetail->delete();
    }

    public function render()
    {
        $query = Matkul::with('pengampuutama','pengampukedua','semester','prodi')->paginate(8);
        


        return view('livewire.add-matkul',
            [
                'query' => $query
            ]);
    }
}
