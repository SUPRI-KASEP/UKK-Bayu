<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminBerandaCon extends Controller
{
    //
    public function index() {
        return view('admin.beranda');
    }
}
