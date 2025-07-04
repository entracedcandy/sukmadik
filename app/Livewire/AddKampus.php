<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kampus;

class AddKampus extends Component
{
     public $selectedDetail = null;
     public $Countprodi = null;
     public $Countjurusan = null;
     public $form = [
    'nama_kampus' => '',
    'alamat' => '',
    ];
    
    public $selectedId;

    public function storeKampus()
    {
    $this->validate([
        'form.nama_kampus' => 'required',
        'form.alamat' => 'required',
    ]);

    Kampus::create($this->form);
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




    public function showDetail($id)
    {
        $this->selectedDetail = Kampus::with('jurusan','prodi')->find($id);
        $this->Countprodi = $this->selectedDetail->prodi->count();
        $this->Countjurusan = $this->selectedDetail->jurusan->count();
        
    }

    public function delete($id)
    {
        $this->selectedDetail = Kampus::find($id);
        $this->selectedDetail->delete();
    }

    public function render()
    {
        $query = Kampus::all();



        return view('livewire.add-kampus',
            [
                'query' => $query
            ]);
    }
}
