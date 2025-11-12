@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <h2>Daftar Kategori</h2>
  <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kategoris as $kategori)
      <tr>
        <td>{{ $kategori->id }}</td>
        <td>{{ $kategori->nama }}</td>
        <td>
          <a href="{{ route('admin.kategori.show', $kategori) }}" class="btn btn-info">Lihat</a>
          <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
