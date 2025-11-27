<?php
// routes/web.php

use App\Http\Controllers\AdminBerandaCon;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemBerandaCon;
use App\Http\Controllers\showBerandaCon;
use App\Http\Controllers\MemberProdukController;
use App\Http\Controllers\TokoCon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash; // TAMBAHKAN INI

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Pendaftaran
Route::get('/daftar', [LoginController::class, 'showRegisterForm'])->name('daftar');
Route::post('/daftar', [LoginController::class, 'register'])->name('daftar.post');


// Member Route

    Route::get('/show/produk/{id}', [showBerandaCon::class, 'show'])->name('produk.show');
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/beranda', [MemBerandaCon::class, 'index'])->name('member.beranda');

    // Produk Member
    Route::get('/member/produk', [MemberProdukController::class, 'index'])->name('member.produk');
    Route::get('/member/produk/create', [MemberProdukController::class, 'create'])->name('member.produk.create');
    Route::get('/member/produk/{id}', [MemberProdukController::class, 'show'])->name('member.show');
    Route::post('/member/produk', [MemberProdukController::class, 'store'])->name('member.produk.store');
    Route::get('/member/produk/{id}/edit', [MemberProdukController::class, 'edit'])->name('member.produk.edit');
    Route::put('/member/produk/{id}', [MemberProdukController::class, 'update'])->name('member.produk.update');
    Route::delete('/member/produk/{id}', [MemberProdukController::class, 'destroy'])->name('member.produk.destroy');
    // Toko Member
    Route::get('/member/toko', [TokoCon::class, 'index'])->name('member.toko');
    Route::post('/member/toko', [TokoCon::class, 'store'])->name('member.toko.store');
    Route::put('/member/toko/update', [TokoCon::class, 'update'])->name('member.toko.update');
});

// Admin Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/beranda', [AdminBerandaCon::class, 'index'])->name('admin.beranda');

    Route::get('/admin/pengajuan', [AdminBerandaCon::class, 'pengajuan'])->name('admin.pengajuan');
    Route::post('/admin/toko/{id}/setujui', [AdminBerandaCon::class, 'setujui'])
        ->name('admin.toko.setujui');

    Route::post('/admin/toko/{id}/tolak', [AdminBerandaCon::class, 'tolak'])
        ->name('admin.toko.tolak');

    // Toko routes
    Route::get('admin/toko', [AdminTokoController::class, 'index'])->name('admin.toko.index');
    Route::post('admin/toko', [AdminTokoController::class, 'store'])->name('admin.toko.store');
    Route::get('admin/toko/{toko}', [AdminTokoController::class, 'show'])->name('admin.toko.show');
    Route::get('admin/toko/{toko}/edit', [AdminTokoController::class, 'edit'])->name('admin.toko.edit');
    Route::put('admin/toko/{toko}', [AdminTokoController::class, 'update'])->name('admin.toko.update');
    Route::delete('admin/toko/{toko}', [AdminTokoController::class, 'destroy'])->name('admin.toko.destroy');

    // Kategori routes
    Route::get('admin/kategori', [AdminKategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('admin/kategori/create', [AdminKategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('admin/kategori', [AdminKategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('admin/kategori/{kategori}/edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('admin/kategori/{kategori}', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('admin/kategori/{kategori}', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    // Produk routes
    Route::get('admin/produk', [AdminProdukController::class, 'index'])->name('admin.produk.index');
    Route::post('admin/produk', [AdminProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('admin/produk/{produk}', [AdminProdukController::class, 'show'])->name('admin.produk.show');
    Route::delete('admin/produk/{produk}', [AdminProdukController::class, 'destroy'])->name('admin.produk.destroy');

    // User routes
    Route::get('admin/user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::post('admin/user', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('admin/user/{user}', [AdminUserController::class, 'show'])->name('admin.user.show');
    Route::get('admin/user/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::put('admin/user/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
});
