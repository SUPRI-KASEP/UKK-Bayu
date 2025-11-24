@extends('member.layout')

@section('content')
<div class="container mt-4">
    <h3>Tambah Produk</h3>

    <form action="{{ route('member.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
                @foreach($kategoris as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Produk</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('member.produk') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
