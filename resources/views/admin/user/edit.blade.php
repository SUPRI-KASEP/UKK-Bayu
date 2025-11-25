@extends('admin.beranda')

@section('content')
<div class="component-content fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-gear"></i> Edit User</h2>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Nama --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">

                    {{-- Password Baru --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Password (opsional)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>

            </form>
        </div>
    </div>
</div>

<style>
    .form-label { font-weight: 500; color: var(--judul); }
    .card { background-color: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; }
    .form-control {
        border-radius: 8px; 
        background-color: var(--card-bg); 
        border: 1px solid var(--border); 
        padding: 10px 12px;
    }
    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
    }
</style>
@endsection
