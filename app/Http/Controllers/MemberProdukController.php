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
        $produk = Auth::user()->toko->produk ?? collect();
        return view('member.produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('member.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'kategori_id']);
        $data['toko_id'] = Auth::user()->toko->id;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        // Pastikan produk milik toko user yang sedang login
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        $kategori = Kategori::all();
        return view('member.produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        // Pastikan produk milik toko user yang sedang login
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'kategori_id']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        // Pastikan produk milik toko user yang sedang login
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        // Hapus gambar jika ada
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('member.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
