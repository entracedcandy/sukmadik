<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;



class AdminController extends Controller
{
     public function showLoginForm(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.login', compact('id_kampus', 'id_prodi'));
    }

    public function login(Request $request, $id_kampus, $id_prodi)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        

        $credentials['level']= 1;
        $credentials['id_prodi']= $id_prodi;
        



        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard', [
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
        return redirect()->route('login.admin',[
                'id_kampus' => $id_kampus,
                'id_prodi' => $id_prodi,
            ]);
    }

    public function dashboard(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.dashboard',[
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
        ]);
    }

    public function kampus(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.kampus',[
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
        ]);
    }

        public function jurusan(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.jurusan',[
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
        ]);
    }

        public function prodi(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.prodi',[
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
        ]);
    }

            public function sesi(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.jam',[
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
        ]);
    }

                public function matkul(request $request, $id_kampus, $id_prodi)
    {
        return view('admin.matkul',[
            'id_kampus' => $id_kampus,
            'id_prodi' => $id_prodi,
        ]);
    }
}
