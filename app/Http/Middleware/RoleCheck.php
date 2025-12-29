<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     * Menggunakan ...$roles agar bisa mengecek lebih dari satu jabatan sekaligus.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        // Cek apakah jabatan user ada di dalam daftar roles yang diizinkan
        if (in_array(auth()->user()->jabatan, $roles)) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Akses Ditolak! Jabatan Anda: ' . auth()->user()->jabatan);
    }
}