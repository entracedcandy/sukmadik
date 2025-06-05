<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kampus;
use App\Models\Jurusan;
use App\Models\Prodi;

class LandingController extends Controller
{
   public function index()
    {
        $kampus = Kampus::all();
        return view('crashsite', compact('kampus'));
    }

    
    public function pilihKampus($id_kampus)
    {
    // dd($id);
    // $kampusId = $id->input('kampus_id');

    // Simpan ke session
    //  session()->flash('kampus_id', $kampusId);
    return redirect()->route('landing.jurusan', ['id_kampus' => $id_kampus]);
    }


    public function indexjurusan($id_kampus)
    {
        $jurusan = jurusan::where('id_kampus',$id_kampus)->get();
        return view('jurusanlanding', compact('jurusan', 'id_kampus'));
    }

    public function pilihJurusan($id_kampus, $id_jurusan,)
    {
    // dd($id);

    
    // $kampusId = $id->input('kampus_id');

    // Simpan ke session
    //  session()->flash('kampus_id', $kampusId);
    return redirect()->route('landing.prodi', ['id_kampus' => $id_kampus, 'id_jurusan' => $id_jurusan,]);
    }

    public function debug($id_kampus, $id_jurusan,)
    {
        dd($id_jurusan, $id_kampus);
    }

    public function indexprodi($id_kampus, $id_jurusan,)
    {
        $prodi = prodi::where('id_jurusan',$id_jurusan)->get();
        return view('prodilanding', compact('prodi', 'id_kampus'));
    }

     public function pilihProdi($id_kampus, $id_prodi,)
     
    {
    // dd($id);
    // $kampusId = $id->input('kampus_id');

    // Simpan ke session
    //  session()->flash('kampus_id', $kampusId);
    return redirect()->route('dashboard.welcome', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi, ]);
    }



}
