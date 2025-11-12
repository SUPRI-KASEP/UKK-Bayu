@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Tambah Kategori</h2>
  <form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
