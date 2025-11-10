<?php

use App\Http\Controllers\BerandaCon;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaCon::class, 'index'])->name('beranda');
