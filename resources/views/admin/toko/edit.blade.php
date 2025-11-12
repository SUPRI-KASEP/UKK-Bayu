@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Edit Toko</h2>
  <form action="{{ route('admin.toko.update', $toko) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" value="{{ $toko->nama }}" required>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" id="alamat" class="form-control" required>{{ $toko->alamat }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
