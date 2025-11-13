@extends('admin.beranda')

@section('content')

<style>
  /* CSS khusus untuk halaman user jika diperlukan */
  .user-role-badge {
    background-color: var(--accent);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
  }
</style>

<div class="component-content fade-in">
  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Daftar User</h2>
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah User
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th style="width: 10%">ID</th>
          <th style="width: 30%">Nama</th>
          <th style="width: 40%">Email</th>
          <th class="text-center" style="width: 20%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td><span class="badge">{{ $user->id }}</span></td>
          <td class="fw-semibold">{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-center">
            <div class="action-buttons">
              <a href="{{ route('admin.user.show', $user) }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye"></i> Lihat
              </a>
              <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.user.destroy', $user) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center empty-row py-5">Belum ada data user.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
