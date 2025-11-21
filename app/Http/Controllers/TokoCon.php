<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokoCon extends Controller
{
    //
    public function index() {
        return view('member.toko.dashboard');
    }
}
