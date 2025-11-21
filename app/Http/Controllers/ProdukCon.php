<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukCon extends Controller
{
    //
    public function index() {
        return view('member.produk.dashboard');
    }
}
