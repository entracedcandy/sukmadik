<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthDosenController extends Controller
{
    public function showLoginForm($id_kampus, $id_prodi)
    {
        return view('dosen.login', compact('id_kampus', 'id_prodi')); // ganti dengan nama blade login kamu
    }

    public function login($id_kampus, $id_prodi, Request $request)
    {


        $credentials = $request->only('email', 'password');

        // Asumsi dosen disimpan dalam tabel users dengan role = 'dosen'
        $user = User::where('email', $credentials['email'])
                    ->where('level', '2')
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->intended(route('dosen.d', [$id_kampus, $id_prodi]));

        }
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout($id_kampus, $id_prodi, Request $request): RedirectResponse
    {
        Auth::logout($user);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.dosen', [$id_kampus, $id_prodi]);
    }
}
