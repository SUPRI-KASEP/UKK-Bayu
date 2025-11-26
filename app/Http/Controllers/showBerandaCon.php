<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class showBerandaCon extends Controller
{
    //
    public function show(Produk $produk)
    {
        // $produk = Produk::all();
        return view('member.show', compact('produk'));
    }
}
