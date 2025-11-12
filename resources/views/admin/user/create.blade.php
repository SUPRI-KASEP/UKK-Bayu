@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Tambah User</h2>
  <form action="{{ route('admin.user.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection
