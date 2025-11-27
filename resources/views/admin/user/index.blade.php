@extends('admin.beranda')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    :root {
        --primary: #0d3b66;
        --secondary: #6c757d;
        --success: #198754;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #212529;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        --transition: all 0.2s ease;
        --font-family: 'Inter', sans-serif;
    }

    body {
        font-family: var(--font-family);
        background-color: #f8f9fa;
        color: var(--dark);
    }

    .component-content {
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
        margin-top: 2rem;
    }

    .alert-success {
        border-radius: var(--border-radius);
        padding: 1rem 1.2rem;
        border-left: 4px solid var(--success);
        background-color: #e9f7ef;
        color: var(--success);
    }

    .table-responsive {
        margin-top: 1.5rem;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
        background: #fff;
    }

    .table thead {
        background-color: var(--primary);
        color: #fff;
    }

    .table th, .table td {
        padding: 1rem;
        vertical-align: middle;
    }

    .badge {
        background-color: var(--primary);
        color: #fff;
        font-weight: 500;
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        font-size: 0.85rem;
    }

    .user-role-badge {
        background-color: var(--secondary);
        color: #fff;
        padding: 0.3rem 0.7rem;
        border-radius: 12px;
        font-size: 0.75rem;
    }

    .action-buttons .btn {
        border-radius: var(--border-radius);
        padding: 0.45rem 0.9rem;
        font-size: 0.85rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-info { background-color: #0d6efd; color: #fff; }
    .btn-info:hover { background-color: #0b5ed7; }

    .btn-warning { background-color: #ffc107; color: #212529; }
    .btn-warning:hover { background-color: #e0a800; }

    .btn-danger { background-color: #dc3545; color: #fff; }
    .btn-danger:hover { background-color: #bb2d3b; }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary);
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .table thead { display: none; }
        .table tbody, .table tbody tr, .table tbody td {
            display: block;
            width: 100%;
        }
        .table tbody tr {
            margin-bottom: 1rem;
            padding: 1rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
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
        .action-buttons { flex-direction: column; gap: 0.5rem; }
        .action-buttons .btn { width: 100%; }
    }
</style>

<div class="component-content">
    @if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td data-label="ID"><span class="badge">{{ $user->id }}</span></td>
                <td data-label="Nama">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar">{{ strtoupper(substr($user->name,0,1)) }}</div>
                        <div>
                            <div class="fw-semibold">{{ $user->name }}</div>
                            @if($user->role)
                            <span class="user-role-badge">{{ $user->role }}</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td data-label="Email">{{ $user->email }}</td>
                <td data-label="Aksi" class="text-center">
                    <div class="action-buttons justify-content-center">
                        <a href="{{ route('admin.user.show', $user) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center" style="padding:3rem; color: var(--secondary); font-style: italic;">
                    <i class="bi bi-people display-4 d-block mb-3"></i>
                    Belum ada data user.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
@endsection
