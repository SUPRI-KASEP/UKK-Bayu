<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <script src="https://kit.fontawesome.com/a2e0f1f6d2.js" crossorigin="anonymous"></script>

  <style>
    /* === RESET & BASE === */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    :root {
      --bg: #f8fafc;
      --sidebar-bg: #ffffff;
      --sidebar-text: #334155;
      --sidebar-hover: #f1f5f9;
      --text: #475569;
      --card-bg: #ffffff;
      --accent: #3b82f6;
      --accent-hover: #2563eb;
      --judul: #1e293b;
      --shadow: rgba(0, 0, 0, 0.08);
      --border: #e2e8f0;
      --success-bg: #dcfce7;
      --success-border: #22c55e;
      --success-text: #166534;
      --table-header-bg: #1e293b;
      --table-header-text: #ffffff;
      --table-row-hover: #f8fafc;
      --badge-bg: #64748b;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: var(--bg);
      color: var(--text);
      overflow-x: hidden;
      line-height: 1.6;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 250px;
      background-color: var(--sidebar-bg);
      color: var(--sidebar-text);
      display: flex;
      flex-direction: column;
      box-shadow: 2px 0 10px var(--shadow);
      position: fixed;
      height: 100%;
      z-index: 100;
      transition: all 0.4s ease;
      border-right: 1px solid var(--border);
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .sidebar h2 {
      text-align: center;
      padding: 1.5rem 0;
      font-size: 1.3rem;
      font-weight: 600;
      color: var(--judul);
      border-bottom: 1px solid var(--border);
    }

    .sidebar ul {
      list-style: none;
      margin-top: 10px;
      padding: 0 10px;
    }

    .sidebar ul li a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 15px;
      color: var(--sidebar-text);
      text-decoration: none;
      font-size: 15px;
      border-radius: 8px;
      transition: all 0.3s ease;
      margin-bottom: 5px;
    }

    .sidebar ul li a:hover {
      background-color: var(--sidebar-hover);
      transform: translateX(5px);
      color: var(--accent);
    }

    .sidebar ul li a i {
      width: 22px;
      text-align: center;
      font-size: 18px;
    }

    .sidebar.collapsed ul li a span {
      display: none;
    }

    /* === MAIN CONTENT === */
    .main-content {
      flex: 1;
      margin-left: 250px;
      padding: 30px;
      background-color: var(--bg);
      transition: margin-left 0.4s ease;
    }

    .sidebar.collapsed ~ .main-content {
      margin-left: 80px;
    }

    /* === TOPBAR === */
    .topbar {
      background-color: var(--card-bg);
      padding: 15px 20px;
      border-radius: 12px;
      box-shadow: 0 2px 8px var(--shadow);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid var(--border);
    }

    .topbar h3 {
      font-size: 1.3rem;
      font-weight: 600;
      color: var(--judul);
    }

    .actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .toggle-btn,
    .logout-btn {
      border: none;
      cursor: pointer;
      padding: 8px 12px;
      border-radius: 8px;
      transition: all 0.3s;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .toggle-btn {
      background-color: var(--sidebar-bg);
      color: var(--sidebar-text);
      border: 1px solid var(--border);
    }

    .toggle-btn:hover {
      background-color: var(--sidebar-hover);
    }

    .logout-btn {
      background-color: #ef4444;
      color: white;
      box-shadow: 0 3px 6px var(--shadow);
    }

    .logout-btn:hover {
      background-color: #dc2626;
      transform: scale(1.05);
    }

    /* === DASHBOARD CONTENT === */
    .dashboard-content {
      margin-top: 25px;
      background: var(--card-bg);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 3px 8px var(--shadow);
      animation: fadeIn 0.4s ease;
      border: 1px solid var(--border);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-content h2 {
      margin-bottom: 10px;
      color: var(--judul);
      font-weight: 600;
    }

    /* === COMPONENTS === */
    .component-content {
      background-color: var(--card-bg);
      padding: 40px 50px;
      border-radius: 18px;
      box-shadow: 0 4px 25px var(--shadow);
      margin: 30px auto;
      max-width: 1200px;
      border: 1px solid var(--border);
    }

    .component-content h2 {
      font-weight: 700;
      font-size: 2rem;
      color: var(--judul);
    }

    .btn-primary {
      background: linear-gradient(90deg, var(--accent), var(--accent-hover));
      border: none;
      padding: 12px 20px;
      border-radius: 10px;
      font-weight: 500;
      transition: all 0.3s ease;
      color: white;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, var(--accent-hover), var(--accent));
      transform: translateY(-2px);
      color: white;
    }

    .table {
      background: var(--card-bg);
      border-radius: 12px;
      overflow: hidden;
      margin-top: 25px;
      font-size: 1.05rem;
      color: var(--text);
    }

    .table thead {
      background: var(--table-header-bg);
      color: var(--table-header-text);
      font-size: 1.1rem;
    }

    .table tbody tr:hover {
      background-color: var(--table-row-hover);
      transform: scale(1.01);
    }

    .alert-success {
      border-left: 6px solid var(--success-border);
      background-color: var(--success-bg);
      color: var(--success-text);
      font-weight: 500;
      font-size: 1rem;
      padding: 14px 20px;
      border-radius: 10px;
    }

    .badge {
      background-color: var(--badge-bg);
      color: white;
      padding: 8px 12px;
      border-radius: 6px;
    }

    .all {
      width: 100%;
      display: flex;
      justify-content: space-between;
      gap: 20px;
      margin-top: 25px;
    }

    .card-info {
      flex: 1;
      background: var(--card-bg);
      padding: 25px;
      border-radius: 14px;
      text-align: center;
      box-shadow: 0 3px 8px var(--shadow);
      border: 1px solid var(--border);
      transition: 0.3s;
    }

    .card-info:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px var(--shadow);
    }

    .card-info h4 {
      font-size: 1.2rem;
      color: var(--judul);
      margin-bottom: 10px;
      font-weight: 600;
    }

    .card-info span {
      font-size: 2rem;
      font-weight: bold;
      color: var(--accent);
    }


    /* === RESPONSIVE === */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); width: 250px; }
      .sidebar.show { transform: translateX(0); }
      .sidebar.collapsed { transform: translateX(-100%); }

      .main-content { margin-left: 0; padding: 20px; }

      .overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 80;
      }

      .overlay.active { display: block; }
    }

    @media (max-width: 480px) {
      .component-content {
        padding: 15px 10px;
      }

      .action-buttons {
        flex-direction: column;
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
      <li><a href="{{ route('admin.pengajuan') }}"><i class="bi bi-hourglass-split"></i> Pengajuan Toko</a></li>
    </ul>
  </div>

  <!-- Overlay Mobile -->
  <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="topbar">
      <h3>Beranda Admin</h3>
      <div class="actions">

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>

        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
      </div>
    </div>

    <div class="dashboard-content">
      <h2>Selamat Datang di Dashboard Admin</h2>
      <p>
        Gunakan menu di sisi kiri untuk mengelola data
        <strong>Toko</strong>, <strong>Produk</strong>,
        <strong>Kategori</strong>, dan <strong>User</strong>.
      </p>
      @yield('content')
    </div>
    
  </div>


  <script>
    // Toggle Sidebar
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");
      const isMobile = window.innerWidth <= 768;

      if (isMobile) {
        sidebar.classList.toggle("show");
        overlay.classList.toggle("active");
      } else {
        sidebar.classList.toggle("collapsed");
        localStorage.setItem(
          "sidebar",
          sidebar.classList.contains("collapsed") ? "collapsed" : "expanded"
        );
      }
    }

    // Restore sidebar state
    document.addEventListener("DOMContentLoaded", function () {
      const sidebarState = localStorage.getItem("sidebar");

      if (sidebarState === "collapsed" && window.innerWidth > 768) {
        document.getElementById("sidebar").classList.add("collapsed");
      }
    });
  </script>
</body>
</html>
