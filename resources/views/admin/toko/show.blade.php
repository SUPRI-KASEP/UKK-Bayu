@extends('admin.beranda')

@section('content')

<style>
    .dashboard-content {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        animation: fadeIn .5s ease;
        max-width: 650px;
        margin: auto;
    }

    h2 {
        font-weight: 700;
        color: #3f37c9;
        margin-bottom: 20px;
        text-align: center;
    }

    p {
        font-size: 16px;
        padding: 10px 15px;
        background: #f8f9ff;
        border-left: 4px solid #4361ee;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    strong {
        color: #3a3a3a;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.25s;
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
        transform: translateY(-2px);
    }
</style>

<div class="dashboard-content">
  <h2>Detail Toko</h2>

  <p><strong>Nama:</strong> {{ $toko->nama }}</p>
  <p><strong>Alamat:</strong> {{ $toko->alamat }}</p>
  <a href="{{ route('admin.toko.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@endsection
