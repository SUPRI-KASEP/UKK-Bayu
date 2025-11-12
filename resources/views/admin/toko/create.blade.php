@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Tambah Toko</h2>
  <form action="{{ route('admin.toko.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" id="alamat" class="form-control" required></textarea>
    </div>
    <div class="form-group">
      <label for="email">Email Penjual</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
