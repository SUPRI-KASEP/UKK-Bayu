<?php
// app/Http/Middleware/LoginAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LoginAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            Session::flash('error', 'Silakan login terlebih dahulu.');
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'admin') {
            Session::flash('error', 'Akses ditolak. Hanya untuk admin.');
            return redirect()->route('beranda');
        }

        return $next($request);
    }
}