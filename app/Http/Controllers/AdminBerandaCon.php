<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBerandaCon extends Controller
{
    public function index()
    {
        $tokos = Toko::with('user')->get();
    $tokoMenunggu = Toko::where('status', 'menunggu')->count();

    return view('admin.beranda', [
        'tokos' => $tokos,
        'jumlahToko' => Toko::count(),
        'jumlahKategori' => Kategori::count(),
        'jumlahUser' => User::count(),
        'tokoMenunggu' => $tokoMenunggu
    ]);
    }
    public function daftarPengajuan() {
        $toko = Toko::where('status', 'menunggu')->get();
        
        return view('admin.toko.pengajuan', compact('toko'));
    }

    public function pengajuan()
    {
        $toko = Toko::where('status', 'menunggu')->get();
        $tokoMenunggu = $toko->count();

        return view('admin.pengajuan', [
            'toko' => $toko,
            'tokoMenunggu' => $tokoMenunggu
        ]);
    }


    public function setujui($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->update(['status' => 'setuju']);

        return back()->with('success', 'Toko berhasil disetujui.');
    }

    public function tolak($id)
    {
        $toko = Toko::findOrFail($id);

    $toko->update([
        'status' => 'tidak disetujui'
    ]);

    return back()->with('error', 'Toko ditolak.');
    }

}
