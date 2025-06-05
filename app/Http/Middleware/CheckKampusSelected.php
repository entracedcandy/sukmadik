<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckKampusSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
       public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('kampus_id')) {
            // Jika 'kampus_id' tidak ada di session, redirect ke halaman pemilihan kampus
            return redirect()->route('landing')->with('warning', 'Silakan pilih kampus terlebih dahulu.');
        }

        return $next($request);
    }
}
