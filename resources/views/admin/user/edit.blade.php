@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Edit User</h2>
  <form action="{{ route('admin.user.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
      <label for="password">Password (leave blank to keep current)</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
