<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_bimbingan;
use Illuminate\Http\Request;
use App\Models\Kampus;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\User;

class BimbinganController extends Controller
{
    /**
     * Menampilkan semua pengajuan bimbingan.
     */
    public function form()
{


    
    return view('mahasiswa.pengajuanbimbingan', [
        'kampus' => Kampus::first(),
        'jurusans' => Jurusan::all(),
        'prodis' => Prodi::all(),
        'semesters' => Semester::all(),
        'userDosen' => User::where('level', 2)->get(),
    ]);
}

public function cariSesi(Request $request)
{
    $request->validate([
        'id_dosen' => 'required',
        'id_semester' => 'required',
        'id_prodi' => 'required',
        'id_jurusan' => 'required',
    ]);

    $sesiKosong = DetailJadwal::with(['sesi', 'jadwal'])
        ->whereNull('id_matkul')
        ->whereNull('id_ruangan')
        ->whereNull('id_golongan')
        ->whereHas('jadwal', function ($query) use ($request) {
            $query->where('id_user', $request->id_dosen)
                  ->where('id_semester', $request->id_semester);
        })
        ->get();

    return view('mahasiswa.pengajuanbimbingan', [
        'kampus' => Kampus::first(),
        'jurusans' => Jurusan::all(),
        'prodis' => Prodi::all(),
        'semesters' => Semester::all(),
        'userDosen' => User::where('role', 'dosen')->get(),
        'sesiKosong' => $sesiKosong
    ]);
}

public function ajukan(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'nim' => 'required',
        'nama' => 'required',
        'tanggal' => 'required|date',
        'tujuan' => 'required',
        'catatan' => 'nullable',
        'id_detail_jadwal' => 'required|exists:detail_jadwal,id_d_jadwal',
    ]);

    try {
        $detail = DetailJadwal::findOrFail($request->id_detail_jadwal);

        DetailBimbingan::create([
            'email' => $request->email,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'tujuan' => $request->tujuan,
            'catatan' => $request->catatan,
            'id_sesi' => $detail->id_sesi,
            'id_jadwal' => $detail->id_jadwal,
        ]);

        return redirect()->route('mahasiswa.bimbingan')->with('success', 'Pengajuan bimbingan berhasil!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal mengajukan bimbingan: ' . $e->getMessage());
    }
}
}