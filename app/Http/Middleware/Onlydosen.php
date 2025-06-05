<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Onlydosen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->level == 2) {
            return $next($request); // lanjut ke halaman
        }

        // Kalau bukan dosen, redirect atau abort
        return redirect(route('landing'))->with('error', 'Akses hanya untuk dosen.');
    }
}
