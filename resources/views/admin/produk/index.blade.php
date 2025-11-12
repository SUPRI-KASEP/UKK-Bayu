@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <h2>Daftar Produk</h2>
  <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Kategori</th>
        <th>Toko</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produks as $produk)
      <tr>
        <td>{{ $produk->id }}</td>
        <td>{{ $produk->nama }}</td>
        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
        <td>{{ $produk->kategori->nama }}</td>
        <td>{{ $produk->toko->nama }}</td>
        <td>
          <a href="{{ route('admin.produk.show', $produk) }}" class="btn btn-info">Lihat</a>
          <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
