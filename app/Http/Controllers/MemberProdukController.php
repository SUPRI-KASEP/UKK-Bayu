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
        $toko = Auth::user()->toko;

        // Toko belum dibuat
        if (!$toko) {
            return redirect()->route('member.toko')
                ->with('warning', 'Anda harus membuat toko terlebih dahulu.');
        }

        // Toko belum disetujui admin
        if ($toko->status !== 'setuju') {
            return redirect()->route('member.toko')
                ->with('warning', 'Toko Anda belum disetujui admin. Anda belum dapat mengelola produk.');
        }

        $produk = Produk::where('toko_id', $toko->id)->get();
        $kategoris = Kategori::all();

        return view('member.produk.dashboard', compact('produk', 'kategoris'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $toko = Auth::user()->toko;

        if (!$toko || $toko->status !== 'setuju') {
            return redirect()->route('member.toko')
                ->with('warning', 'Toko Anda belum disetujui admin. Tidak dapat menambahkan produk.');
        }

        $kategoris = Kategori::all();
        return view('member.produk.create', compact('kategoris'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $toko = Auth::user()->toko;

        if (!$toko || $toko->status !== 'setuju') {
            return redirect()->route('member.toko')
                ->with('warning', 'Toko Anda belum disetujui admin. Tidak dapat menambahkan produk.');
        }

        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'stok', 'kategori_id']);
        $data['toko_id'] = $toko->id;

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('member.produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Detail produk
     */
    public function show(Produk $produk)
    {
        // Tidak boleh lihat produk toko lain
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        return view('member.produk.show', compact('produk'));
    }

    /**
     * Form edit produk
     */
    public function edit(Produk $produk)
    {
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        $kategoris = Kategori::all();
        return view('member.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update produk
     */
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'stok', 'kategori_id']);

        // Ganti gambar jika ada file baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // Upload gambar baru
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('member.produk')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk
     */
    public function destroy(Produk $produk)
    {
        if ($produk->toko_id !== Auth::user()->toko->id) {
            abort(403);
        }

        // Hapus gambar
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('member.produk')->with('success', 'Produk berhasil dihapus!');
    }
}
