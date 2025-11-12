@extends('admin.beranda')

@section('content')
<style>
  body {
    background-color: #f1f5f9;
    font-family: 'Poppins', sans-serif;
  }

  .dashboard-content {
    background-color: #ffffff;
    padding: 40px 50px;
    border-radius: 18px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
    margin: 30px auto;
    max-width: 1200px;
  }

  h2 {
    font-weight: 700;
    font-size: 2rem;
    color: #1e293b;
  }

  .btn-primary {
    background: linear-gradient(90deg, #2563eb, #3b82f6);
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 500;
    transition: 0.3s;
  }

  .btn-primary:hover {
    background: linear-gradient(90deg, #1d4ed8, #2563eb);
    transform: translateY(-2px);
  }

  .table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    margin-top: 25px;
    font-size: 1.05rem;
  }

  thead {
    background: linear-gradient(90deg, #1e293b, #334155);
    color: #fff;
    font-size: 1.1rem;
  }

  tbody tr {
    transition: 0.2s;
  }

  tbody tr:hover {
    background-color: #f8fafc;
    transform: scale(1.01);
  }

  td, th {
    padding: 16px 20px !important;
    vertical-align: middle;
  }

  .alert-success {
    border-left: 6px solid #22c55e;
    background-color: #dcfce7;
    color: #166534;
    font-weight: 500;
    font-size: 1rem;
    padding: 14px 20px;
    border-radius: 10px;
  }

  .btn {
    border-radius: 10px;
    font-size: 15px;
    padding: 8px 14px;
    font-weight: 500;
    transition: 0.25s;
  }

  .btn-info {
    background-color: #06b6d4;
    border: none;
    color: #fff;
  }

  .btn-warning {
    background-color: #facc15;
    border: none;
    color: #000;
  }

  .btn-danger {
    background-color: #ef4444;
    border: none;
    color: #fff;
  }

  .btn:hover {
    transform: translateY(-2px);
    opacity: 0.9;
  }

  .action-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
  }

  .empty-row {
    font-size: 1.1rem;
    color: #64748b;
  }

  /* Animasi masuk */
  .fade-in {
    animation: fadeIn 0.7s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Responsif */
  @media (max-width: 768px) {
    .dashboard-content {
      padding: 20px 15px;
      margin: 15px auto;
    }

    h2 {
      font-size: 1.5rem;
    }

    .btn-primary {
      padding: 10px 15px;
      font-size: 14px;
    }

    .table {
      font-size: 0.9rem;
    }

    td, th {
      padding: 12px 10px !important;
    }

    .action-buttons {
      flex-direction: column;
      gap: 5px;
    }

    .btn-sm {
      padding: 6px 10px;
      font-size: 12px;
    }
  }

  @media (max-width: 480px) {
    .dashboard-content {
      padding: 15px 10px;
    }

    h2 {
      font-size: 1.3rem;
    }

    .d-flex {
      flex-direction: column;
      align-items: stretch !important;
    }

    .d-flex .btn-primary {
      margin-top: 10px;
    }

    .table-responsive {
      overflow-x: auto;
    }

    .table {
      min-width: 600px;
    }

    .action-buttons {
      flex-direction: row;
      justify-content: flex-start;
    }
  }
</style>

<div class="dashboard-content fade-in">
  @if(session('success'))
    <div class="alert alert-success mb-4">
      <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Daftar User</h2>
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah User
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th style="width: 10%">ID</th>
          <th style="width: 30%">Name</th>
          <th style="width: 40%">Email</th>
          <th class="text-center" style="width: 20%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td><span class="badge bg-secondary px-3 py-2">{{ $user->id }}</span></td>
          <td class="fw-semibold text-dark">{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-center">
            <div class="action-buttons">
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
          <td colspan="4" class="text-center empty-row py-5">Belum ada data user.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
