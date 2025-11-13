@extends('admin.beranda')

@section('content')
<div class="component-content fade-in">
  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-box-seam"></i> Daftar Produk</h2>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Produk
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th style="width: 8%">ID</th>
          <th style="width: 20%">Nama</th>
          <th style="width: 15%">Harga</th>
          <th style="width: 15%">Kategori</th>
          <th style="width: 15%">Toko</th>
          <th class="text-center" style="width: 27%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($produks as $produk)
        <tr>
          <td><span class="badge">{{ $produk->id }}</span></td>
          <td class="fw-semibold">{{ $produk->nama }}</td>
          <td class="fw-bold text-success">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
          <td><span class="badge bg-info">{{ $produk->kategori->nama }}</span></td>
          <td><span class="badge bg-warning text-dark">{{ $produk->toko->nama }}</span></td>
          <td class="text-center">
            <div class="action-buttons">
              <a href="{{ route('admin.produk.show', $produk) }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye"></i> Lihat
              </a>
              <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center empty-row py-5">Belum ada data produk.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
