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
        
        // Cek jika tabel kategori ada
        if (\Schema::hasTable('kategori')) {
            $kategori = Kategori::all();
        } else {
            $kategori = collect();
        }

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

        // Cek jika tabel kategori ada
        if (\Schema::hasTable('kategori')) {
            $kategori = Kategori::all();
        } else {
            $kategori = collect();
        }

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

        // Validasi conditional berdasarkan ada/tidaknya tabel kategori
        $validationRules = [
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'diskon' => 'nullable|integer|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Jika tabel kategori ada, tambahkan validasi untuk kategori_id
        if (\Schema::hasTable('kategori')) {
            $validationRules['kategori_id'] = 'required|exists:kategori,id';
        } else {
            $validationRules['kategori_id'] = 'nullable';
        }

        $request->validate($validationRules);

        try {
            $gambarPath = null;
            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('produk', 'public');
            }

            $data = [
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'diskon' => $request->diskon ?? 0,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarPath,
                'toko_id' => $user->toko->id
            ];

            // Jika tabel kategori ada, tambahkan kategori_id
            if (\Schema::hasTable('kategori')) {
                $data['kategori_id'] = $request->kategori_id;
            }

            Produk::create($data);

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

        $produk = Produk::when(\Schema::hasTable('kategori'), function ($query) {
                return $query->with('kategori');
            })
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

        // Cek jika tabel kategori ada
        if (\Schema::hasTable('kategori')) {
            $kategori = Kategori::all();
        } else {
            $kategori = collect();
        }

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

        // Validasi conditional berdasarkan ada/tidaknya tabel kategori
        $validationRules = [
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'diskon' => 'nullable|integer|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Jika tabel kategori ada, tambahkan validasi untuk kategori_id
        if (\Schema::hasTable('kategori')) {
            $validationRules['kategori_id'] = 'required|exists:kategori,id';
        } else {
            $validationRules['kategori_id'] = 'nullable';
        }

        $request->validate($validationRules);

        try {
            $data = [
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'diskon' => $request->diskon ?? 0,
                'deskripsi' => $request->deskripsi,
            ];

            // Jika tabel kategori ada, tambahkan kategori_id
            if (\Schema::hasTable('kategori')) {
                $data['kategori_id'] = $request->kategori_id;
            }

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