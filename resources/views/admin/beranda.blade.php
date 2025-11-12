<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    /* Reset & font */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: #f1f5f9;
      color: #1e293b;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #0f172a;
      color: #f8fafc;
      display: flex;
      flex-direction: column;
      transition: width 0.3s ease;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .sidebar h2 {
      text-align: center;
      padding: 1.5rem 0;
      font-size: 1.3rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      letter-spacing: 1px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }

    .sidebar ul li a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 15px 20px;
      color: #e2e8f0;
      text-decoration: none;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .sidebar ul li a:hover {
      background-color: #1e293b;
      padding-left: 25px;
    }

    .sidebar ul li a i {
      width: 20px;
      text-align: center;
      font-size: 18px;
    }

    .alert {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    /* Main content */
    .main-content {
      flex: 1;
      padding: 20px 30px;
      background-color: #f8fafc;
    }

    .topbar {
      background-color: #ffffff;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .topbar h3 {
      font-size: 1.2rem;
      font-weight: 600;
    }

    .toggle-btn {
      background-color: #0f172a;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s;
    }

    .toggle-btn:hover {
      background-color: #1e293b;
    }

    .dashboard-content {
      margin-top: 25px;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .dashboard-content h2 {
      margin-bottom: 10px;
      color: #1e293b;
    }

    .dashboard-content p {
      color: #475569;
      line-height: 1.6;
    }

    /* Responsif */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
      }

      .sidebar h2 {
        display: none;
      }

      .sidebar ul li a span {
        display: none;
      }

      .sidebar ul li a {
        justify-content: center;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/a2e0f1f6d2.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>
      <li><a href="{{ route('admin.toko.index') }}"><i class="fas fa-store"></i><span>Toko</span></a></li>
      <li><a href="{{ route('admin.produk.index') }}"><i class="fas fa-box"></i><span>Produk</span></a></li>
      <li><a href="{{ route('admin.kategori.index') }}"><i class="fas fa-tags"></i><span>Kategori</span></a></li>
      <li><a href="{{ route('admin.user.index') }}"><i class="fas fa-user"></i><span>User</span></a></li>
    </ul>
  </div>

  <!-- Konten utama -->
  <div class="main-content">
    <div class="topbar">
      <h3>Beranda Admin</h3>
      <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    </div>

    <div class="dashboard-content">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
      <h2>Selamat Datang di Dashboard Admin</h2>
      <p>
        Ini adalah halaman utama panel admin. Gunakan menu di sisi kiri untuk mengelola data
        <strong>Toko</strong>, <strong>Produk</strong>, <strong>Kategori</strong>, dan <strong>User</strong>.
      </p>
      @yield('content')
    </div>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('collapsed');
      if (sidebar.classList.contains('collapsed')) {
        sidebar.style.width = '70px';
      } else {
        sidebar.style.width = '250px';
      }
    }
  </script>
</body>
</html>
