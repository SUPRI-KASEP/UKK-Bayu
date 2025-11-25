@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Detail Toko</h2>
  <p><strong>Nama:</strong> {{ $toko->nama }}</p>
  <p><strong>Alamat:</strong> {{ $toko->alamat }}</p>
  <p><strong>Kontak:</strong> {{ $toko->kontak }}</p>
  <a href="{{ route('admin.toko.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
