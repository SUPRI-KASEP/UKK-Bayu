<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tokos = Toko::all();
        return view('admin.toko.index', compact('tokos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.toko.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create user for the seller
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create toko associated with the user
        Toko::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.toko.index')->with('success', 'Toko dan akun penjual berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $toko = Toko::findOrFail($id);
        return view('admin.toko.show', compact('toko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $toko = Toko::findOrFail($id);
        return view('admin.toko.edit', compact('toko'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $toko = Toko::findOrFail($id);
        $toko->update($request->all());

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toko = Toko::findOrFail($id);
        $toko->delete();

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
