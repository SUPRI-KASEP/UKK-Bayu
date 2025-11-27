<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::with('kategori', 'toko')->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function show(string $id)
    {
        $produk = Produk::with('kategori', 'toko')->findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }


    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
