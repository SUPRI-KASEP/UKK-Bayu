@extends('admin.beranda')

@section('content')

{{-- STYLE + BOOTSTRAP --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --secondary: #3f37c9;
        --success: #4cc9f0;
        --danger: #f72585;
        --warning: #f8961e;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --border-radius: 12px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f7fb;
        color: var(--dark);
        line-height: 1.6;
    }

    .component-content {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
        margin-top: 1.5rem;
        transition: var(--transition);
    }

    .alert {
        border-radius: var(--border-radius);
        border: none;
        padding: 1rem 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
        background-color: rgba(76, 201, 240, 0.15);
        color: #0a6c7c;
        border-left: 4px solid var(--success);
    }

    .table-responsive {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }

    .table thead {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
    }

    .badge {
        background-color: var(--primary-light);
        color: white;
        font-weight: 500;
        padding: 0.5rem 0.8rem;
        border-radius: 50px;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.85rem;
        border: none;
    }

    .btn-info {
        background-color: var(--success);
        color: white;
    }
    .btn-info:hover { background-color: #3ab0d6; transform: translateY(-2px); }

    .btn-warning {
        background-color: var(--warning);
        color: white;
    }
    .btn-warning:hover { background-color: #e08617; transform: translateY(-2px); }

    .btn-danger {
        background-color: var(--danger);
        color: white;
    }
    .btn-danger:hover { background-color: #e11473; transform: translateY(-2px); }

    .empty-row {
        color: var(--gray);
        font-style: italic;
        background-color: rgba(0, 0, 0, 0.02);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .table thead { display: none; }
        .table tbody, .table tbody tr, .table tbody td {
            display: block;
            width: 100%;
        }
        .table tbody tr {
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
        }
        .table tbody td {
            padding: 0.8rem 0;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--gray);
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="component-content fade-in">

    @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 8%">ID</th>
                    <th style="width: 22%">Nama</th>
                    <th style="width: 35%">Alamat</th>
                    <th style="width: 15%">Kontak</th>
                    <th class="text-center" style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tokos as $toko)
                <tr>
                    <td data-label="ID"><span class="badge">{{ $toko->id }}</span></td>
                    <td data-label="Nama" class="fw-semibold">{{ $toko->nama }}</td>
                    <td data-label="Alamat">{{ $toko->alamat }}</td>

                    {{-- Kontak --}}
                    <td data-label="Kontak">
                        @if($toko->kontak)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $toko->kontak) }}"
                               target="_blank" class="text-success fw-semibold">
                                <i class="bi bi-telephone"></i> {{ $toko->kontak }}
                            </a>
                        @else
                            <span class="text-muted fst-italic">Tidak ada</span>
                        @endif
                    </td>

                    <td data-label="Aksi" class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('admin.toko.show', $toko->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Lihat
                            </a>

                            <a href="{{ route('admin.toko.edit', $toko->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('admin.toko.destroy', $toko->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center empty-row py-5">
                        Belum ada data toko.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
