<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengajuan_bimbingan;
use Illuminate\Support\Facades\Auth;

class ApprovalBimbingan extends Component
{
    public $id_kampus;
    public $id_prodi;
    public $selectedDetail = null;

    public function showDetail($id)
    {
        $this->selectedDetail = \App\Models\Pengajuan_bimbingan::find($id);
    }

    public function mount($id_kampus, $id_prodi)
    {
        $this->id_kampus = $id_kampus;
        $this->id_prodi = $id_prodi;
    }

    public function render()
    {
        $user = Auth::user();

        $id_user = $user->id_user;
        $query = Pengajuan_bimbingan::where('id_user', $id_user)->get();

        return view('livewire.approval-bimbingan', [
            'query' => $query

        ]);
    }
}
