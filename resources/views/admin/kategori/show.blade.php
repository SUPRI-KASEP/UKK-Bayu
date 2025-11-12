@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Detail Kategori</h2>
  <p><strong>Nama:</strong> {{ $kategori->nama }}</p>
  <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
