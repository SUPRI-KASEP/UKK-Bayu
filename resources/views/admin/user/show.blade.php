@extends('admin.beranda')

@section('content')

<style>
    :root {
        --primary: #0d3b66;
        --secondary: #6c757d;
        --light: #f8f9fa;
        --dark: #212529;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        --transition: all 0.2s ease;
        --font-family: 'Inter', sans-serif;
    }

    body {
        font-family: var(--font-family);
        background-color: var(--light);
        color: var(--dark);
    }

    .dashboard-content {
        background: #fff;
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
    }

    h2 {
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        color: var(--primary);
    }

    .user-detail {
        margin-bottom: 1.5rem;
        padding: 1rem 1.2rem;
        background-color: #f1f5f9;
        border-radius: var(--border-radius);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .user-detail strong {
        color: var(--secondary);
    }

    .btn {
        border-radius: var(--border-radius);
        padding: 0.55rem 1.2rem;
        font-weight: 500;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-secondary {
        background-color: var(--secondary);
        color: #fff;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .dashboard-content {
            padding: 1.5rem;
            margin: 1rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        .user-detail {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="dashboard-content">
    <h2>Detail User</h2>
    <div class="user-detail">
        <span><strong>Nama:</strong> {{ $user->name }}</span>
        <span><strong>Username:</strong> {{ $user->username }}</span>
        <span><strong>Role:</strong> {{ ucfirst($user->role) }}</span>
    </div>
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>
</div>
@endsection
