@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <h2>Daftar User</h2>
  <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Tambah User</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          <a href="{{ route('admin.user.show', $user) }}" class="btn btn-info">Lihat</a>
          <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('admin.user.destroy', $user) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
