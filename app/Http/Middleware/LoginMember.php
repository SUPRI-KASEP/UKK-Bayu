<?php
// app/Http/Middleware/LoginMember.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LoginMember
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            Session::flash('error', 'Silakan login terlebih dahulu.');
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'member') {
            Session::flash('error', 'Akses ditolak. Hanya untuk member.');
            return redirect()->route('beranda');
        }

        return $next($request);
    }
}