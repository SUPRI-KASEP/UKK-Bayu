<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://kit.fontawesome.com/a2e0f1f6d2.js" crossorigin="anonymous"></script>

  <style>
    /* Reset & Font */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      transition: background 0.3s, color 0.3s;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: var(--bg);
      color: var(--text);
    }

    :root {
      --bg: #f1f5f9;
      --sidebar-bg: #0f172a;
      --text: #1e293b;
      --card-bg: #ffffff;
      --hover: #1e293b;
      --accent: #2563eb;
      --judul: #1e293b;
    }

    body.dark {
      --bg: #0f172a;
      --sidebar-bg: #1e293b;
      --text: #1e293b;
      --card-bg: #1e293b;
      --hover: #334155;
      --accent: #3b82f6;
      --judul: #ffff;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: var(--sidebar-bg);
      color: #f8fafc;
      display: flex;
      flex-direction: column;
      transition: width 0.3s ease;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .sidebar.collapsed {
      width: 70px;
    }

    .sidebar h2 {
      text-align: center;
      padding: 1.5rem 0;
      font-size: 1.3rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      letter-spacing: 1px;
      white-space: nowrap;
      color: #ffff;
    }

    .sidebar ul {
      list-style: none;
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
      background-color: var(--hover);
      padding-left: 25px;
    }

    .sidebar ul li a i {
      width: 20px;
      text-align: center;
      font-size: 18px;
    }

    .sidebar.collapsed ul li a span {
      display: none;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 20px 30px;
      background-color: var(--bg);
      transition: margin-left 0.3s;
    }

    .topbar {
      background-color: var(--card-bg);
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
      color: var(--judul);
    }

    .topbar .actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .toggle-btn {
      background-color: var(--sidebar-bg);
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s;
    }

    .toggle-btn:hover {
      background-color: var(--hover);
    }

    .theme-btn {
      background-color: var(--accent);
      border: none;
      color: #fff;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .dashboard-content {
      margin-top: 25px;
      background: var(--card-bg);
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .dashboard-content h2 {
      margin-bottom: 10px;
      color: var(--text);
    }

    .dashboard-content p {
      color: var(--text);
      line-height: 1.6;
    }

    /* Alert */
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

    /* Responsif */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        z-index: 10;
        height: 100%;
      }
      .main-content {
        padding: 15px;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h2>Admin</h2>
    <ul>
      <li><a href="{{ route('admin.beranda') }}"><i class="fas fa-home"></i><span>Beranda</span></a></li>
      <li><a href="{{ route('admin.toko.index') }}"><i class="fas fa-store"></i><span>Toko</span></a></li>
      <li><a href="{{ route('admin.produk.index') }}"><i class="fas fa-box"></i><span>Produk</span></a></li>
      <li><a href="{{ route('admin.kategori.index') }}"><i class="fas fa-tags"></i><span>Kategori</span></a></li>
      <li><a href="{{ route('admin.user.index') }}"><i class="fas fa-user"></i><span>User</span></a></li>
    </ul>
  </div>

  <!-- Main -->
  <div class="main-content">
    <div class="topbar">
      <h3>Beranda Admin</h3>
      <div class="actions">
        <button class="theme-btn" onclick="toggleTheme()">
          <i class="bi bi-moon-stars"></i>
        </button>
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
      </div>
    </div>

    <div class="dashboard-content">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <h2>Selamat Datang di Dashboard Admin</h2>
      <p>Gunakan menu di sisi kiri untuk mengelola data <strong>Toko</strong>, <strong>Produk</strong>, <strong>Kategori</strong>, dan <strong>User</strong>.</p>
      @yield('content')
    </div>
  </div>

  <script>
    // fung toggle sidebar
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');

      if(sidebar.classList.contains('collapsed')) {
        localStorage.setItem('sidebar','collapsed');
      } else {
        localStorage.setItem('sidebar','expanded');
      }
    }
    //fungsi tema
    function toggleTheme() {
      document.body.classList.toggle('dark');
      const icon = document.querySelector('.theme-btn i');
      icon.classList.toggle('bi-sun');
      icon.classList.toggle('bi-moon-stars');

    // simpan status tema
      if(document.body.classList.contains('dark')) {
        localStorage.setItem('theme','dark');
      } else {
        localStorage.setItem('theme','light');
      }
    }

    // Saat halaman dimuat ulang, cek tema terakhir
    document.addEventListener('DOMContentLoaded', function() {
        const theme = localStorage.getItem('theme');
        const icon = document.querySelector('.theme-btn i');

        if (theme === 'dark') {
            document.body.classList.add('dark');
            icon.classList.remove('bi-moon-stars');
            icon.classList.add('bi-sun');
        } else {
            document.body.classList.remove('dark');
            icon.classList.remove('bi-sun');
            icon.classList.add('bi-moon-stars');
        }
        const sidebarState = localStorage.getItem('sidebar');
        if (sidebarState === 'collapsed') {
             document.getElementById('sidebar').classList.add('collapsed');
        }

  });
  </script>
</body>
</html>
