@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Tambah Produk</h2>
  <form action="{{ route('admin.produk.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="number" name="harga" id="harga" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label for="kategori_id">Kategori</label>
      <select name="kategori_id" id="kategori_id" class="form-control" required>
        @foreach($kategoris as $kategori)
          <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="toko_id">Toko</label>
      <select name="toko_id" id="toko_id" class="form-control" required>
        @foreach($tokos as $toko)
          <option value="{{ $toko->id }}">{{ $toko->nama }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
