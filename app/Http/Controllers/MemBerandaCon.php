<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemBerandaCon extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $toko = $user->toko;
        
        if (!$toko) {
            return redirect()->route('member.toko')->with('warning', 'Anda harus memiliki toko terlebih dahulu.');
        }

        $produk = $toko->produks ?? collect();
        $kategoris = Kategori::all();

        return view('member.beranda', compact('toko', 'produk', 'kategoris'));

    }
}
