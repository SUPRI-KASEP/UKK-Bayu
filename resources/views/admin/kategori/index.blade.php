@extends('admin.beranda')

@section('content')
<div class="component-content fade-in">
  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-tags"></i> Daftar Kategori</h2>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th style="width: 10%">ID</th>
          <th style="width: 70%">Nama</th>
          <th class="text-center" style="width: 20%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kategoris as $kategori)
        <tr>
          <td><span class="badge">{{ $kategori->id }}</span></td>
          <td class="fw-semibold">{{ $kategori->nama }}</td>
          <td class="text-center">
            <div class="action-buttons">
              <a href="{{ route('admin.kategori.show', $kategori) }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye"></i> Lihat
              </a>
              <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center empty-row py-5">Belum ada data kategori.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
