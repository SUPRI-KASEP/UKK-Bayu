<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Toko;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('toko')->latest()->get();
        return view('admin.user.index', compact('users'),[
            'jumlahToko' => Toko::count(),
            'jumlahKategori' => Kategori::count(),
            'jumlahUser' => User::count()
        ]);
    }


    public function show(string $id)
    {
        $user = User::with(['toko', 'toko.kategoris'])->findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with(['toko', 'toko.kategoris'])->findOrFail($id);
        $kategoris = Kategori::all();

        // Ambil kategori yang sudah dipilih oleh toko user
        $selectedKategoriIds = $user->toko ? $user->toko->kategoris->pluck('id')->toArray() : [];

        return view('admin.user.edit', compact('user', 'kategoris', 'selectedKategoriIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

    // Validasi dasar
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'role' => 'required|in:member,admin',
    ]);

    // Jika password diisi, validasi password dan konfirmasi
    if ($request->filled('password')) {
        $request->validate([
            'password' => ['confirmed', Rules\Password::defaults()],
        ]);
    }

    $data = [
        'name' => $request->name,
        'username' => $request->username,
        'role' => $request->role,
    ];

    // Hanya update password jika diisi
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Cek jika user memiliki toko
        if ($user->toko) {
            // Hapus relasi kategori terlebih dahulu
            $user->toko->kategoris()->detach();
            $user->toko->delete();
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}
