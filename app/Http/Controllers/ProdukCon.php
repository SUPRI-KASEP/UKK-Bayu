<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukCon extends Controller
{
    // Tampilkan produk milik toko dari member yang login
    public function index()
    {
        $user = Auth::user();
        $produk = collect();
        $kategori = Kategori::all(); // Untuk filter dan form

        if ($user && $user->toko) {
            $produk = $user->toko->produks()->with('kategori')->latest()->get();
        }

        return view('member.produk.dashboard', compact('produk', 'kategori'));
    }

    // Tampilkan form tambah produk
    public function create()
    {
        $user = Auth::user();
        
        if (!$user->toko) {
            return redirect()->route('member.produk.index')
                ->with('error', 'Anda harus memiliki toko terlebih dahulu untuk menambah produk.');
        }

        $kategori = Kategori::all();
        return view('member.produk.create', compact('kategori'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->toko) {
            return redirect()->route('member.produk.index')
                ->with('error', 'Anda harus memiliki toko terlebih dahulu untuk menambah produk.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'diskon' => 'nullable|integer|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $gambarPath = null;
            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('produk', 'public');
            }

            Produk::create([
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'berat' => $request->berat,
                'diskon' => $request->diskon ?? 0,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarPath,
                'toko_id' => $user->toko->id
            ]);

            return redirect()->route('member.produk.index')
                ->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Tampilkan detail produk
    public function show($id)
    {
        $user = Auth::user();
        
        if (!$user->toko) {
            return redirect()->route('member.produk.index')
                ->with('error', 'Anda harus memiliki toko terlebih dahulu.');
        }

        $produk = Produk::with('kategori')
            ->where('toko_id', $user->toko->id)
            ->findOrFail($id);

        return view('member.produk.show', compact('produk'));
    }

    // Tampilkan form edit produk
    public function edit($id)
    {
        $user = Auth::user();
        
        if (!$user->toko) {
            return redirect()->route('member.produk.index')
                ->with('error', 'Anda harus memiliki toko terlebih dahulu.');
        }

        $produk = Produk::where('toko_id', $user->toko->id)
            ->findOrFail($id);
        $kategori = Kategori::all();

        return view('member.produk.edit', compact('produk', 'kategori'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        if (!$user->toko) {
            return redirect()->route('member.produk.index')
                ->with('error', 'Anda harus memiliki toko terlebih dahulu.');
        }

        $produk = Produk::where('toko_id', $user->toko->id)
            ->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'diskon' => 'nullable|integer|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $data = [
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'berat' => $request->berat,
                'diskon' => $request->diskon ?? 0,
                'deskripsi' => $request->deskripsi,
            ];

            // Update gambar jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($produk->gambar) {
                    Storage::disk('public')->delete($produk->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('produk', 'public');
            }

            $produk->update($data);

            return redirect()->route('member.produk.index')
                ->with('success', 'Produk berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Hapus produk
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (!$user->toko) {
            return redirect()->route('member.produk.index')
                ->with('error', 'Anda harus memiliki toko terlebih dahulu.');
        }

        try {
            $produk = Produk::where('toko_id', $user->toko->id)
                ->findOrFail($id);

            // Hapus gambar jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $produk->delete();

            return redirect()->route('member.produk.index')
                ->with('success', 'Produk berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}