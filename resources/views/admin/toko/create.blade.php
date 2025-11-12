@extends('admin.beranda')

@section('content')
<style>
  .dashboard-content {
    background-color: #ffffff;
    padding: 40px 50px;
    border-radius: 18px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
    margin: 30px auto;
    max-width: 800px;
  }

  h2 {
    font-weight: 700;
    font-size: 2rem;
    color: #1e293b;
    margin-bottom: 30px;
  }

  .form-group {
    margin-bottom: 25px;
  }

  label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 1rem;
  }

  .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
    background-color: #f9fafb;
  }

  .form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
  }

  textarea.form-control {
    resize: vertical;
    min-height: 100px;
  }

  .btn-primary {
    background: linear-gradient(90deg, #2563eb, #3b82f6);
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s;
  }

  .btn-primary:hover {
    background: linear-gradient(90deg, #1d4ed8, #2563eb);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
  }

  /* Responsif */
  @media (max-width: 768px) {
    .dashboard-content {
      padding: 20px 25px;
      margin: 15px auto;
    }

    h2 {
      font-size: 1.5rem;
      margin-bottom: 20px;
    }

    .form-control {
      padding: 10px 12px;
      font-size: 0.95rem;
    }

    .btn-primary {
      padding: 10px 25px;
      font-size: 0.95rem;
    }
  }

  @media (max-width: 480px) {
    .dashboard-content {
      padding: 15px 20px;
    }

    h2 {
      font-size: 1.3rem;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 0.9rem;
    }

    .form-control {
      padding: 8px 10px;
      font-size: 0.9rem;
    }

    .btn-primary {
      width: 100%;
      padding: 12px;
    }
  }
</style>

<div class="dashboard-content">
  <h2><i class="bi bi-shop"></i> Tambah Toko</h2>
  <form action="{{ route('admin.toko.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="nama">Nama Toko</label>
      <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan nama toko">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea name="alamat" id="alamat" class="form-control" required placeholder="Masukkan alamat lengkap toko"></textarea>
    </div>
    <div class="form-group">
      <label for="email">Email Penjual</label>
      <input type="email" name="email" id="email" class="form-control" required placeholder="Masukkan email penjual">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
    </div>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Simpan</button>
  </form>
</div>
@endsection
