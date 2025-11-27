@extends('admin.beranda')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    :root {
        --primary: #0d6efd;
        --secondary: #6c757d;
        --success: #198754;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #212529;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        --transition: all 0.2s ease;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: var(--light);
        color: var(--dark);
        line-height: 1.6;
    }

    .component-content {
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
        margin-top: 1.5rem;
        transition: var(--transition);
    }

    .component-content:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    h2 {
        color: var(--dark);
        font-weight: 700;
        font-size: 1.75rem;
        margin: 0;
    }

    .btn-primary {
        background-color: var(--primary);
        border: none;
        border-radius: 6px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .btn-info {
        background-color: #0dcaf0;
        color: #fff;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-danger {
        background-color: var(--danger);
        color: #fff;
    }

    .table-responsive {
        margin-top: 1.5rem;
        box-shadow: var(--box-shadow);
        border-radius: var(--border-radius);
        overflow: hidden;
        background: #fff;
    }

    .table thead {
        background-color: var(--primary);
        color: #fff;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        background-color: var(--secondary);
        color: #fff;
        font-size: 0.85rem;
        border-radius: 50px;
        padding: 0.4rem 0.8rem;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .empty-row {
        text-align: center;
        font-style: italic;
        color: var(--secondary);
        padding: 2rem 0;
    }

    @media (max-width: 768px) {
        .table thead {
            display: none;
        }

        .table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--secondary);
        }
    }
</style>

<div class="component-content">
    @if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-tags"></i> Daftar Kategori</h2>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th style="width: 10%">ID</th>
                <th style="width: 70%">Nama</th>
                <th class="text-center" style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $kategori)
            <tr>
                <td data-label="ID"><span class="badge">{{ $kategori->id }}</span></td>
                <td data-label="Nama" class="fw-semibold">{{ $kategori->nama }}</td>
                <td data-label="Aksi">
                    <div class="action-buttons">
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="empty-row">Belum ada data kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
