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

    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {
        .nav-links {
            display: none;

        }

        .navbar {
            justify-content: space-between;
        }
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
      <li><a href="#">Beranda</a></li>
      <li><a href="#">Tentang</a></li>
      <li><a href="#">Layanan</a></li>
      <li><a href="#">Kontak</a></li>
    </ul>
  </nav>

  <div class="content">
    <h2>Selamat Datang di Website SMK Ypc Tasikmalaya</h2>
    <p></p>
  </div>
</body>
</html>
