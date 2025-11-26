<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Toko;

class TokoCon extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $toko = $user?->toko;
        return view('member.toko.dashboard', compact('toko'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->toko) {
            return redirect()->route('member.toko')
                ->with('warning', 'Anda sudah memiliki toko.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'kontak' => $validated['kontak'] ?? null,
            'user_id' => $user->id,
            'status' => 'menunggu'
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('toko', 'public');
        }

        Toko::create($data);

        return redirect()->route('member.toko')
            ->with('success', 'Toko berhasil diajukan dan menunggu persetujuan admin.');
    }

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
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $updateData = [
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'kontak' => $validated['kontak'] ?? null,
            'status' => 'menunggu'
        ];

        if ($request->hasFile('gambar')) {
            if ($toko->gambar) {
                Storage::disk('public')->delete($toko->gambar);
            }
            $updateData['gambar'] = $request->file('gambar')->store('toko', 'public');
        }

        $toko->update($updateData);

        return redirect()->route('member.toko')
            ->with('success', 'Toko berhasil diperbarui dan menunggu persetujuan admin.');
    }
}
