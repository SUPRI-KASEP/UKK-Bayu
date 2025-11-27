@extends('admin.beranda')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
:root {
    --primary: #4361ee;
    --secondary: #3f37c9;
    --success: #4cc9f0;
    --card-bg: #ffffff;
    --border: #e2e8f0;
    --shadow: 0 8px 30px rgba(67, 97, 238, 0.15);
    --shadow-hover: 0 12px 40px rgba(67, 97, 238, 0.25);
    --transition: all 0.3s ease;
}

body {
    background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%);
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.card {
    border-radius: 20px;
    box-shadow: var(--shadow);
    background: var(--card-bg);
    border: 1px solid var(--border);
    transition: var(--transition);
}

.card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

.card-body {
    padding: 2.5rem;
}

.form-label {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 12px;
    border: 2px solid var(--border);
    padding: 1rem 1.2rem;
    font-size: 1rem;
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    background-color: #ffffff;
    transform: translateY(-2px);
}

.is-invalid {
    border-color: #e53e3e !important;
}

.invalid-feedback {
    font-size: 0.85rem;
    color: #e53e3e;
}

.btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 0.9rem 2rem;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
}

.btn-primary {
    background: var(--primary);
    color: white;
    box-shadow: var(--shadow);
    border: none;
}

.btn-primary:hover {
    background: #3654d0;
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
}

.btn-secondary {
    background: #6c757d;
    color: white;
    border: none;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.password-strength {
    height: 4px;
    background: #e2e8f0;
    border-radius: 2px;
    margin-top: 0.5rem;
    overflow: hidden;
}

.password-strength-fill {
    height: 100%;
    width: 0%;
    background: var(--success);
    transition: all 0.3s ease;
}
</style>

<div class="container mt-5">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

                <div class="row mb-3">
                    {{-- Nama --}}
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Username --}}
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                               value="{{ old('username', $user->username) }}" placeholder="Masukkan username" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- Password Baru --}}
                    <div class="col-md-6">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Kosongkan jika tidak ingin diubah">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        <div class="password-strength">
                            <div class="password-strength-fill" id="passwordStrength"></div>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Kosongkan jika tidak ingin diubah">
                    </div>
                </div>

                {{-- Role --}}
                @php
                $roles = ['admin' => 'Admin', 'member' => 'Member'];
                @endphp

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        @foreach($roles as $key => $label)
                            <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update User
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Password strength indicator
    document.querySelector('input[name="password"]').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthFill = document.getElementById('passwordStrength');
        let strength = 0;

        if (password.length > 0) strength += 25;
        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;

        strengthFill.style.width = strength + '%';
        strengthFill.style.background = strength < 50 ? '#e53e3e' : strength < 75 ? '#f8961e' : '#38a169';
    });
</script>
@endsection
