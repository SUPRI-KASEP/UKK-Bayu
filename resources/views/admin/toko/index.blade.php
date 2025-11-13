@extends('admin.beranda')

@section('content')
<div class="component-content fade-in">
  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-shop"></i> Daftar Toko</h2>
    <a href="{{ route('admin.toko.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Toko
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th style="width: 10%">ID</th>
          <th style="width: 25%">Nama</th>
          <th style="width: 45%">Alamat</th>
          <th class="text-center" style="width: 20%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tokos as $toko)
        <tr>
          <td><span class="badge">{{ $toko->id }}</span></td>
          <td class="fw-semibold">{{ $toko->nama }}</td>
          <td>{{ $toko->alamat }}</td>
          <td class="text-center">
            <div class="action-buttons">
              <a href="{{ route('admin.toko.show', $toko->id) }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye"></i> Lihat
              </a>
              <a href="{{ route('admin.toko.edit', $toko->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.toko.destroy', $toko->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center empty-row py-5">Belum ada data toko.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
