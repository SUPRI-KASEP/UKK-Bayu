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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.user.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dasar user
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:user,admin',
        ]);

        // Jika role adalah user, validasi field toko jika diisi
        if ($request->role === 'user' && $request->filled('toko_nama')) {
            $request->validate([
                'toko_nama' => 'required|string|max:255',
                'toko_alamat' => 'required|string',
                'kategori_ids' => 'required|array|min:1',
                'kategori_ids.*' => 'exists:kategoris,id',
            ]);
        }

        DB::transaction(function () use ($request) {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Jika user adalah member dan toko diisi, buat toko untuknya
            if ($request->role === 'user' && $request->filled('toko_nama')) {
                $toko = Toko::create([
                    'nama' => $request->toko_nama,
                    'alamat' => $request->toko_alamat,
                    'user_id' => $user->id,
                ]);

                // Simpan kategori yang dipilih
                if ($request->has('kategori_ids')) {
                    $toko->kategoris()->attach($request->kategori_ids);
                }
            }
        });

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
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

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:user,admin',
        ]);

        // Jika role adalah user dan toko diisi, validasi field toko
        if ($request->role === 'user' && $request->filled('toko_nama')) {
            $request->validate([
                'toko_nama' => 'required|string|max:255',
                'toko_alamat' => 'required|string',
                'kategori_ids' => 'required|array|min:1',
                'kategori_ids.*' => 'exists:kategoris,id',
            ]);
        }

        DB::transaction(function () use ($request, $user) {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            // Handle toko untuk user member
            if ($request->role === 'user') {
                if ($request->filled('toko_nama')) {
                    $toko = $user->toko;

                    if ($toko) {
                        // Update toko yang sudah ada
                        $toko->update([
                            'nama' => $request->toko_nama,
                            'alamat' => $request->toko_alamat,
                        ]);

                        // Update kategori
                        if ($request->has('kategori_ids')) {
                            $toko->kategoris()->sync($request->kategori_ids);
                        }
                    } else {
                        // Buat toko baru
                        $toko = Toko::create([
                            'nama' => $request->toko_nama,
                            'alamat' => $request->toko_alamat,
                            'user_id' => $user->id,
                        ]);

                        // Attach kategori
                        if ($request->has('kategori_ids')) {
                            $toko->kategoris()->attach($request->kategori_ids);
                        }
                    }
                } else {
                    // Jika toko tidak diisi, hapus toko jika ada
                    if ($user->toko) {
                        // Hapus relasi kategori terlebih dahulu
                        $user->toko->kategoris()->detach();
                        $user->toko->delete();
                    }
                }
            } else {
                // Jika role diubah dari user ke admin, hapus toko jika ada
                if ($user->toko) {
                    // Hapus relasi kategori terlebih dahulu
                    $user->toko->kategoris()->detach();
                    $user->toko->delete();
                }
            }
        });

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
