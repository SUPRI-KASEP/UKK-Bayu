<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberProdukController extends Controller
{
    /**
     * Menampilkan daftar produk milik toko member
     */
    public function index()
    {
        $user = Auth::user();
        $toko = $user->toko;

        // Toko belum dibuat - redirect ke beranda dengan warning
        if (!$toko) {
            return redirect()->route('member.beranda')
                ->with('warning', 'Anda harus membuat toko terlebih dahulu untuk mengelola produk.');
        }

        // Toko belum disetujui admin
        if ($toko->status !== 'setuju') {
            return redirect()->route('member.beranda')
                ->with('warning', 'Toko Anda belum disetujui admin. Anda belum dapat mengelola produk.');
        }

        // Eager loading untuk optimasi query
        $produk = Produk::with('kategori')
                    ->where('toko_id', $toko->id)
                    ->latest()
                    ->get();

        $kategoris = Kategori::all();

        return view('member.produk.dashboard', compact('produk', 'kategoris', 'toko'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) {
            return redirect()->route('member.beranda')
                ->with('warning', 'Anda harus membuat toko terlebih dahulu.');
        }

        if ($toko->status !== 'setuju') {
            return redirect()->route('member.beranda')
                ->with('warning', 'Toko Anda belum disetujui admin. Tidak dapat menambahkan produk.');
        }

        $kategoris = Kategori::all();
        return view('member.produk.create', compact('kategoris', 'toko'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) {
            return redirect()->route('member.beranda')
                ->with('warning', 'Anda harus membuat toko terlebih dahulu.');
        }

        if ($toko->status !== 'setuju') {
            return redirect()->route('member.beranda')
                ->with('warning', 'Toko Anda belum disetujui admin. Tidak dapat menambahkan produk.');
        }

        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required|min:10',
            'harga' => 'required|numeric|min:1000',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id', 
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama.required' => 'Nama produk wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'harga.min' => 'Harga minimal Rp 1.000',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
        ]);

        try {
            $data = $request->only(['nama', 'deskripsi', 'harga', 'stok', 'kategori_id']);
            $data['toko_id'] = $toko->id;

            // Upload gambar
            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('produk', 'public');
            }

            Produk::create($data);

            return redirect()->route('member.produk')
                ->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Detail produk
     */
    public function show($id)
    {
        $user = Auth::user();
        $toko = $user->toko;


        $produk = Produk::with(['kategori', 'toko'])
                    ->whereHas('toko', function($query) {
                         $query->where('status', 'setuju');
                    })
                    ->findOrFail($id);

        return view('member.show', compact('produk', 'toko', 'user'));
    }

    /**
     * Form edit produk
     */
    public function edit($id)
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) {
            abort(403, 'Anda tidak memiliki toko.');
        }

        $produk = Produk::findOrFail($id);

        // Validasi kepemilikan produk
        if ($produk->toko_id !== $toko->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        $kategoris = Kategori::all();
        return view('member.produk.edit', compact('produk', 'kategoris', 'toko'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) {
            abort(403, 'Anda tidak memiliki toko.');
        }

        $produk = Produk::findOrFail($id);

        // Validasi kepemilikan produk
        if ($produk->toko_id !== $toko->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required|min:10',
            'harga' => 'required|numeric|min:1000',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama.required' => 'Nama produk wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'harga.min' => 'Harga minimal Rp 1.000',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
        ]);

        try {
            $data = $request->only(['nama', 'deskripsi', 'harga', 'stok', 'kategori_id']);

            // Ganti gambar jika ada file baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($produk->gambar) {
                    Storage::disk('public')->delete($produk->gambar);
                }

                // Upload gambar baru
                $data['gambar'] = $request->file('gambar')->store('produk', 'public');
            }

            $produk->update($data);

            return redirect()->route('member.produk')
                ->with('success', 'Produk berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus produk
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $toko = $user->toko;

        if (!$toko) {
            abort(403, 'Anda tidak memiliki toko.');
        }

        $produk = Produk::findOrFail($id);

        // Validasi kepemilikan produk
        if ($produk->toko_id !== $toko->id) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        try {

            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $produk->delete();

            return redirect()->route('member.produk')
                ->with('success', 'Produk berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('member.produk')
                ->with('error', 'Terjadi kesalahan saat menghapus produk: ' . $e->getMessage());
        }
    }
}
