@extends('member.layout')

@section('content')
    <style>
        .card:hover { box-shadow: 0 6px 16px rgba(0,0,0,0.08); }
        .store-cover { height: 220px; object-fit: cover; border-radius: .5rem; }
    </style>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Toko Saya</h1>
                    <p class="text-muted mb-0">Kelola informasi toko Anda</p>
                </div>
                <a href="{{ route('member.beranda') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(!$toko)
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Daftarkan Toko</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('member.toko.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Toko</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" value="{{ old('kontak') }}" class="form-control" placeholder="Nomor telepon/WhatsApp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar/Logo Toko</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <small class="text-muted">Format: jpeg, png, jpg, gif, webp. Maks 2MB</small>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-1"></i> Simpan & Buat Toko
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-pen-to-square me-2"></i>Edit Informasi Toko</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('member.toko.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Nama Toko</label>
                                    <input type="text" name="nama" value="{{ old('nama', $toko->nama) }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $toko->alamat) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" value="{{ old('kontak', $toko->kontak) }}" class="form-control" placeholder="Nomor telepon/WhatsApp">
                                    <small class="text-muted">Isi nomor telepon atau kontak lainnya</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar/Logo Toko</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <small class="text-muted d-block mb-2">Kosongkan jika tidak ingin mengubah gambar.</small>
                                    <div>
                                        <img class="img-fluid store-cover" src="{{ $toko->gambar ? asset('storage/'.$toko->gambar) : 'https://via.placeholder.com/1200x400?text=Logo+Toko' }}" alt="Gambar Toko">
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Ringkasan</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <img class="img-fluid store-cover" src="{{ $toko->gambar ? asset('storage/'.$toko->gambar) : 'https://via.placeholder.com/1200x400?text=Logo+Toko' }}" alt="Gambar Toko">
                            </div>
                            <div class="mb-2"><strong>Nama:</strong> {{ $toko->nama }}</div>
                            <div class="mb-2"><strong>Alamat:</strong> {{ $toko->alamat }}</div>
                            <div class="mb-0"><strong>Kontak:</strong> {{ $toko->kontak ?: 'Tidak ada' }}</div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Aksi</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('member.produk') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-box me-1"></i> Kelola Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection