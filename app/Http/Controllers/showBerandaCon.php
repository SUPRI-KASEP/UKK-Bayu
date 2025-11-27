<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class showBerandaCon extends Controller
{

    public function show($id)
    {
        $produk = Produk::with(['kategori', 'toko'])
                    ->whereHas('toko', function($query) {
                        $query->where('status', 'setuju');
                    })
                    ->findOrFail($id);

        return view('show', compact('produk'));
    }
}
