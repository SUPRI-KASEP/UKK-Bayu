@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Edit Kategori</h2>
  <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" value="{{ $kategori->nama }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
