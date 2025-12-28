<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect('login');
        }

        // Cek kolom jabatan sesuai struktur database Anda
        if (auth()->user()->jabatan === $role) {
            return $next($request);
        }

        // Jika ditolak, kirim pesan error ke dashboard
        return redirect('/dashboard')->with('error', 'Akses Ditolak! Jabatan Anda saat ini: ' . auth()->user()->jabatan);
    }
}