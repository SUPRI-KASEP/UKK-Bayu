@extends('admin.beranda')

@section('content')
<div class="dashboard-content">
  <h2>Detail User</h2>
  <p><strong>Name:</strong> {{ $user->name }}</p>
  <p><strong>Usename:</strong> {{ $user->username }}</p>
  <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
