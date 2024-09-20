<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$levels  Level pengguna yang diizinkan
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Memeriksa apakah pengguna sudah login
        if (Auth::check()) {
            // Memeriksa apakah level pengguna ada dalam daftar level yang diizinkan
            if (in_array(Auth::user()->level, $levels)) {
                return $next($request);
            }
        }

        // Jika level pengguna tidak sesuai, arahkan ke halaman yang diinginkan
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
