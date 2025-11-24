<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberProdukController extends Controller
{
    public function index()
    {
        $toko = Auth::user()->toko;

        if (!$toko) {
            return redirect()->route('member.toko')
                    ->with('warning', 'Anda harus memiliki toko terlebih dahulu.');
        }

        $produk = Produk::where('toko_id', $toko->id)->get();
        $kategoris = Kategori::all();

        return view('member.produk.dashboard', compact('produk', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('member.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'stok', 'kategori_id']);
        $data['toko_id'] = Auth::user()->toko->id;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('member.produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        $kategoris = Kategori::all();
        return view('member.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'stok', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('member.produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('member.produk')->with('success', 'Produk berhasil dihapus!');
    }
}
