<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PenilaiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Dalam middleware atau controller
        if (Auth::guard('penilaiMiddle')->check()) {
            // Logika jika pengguna penilaiMiddle sudah terautentikasi
            return $next($request);
        } else {
            // Redirect atau respons jika autentikasi gagal
            return redirect('/penilai/login');
        }
    }
}