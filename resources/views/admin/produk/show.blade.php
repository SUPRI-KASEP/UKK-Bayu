@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Detail Produk</h2>
  <p><strong>Nama:</strong> {{ $produk->nama }}</p>
  <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
  <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
  <p><strong>Kategori:</strong> {{ $produk->kategori->nama }}</p>
  <p><strong>Toko:</strong> {{ $produk->toko->nama }}</p>
  <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
