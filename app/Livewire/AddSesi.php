<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sesi;
use Carbon\Carbon;

class AddSesi extends Component
{
     public $selectedDetail = null;
     public $EditNama;
     public $EditStart;
     public $EditEnd;
     public $InsertNama;
     public $InsertStart;
     public $InsertEnd;
     public $selectedId;

    public function storeKampus()
    {
    $this->validate([
        'InsertNama' => 'required',
        'InsertStart' => 'required',
        'InsertEnd' => 'required',
    ]);

    dd($this->InsertNama);

    $Start = Carbon::createFromFormat('H:i', $this->InsertStart)->format('H:i:s');
    $End = Carbon::createFromFormat('H:i', $this->InsertEnd)->format('H:i:s');


    Sesi::create([
        'nama_sesi' => $this->InsertNama,
        'start' => $Start,
        'End' => $End,

    ]);
    session()->flash('success', 'Data berhasil ditambahkan.');

    $this->reset('form');
    $this->dispatch('close-modal'); 
    }

    public function editKampus($id)
    {
    $kampus = Kampus::findOrFail($id);

    $this->selectedId = $id;
    $this->form = [
        'nama_kampus' => $kampus->nama_kampus,
        'alamat' => $kampus->alamat,
    ];
    }

    public function updateKampus()
    {
    $this->validate([
        'form.nama_kampus' => 'required',
        'form.alamat' => 'required',
    ]);

    Kampus::where('id_kampus', $this->selectedId)->update($this->form);

    session()->flash('success', 'Data berhasil diperbarui.');
    $this->reset(['form', 'selectedId']);
    $this->dispatch('close-modal'); 
    
    }

    public function delete($id)
    {
        $this->selectedDetail = Kampus::find($id);
        $this->selectedDetail->delete();
    }

    public function render()
    {
        $query = Sesi::all();



        return view('livewire.add-sesi',
            [
                'query' => $query
            ]);
    }
}
