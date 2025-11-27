@extends('admin.beranda')

@section('content')

<style>
:root {
    --primary: #0d6efd;
    --secondary: #6c757d;
    --success: #198754;
    --danger: #dc3545;
    --light: #f8f9fa;
    --dark: #212529;
    --border-radius: 8px;
    --box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    --transition: all 0.2s ease;
}

.dashboard-content {
    background-color: #fff;
    padding: 2rem;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    max-width: 700px;
    margin: 2rem auto;
    transition: var(--transition);
}

.dashboard-content h2 {
    font-weight: 700;
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
    color: var(--dark);
}

.detail-item {
    margin-bottom: 1rem;
    font-size: 1rem;
    line-height: 1.6;
}

.detail-item strong {
    display: inline-block;
    width: 120px;
    color: var(--dark);
}

.btn {
    border-radius: var(--border-radius);
    padding: 0.6rem 1.2rem;
    font-weight: 500;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    cursor: pointer;
    text-decoration: none;
    color: #fff;
    background-color: var(--secondary);
    border: none;
}

.btn:hover {
    background-color: #5c636a;
}

@media (max-width: 576px) {
    .dashboard-content {
        padding: 1.5rem;
        margin: 1rem;
    }

    .dashboard-content h2 {
        font-size: 1.5rem;
    }

    .detail-item strong {
        width: 100%;
        margin-bottom: 0.2rem;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="dashboard-content">
  <h2>Detail Produk</h2>
  <div class="detail-item"><strong>Nama:</strong> {{ $produk->nama }}</div>
  <div class="detail-item"><strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
  <div class="detail-item"><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</div>
  <div class="detail-item"><strong>Kategori:</strong> {{ $produk->kategori->nama }}</div>
  <div class="detail-item"><strong>Toko:</strong> {{ $produk->toko->nama }}</div>
  <a href="{{ route('admin.produk.index') }}" class="btn">Kembali</a>
</div>
@endsection
