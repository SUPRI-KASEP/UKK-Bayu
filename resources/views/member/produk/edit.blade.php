@extends('member.layout')

@section('content')
<div class="container mt-4">

    <h3>Edit Produk</h3>

    <form action="{{ route('member.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
                @foreach($kategoris as $k)
                <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Produk</label><br>
            <img src="{{ asset('storage/'.$produk->gambar) }}" width="80" class="mb-2">
            <input type="file" name="gambar" class="form-control mt-2">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('member.produk') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
