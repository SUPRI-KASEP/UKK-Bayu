@extends('admin.beranda')

@section('content')
<div class="component-content fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-plus"></i> Tambah User Baru</h2>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Member</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section untuk Member (akan muncul hanya jika role member dipilih) -->
                <div id="member-section" style="display: none;">
                    <hr>
                    <h5 class="mb-4"><i class="bi bi-shop"></i> Informasi Toko Member</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="toko_nama" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control @error('toko_nama') is-invalid @enderror"
                                       id="toko_nama" name="toko_nama" value="{{ old('toko_nama') }}">
                                @error('toko_nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="toko_alamat" class="form-label">Alamat Toko</label>
                                <textarea class="form-control @error('toko_alamat') is-invalid @enderror"
                                          id="toko_alamat" name="toko_alamat" rows="2">{{ old('toko_alamat') }}</textarea>
                                @error('toko_alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Kategori yang Dijual</label>
                                <div class="row">
                                    @foreach($kategoris as $kategori)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="kategori_ids[]"
                                                   value="{{ $kategori->id }}"
                                                   id="kategori_{{ $kategori->id }}"
                                                   {{ in_array($kategori->id, old('kategori_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="kategori_{{ $kategori->id }}">
                                                {{ $kategori->nama }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @error('kategori_ids')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan User
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
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const memberSection = document.getElementById('member-section');

        function toggleMemberSection() {
            if (roleSelect.value === 'user') {
                memberSection.style.display = 'block';
                // Buat field toko_nama required
                document.getElementById('toko_nama').required = true;
                document.getElementById('toko_alamat').required = true;
            } else {
                memberSection.style.display = 'none';
                // Hapus required dari field toko
                document.getElementById('toko_nama').required = false;
                document.getElementById('toko_alamat').required = false;
            }
        }

        // Initial check
        toggleMemberSection();

        // Event listener untuk perubahan role
        roleSelect.addEventListener('change', toggleMemberSection);

        // Jika ada error dan role adalah user, pastikan section member terbuka
        @if(old('role') == 'user' || $errors->has('toko_nama') || $errors->has('toko_alamat') || $errors->has('kategori_ids'))
            memberSection.style.display = 'block';
        @endif
    });
</script>

<style>
    .form-label {
        font-weight: 500;
        color: var(--judul);
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 10px 12px;
        background-color: var(--card-bg);
        color: var(--text);
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .card {
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 12px;
    }

    .form-check-input:checked {
        background-color: var(--accent);
        border-color: var(--accent);
    }

    .form-check-label {
        color: var(--text);
    }

    hr {
        border-color: var(--border);
        opacity: 0.5;
    }
</style>
@endsection
