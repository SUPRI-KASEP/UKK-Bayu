<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Toko;

class TokoCon extends Controller
{
    // Halaman toko member: tampilkan form create jika belum ada, atau form edit jika sudah ada
    public function index()
    {
        $user = Auth::user();
        $toko = $user?->toko;
        return view('member.toko.dashboard', compact('toko'));
    }

    // Simpan toko baru untuk member (maksimal 1 toko per user)
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->toko) {
            return redirect()->route('member.toko')->with('warning', 'Anda sudah memiliki toko.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'user_id' => $user->id,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('toko', 'public');
        }

        Toko::create($data);

        return redirect()->route('member.toko')->with('success', 'Toko berhasil dibuat.');
    }

    // Update toko milik member termasuk gambar toko
    public function update(Request $request)
    {
        $user = Auth::user();
        $toko = $user->toko;
        if (!$toko) {
            return redirect()->route('member.toko')->with('warning', 'Anda belum memiliki toko.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $updateData = [
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
        ];

        if ($request->hasFile('gambar')) {
            if ($toko->gambar) {
                Storage::disk('public')->delete($toko->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('toko', 'public');
        }

        $toko->update($updateData);

        return redirect()->route('member.toko')->with('success', 'Toko berhasil diperbarui.');
    }
}
