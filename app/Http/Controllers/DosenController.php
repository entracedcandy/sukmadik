<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Pengajuan_bimbingan;



class DosenController extends Controller
{
   public function showLoginForm(request $request, $id_kampus, $id_prodi)
    {
        return view('dosen.login', compact('id_kampus', 'id_prodi'));
    }

    public function login(Request $request, $id_kampus, $id_prodi)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['level'] = 2;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dosen.dashboard', [
                'id_kampus' => $id_kampus,
                'id_prodi' => $id_prodi,
            ]));

        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request, $id_kampus, $id_prodi)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.dosen',[
                'id_kampus' => $id_kampus,
                'id_prodi' => $id_prodi,
            ]);
    }

    public function dashboard(request $request, $id_kampus, $id_prodi)
    {
        $user = Auth::user();

        $id_user = $user->id_user;

        $filterStatus = 1;

         $jadwalkuliah = User::with([
        'detail_jadwal' => function ($q) use ($filterStatus) {
            $q->whereHas('jadwal', function ($sub) use ($filterStatus) {
                $sub->where('status', $filterStatus);
            })
            ->orderBy('id_ruangan') 
            ->orderBy('id_sesi');  
        },
        'detail_jadwal.jadwal',
        'detail_jadwal.matkul.pengampuutama',
        'detail_jadwal.matkul.pengampukedua',
        'detail_jadwal.golongan',
        'detail_jadwal.ruangan',
        'detail_jadwal.sesi',
        ])
        ->where('level', 2)
        ->where('id_prodi', $id_prodi)
        ->where('id_user', $id_user)
        ->get();


        $jadwalbimbingan = User::with([
                           'detail_bimbingan' => function ($q) use ($filterStatus) {
                               $q->whereHas('jadwal', function ($sub) use ($filterStatus) {
                                   $sub->where('status', $filterStatus);
                               })
                               ->orderBy('id_sesi');
                           },
                           'detail_bimbingan.jadwal.user',
                           'detail_bimbingan.sesi',
                           'detail_bimbingan.golongan',
                           'detail_bimbingan.semester',
                       ])
                       ->where('level', 2) 
                       ->where('id_prodi', $id_prodi) 
                       ->where('id_user', $id_user)
                       ->get();

    $gabungan = collect();

    // Gabungkan detail_jadwal dari semua user
    foreach ($jadwalkuliah as $user) {
        foreach ($user->detail_jadwal as $item) {
            $gabungan->push($item);
        }
    }

    // Gabungkan detail_bimbingan dari semua user
    foreach ($jadwalbimbingan as $user) {
        foreach ($user->detail_bimbingan as $item) {
            $gabungan->push($item);
        }
    }

    // Kelompokkan berdasarkan hari dari relasi jadwal
    $query = $gabungan->groupBy(fn($item) => optional($item->jadwal)->hari);

        return view('dosen.dashboard',[
        'query' => $query,
        'id_kampus' => $id_kampus,
        'id_prodi' => $id_prodi,
        'user' => $user

    ]);
        
    }

     public function bimbingan (Request $request, $id_kampus, $id_prodi)
    {
        
     return view('dosen.bimbingan',[
        
        'id_kampus' => $id_kampus,
        'id_prodi' => $id_prodi,

    ]);
    }


}
