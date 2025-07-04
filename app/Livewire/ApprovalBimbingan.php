<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengajuan_bimbingan;
use App\Models\detail_bimbingan;
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

    public function approve($id_pengajuan, $status)
    {
        $pengajuan = Pengajuan_bimbingan::find($id_pengajuan);


        $email = $pengajuan->email;
        $nama = $pengajuan->nama;
        $nim = $pengajuan->nim;
        $tujuan = $pengajuan->tujuan;
        $catatan = $pengajuan->catatan;
        $tanggal = $pengajuan->tanggal;
        $id_sesi = $pengajuan->id_sesi;
        $id_jadwal = $pengajuan->id_jadwal;
        $id_golongan = $pengajuan->id_golongan;
        $id_semester = $pengajuan->id_semester;

        



        if($status == 'acc'){
            detail_bimbingan::create([
                'email' => $email,
                'nama' => $nama,
                'nim' => $nim,
                'tujuan' => $tujuan,
                'catatan' => $catatan,
                'tanggal' => $tanggal,
                'id_sesi' => $id_sesi,
                'id_jadwal' => $id_jadwal,
                'id_golongan' => $id_golongan,
                'id_semester' => $id_semester,
            ]);
        }else{
            detail_bimbingan::where('id_jadwal', $id_jadwal)->where('id_sesi', $id_sesi)->delete();
         
        }

        Pengajuan_bimbingan::where('id_pengajuan', $id_pengajuan)
        ->update(['status' => $status]);

        
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
