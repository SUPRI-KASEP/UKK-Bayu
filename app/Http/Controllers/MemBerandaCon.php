<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemBerandaCon extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $toko = $user->toko;

        // TIDAK PERLU VALIDASI TOKO - LANGSUNG AMBIL SEMUA PRODUK
        $produk = Produk::with(['kategori', 'toko.user'])
                    ->whereHas('toko', function($query) {
                        $query->where('status', 'setuju'); // Hanya produk dari toko yang disetujui
                    })
                    ->latest()
                    ->get();

        $kategoris = Kategori::all();

        return view('member.beranda', compact('toko', 'produk', 'kategoris', 'user'));
    }
}
