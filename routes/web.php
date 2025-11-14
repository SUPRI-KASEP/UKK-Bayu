<?php

use App\Http\Controllers\AdminBerandaCon;
use App\Http\Controllers\AdminLogCon;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BerandaCon;
use App\Http\Controllers\DaftarCon;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaCon::class, 'index'])->name('beranda');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Pendaftaran
Route::get('/pendaftaran', [DaftarCon::class, 'index'])->name('daftar');

// Admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/beranda', [AdminBerandaCon::class, 'index'])->name('admin.beranda');

    // Toko routes
    Route::get('admin/toko', [AdminTokoController::class, 'index'])->name('admin.toko.index');
    Route::get('admin/toko/create', [AdminTokoController::class, 'create'])->name('admin.toko.create');
    Route::post('admin/toko', [AdminTokoController::class, 'store'])->name('admin.toko.store');
    Route::get('admin/toko/{toko}', [AdminTokoController::class, 'show'])->name('admin.toko.show');
    Route::get('admin/toko/{toko}/edit', [AdminTokoController::class, 'edit'])->name('admin.toko.edit');
    Route::post('admin/toko/{toko}', [AdminTokoController::class, 'update'])->name('admin.toko.update');
    Route::delete('admin/toko/{toko}', [AdminTokoController::class, 'destroy'])->name('admin.toko.destroy');

    // Kategori routes
    Route::get('admin/kategori', [AdminKategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('admin/kategori/create', [AdminKategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('admin/kategori', [AdminKategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('admin/kategori/{kategori}', [AdminKategoriController::class, 'show'])->name('admin.kategori.show');
    Route::get('admin/kategori/{kategori}/edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('admin/kategori/{kategori}', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('admin/kategori/{kategori}', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    // Produk routes
    Route::get('admin/produk', [AdminProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('admin/produk/create', [AdminProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('admin/produk', [AdminProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('admin/produk/{produk}', [AdminProdukController::class, 'show'])->name('admin.produk.show');
    Route::get('admin/produk/{produk}/edit', [AdminProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::post('admin/produk/{produk}', [AdminProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('admin/produk/{produk}', [AdminProdukController::class, 'destroy'])->name('admin.produk.destroy');

    // User routes
    Route::get('admin/user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('admin/user/create', [AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('admin/user', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('admin/user/{user}', [AdminUserController::class, 'show'])->name('admin.user.show');
    Route::get('admin/user/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::post('admin/user/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
});
