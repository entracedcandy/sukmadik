<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Onlyadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $id_kampus = $request->route('id_kampus');
        $id_prodi = $request->route('id_prodi');
        if (Auth::check() && Auth::user()->level == 1) {
            return $next($request); 
        }


        return redirect(route('formlogin.admin', ['id_kampus' => $id_kampus, 'id_prodi' => $id_prodi]))->with('error', 'Akses hanya untuk dosen.');
    }
}
