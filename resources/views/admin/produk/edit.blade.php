@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Edit Produk</h2>
  <form action="{{ route('admin.produk.update', $produk) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" value="{{ $produk->nama }}" required>
    </div>
    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="number" name="harga" id="harga" class="form-control" value="{{ $produk->harga }}" required>
    </div>
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $produk->deskripsi }}</textarea>
    </div>
    <div class="form-group">
      <label for="kategori_id">Kategori</label>
      <select name="kategori_id" id="kategori_id" class="form-control" required>
        @foreach($kategoris as $kategori)
          <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="toko_id">Toko</label>
      <select name="toko_id" id="toko_id" class="form-control" required>
        @foreach($tokos as $toko)
          <option value="{{ $toko->id }}" {{ $produk->toko_id == $toko->id ? 'selected' : '' }}>{{ $toko->nama }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
