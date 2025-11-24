<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index() {
        // Ambil semua produk dengan relasi toko dan kategori
        $produk = Produk::with(['toko', 'kategori'])->get();
        $kategoris = Kategori::all();
        
        return view('beranda', compact('produk', 'kategoris'));
    }
}