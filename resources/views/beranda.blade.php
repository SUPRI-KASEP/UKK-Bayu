<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
</head>

<style>
    /* Reset dasar */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f4f4;
    }

    /* Navbar utama */
    .navbar {
        background-color: #1e293b;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 50px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: sticky;
        top: 0;
        z-index: 1000;

    }

    /* Logo */
    .navbar .logo {
        font-size: 1.5em;
        font-weight: bold;
    }

    /* Link menu */
    .nav-links {
        list-style: none;
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .nav-links a {
        text-decoration: none;
        color: white;
        font-size: 1em;
        transition: 0.3s;
    }

    /* Efek hover */
    .nav-links a:hover {
        color: #38bdf8; /* biru terang */
    }

    .btn-primary {
        background-color: #1e293b;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 5px;
        border: none;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: white !important;
    }

    /* Auth section */
    .auth-section {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .auth-section a {
        text-decoration: none;
        color: white;
        font-size: 0.9em;
        padding: 8px 16px;
        border-radius: 5px;
        transition: 0.3s;
    }

    .auth-section .login-btn {
        background-color: #38bdf8;
    }

    .auth-section .login-btn:hover {
        background-color: #0ea5e9;
    }

    .auth-section .logout-btn {
        background-color: #ef4444;
    }

    .auth-section .logout-btn:hover {
        background-color: #dc2626;
    }

    .user-info {
        color: #e0e7ff;
        font-size: 0.9em;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .navbar {
            justify-content: space-between;
        }
    }

    /* Auth section */
    .auth-section {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .auth-section a {
        color: white;
        text-decoration: none;
        font-size: 1em;
        transition: 0.3s;
    }

    .auth-section a:hover {
        color: #38bdf8;
    }

    .auth-section .logout-form {
        margin: 0;
    }

    .auth-section .logout-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1em;
        cursor: pointer;
        transition: 0.3s;
    }

    .auth-section .logout-btn:hover {
        color: #38bdf8;
    }

    .content {
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
<body>
    <nav class="navbar">
    <div class="logo">SmkYpc</div>
    <ul class="nav-links">
      <li><a href="{{ route('beranda') }}">Beranda</a></li>
      <li><a href="#">Tentang</a></li>
      <li><a href="#">Layanan</a></li>
      <li><a href="#">Kontak</a></li>
    </ul>
    <div class="auth-section">
      @auth
        <span class="user-info">Selamat datang, {{ Auth::user()->name }}!</span>
        @if(Auth::user()->isAdmin())
          <a href="{{ route('admin.beranda') }}" class="btn-primary">Dashboard Admin</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="logout-btn">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="login-btn">Login</a>
      @endauth
    </div>
  </nav>

  <div class="content">
    <h2>Selamat Datang di Website SMK Ypc Tasikmalaya</h2>
    <p></p>
  </div>
</body>
</html>
