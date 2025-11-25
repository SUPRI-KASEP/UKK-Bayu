@extends('member.layout')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>{{ $produk->nama }}</h4>
        </div>

        <div class="card-body">
            <img src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/300' }}"
                 class="img-fluid rounded mb-3"
                 style="max-height: 300px; object-fit: cover;">

            <p><strong>Kategori:</strong> {{ $produk->kategori->nama ?? '-' }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p><strong>Stok:</strong> {{ $produk->stok }}</p>
            <p><strong>Deskripsi:</strong></p>
            <p>{{ $produk->deskripsi }}</p>

            <a href="{{ route('member.produk') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
