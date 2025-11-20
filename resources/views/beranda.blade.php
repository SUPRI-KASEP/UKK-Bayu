<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace SMK YPC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e293b;
            --secondary: #38bdf8;
            --accent: #0ea5e9;
            --light: #f8fafc;
            --dark: #0f172a;
            --success: #10b981;
            --gray: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: var(--primary);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            color: var(--secondary);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            transition: 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--secondary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: var(--secondary);
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-section {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            padding: 6rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%2338bdf8" fill-opacity="0.05" points="0,1000 1000,0 1000,1000"/></svg>');
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .search-bar {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .search-bar input {
            flex: 1;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            font-size: 1rem;
            outline: none;
        }

        .search-bar button {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-bar button:hover {
            background: var(--accent);
        }

        /* Categories */
        .categories {
            padding: 4rem 2rem;
            background: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--secondary);
            margin: 1rem auto;
            border-radius: 2px;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .category-card {
            background: var(--light);
            padding: 2rem 1rem;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .category-card:hover {
            transform: translateY(-10px);
            border-color: var(--secondary);
            box-shadow: 0 15px 30px rgba(56, 189, 248, 0.2);
        }

        .category-icon {
            font-size: 2.5rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        /* Products */
        .products {
            padding: 4rem 2rem;
            background: var(--light);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .product-image {
            height: 200px;
            background: var(--gray);
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            flex: 1;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* CTA */
        .cta {
            background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            padding: 5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle fill="%2338bdf8" fill-opacity="0.05" cx="500" cy="500" r="400"/></svg>');
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn-white {
            background: white;
            color: var(--primary);
        }

        .btn-white:hover {
            background: var(--light);
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-column h3 {
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: var(--secondary);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            transition: 0.3s;
        }

        .social-links a:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--success);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            z-index: 1000;
            transform: translateX(150%);
            transition: transform 0.3s;
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .search-bar {
                flex-direction: column;
                border-radius: 15px;
            }

            .search-bar input,
            .search-bar button {
                border-radius: 15px;
            }

            .cta-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-store"></i>
            <span>Marketplace SMK YPC</span>
        </div>
        <ul class="nav-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Produk</a></li>
            <li><a href="#">Kategori</a></li>
            <li><a href="#">Tentang</a></li>
        </ul>
        <div class="auth-section">
            <a href="{{ route('login') }}"class="btn btn-primary">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Karya Kreatif Siswa SMK YPC</h1>
            <p>Temukan produk unik dan berkualitas langsung dari bakat siswa kami</p>
            <div class="search-bar">
                <input type="text" placeholder="Cari produk favorit...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories">
        <h2 class="section-title">Kategori Produk</h2>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-tshirt"></i>
                </div>
                <h3>Fashion</h3>
            </div>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Makanan</h3>
            </div>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3>Teknologi</h3>
            </div>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <h3>Kerajinan</h3>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="products">
        <h2 class="section-title">Produk Unggulan</h2>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Kaos Custom">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Kaos Custom SMK YPC</h3>
                    <div class="product-price">Rp 75.000</div>
                    <div class="product-actions">
                        <button class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Beli</button>
                        <button class="btn btn-outline btn-sm">Detail</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Kue Kering">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Kue Kering Lebaran</h3>
                    <div class="product-price">Rp 45.000</div>
                    <div class="product-actions">
                        <button class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Beli</button>
                        <button class="btn btn-outline btn-sm">Detail</button>
                    </div>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Web Design">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Jasa Desain Web</h3>
                    <div class="product-price">Rp 500.000</div>
                    <div class="product-actions">
                        <button class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i> Beli</button>
                        <button class="btn btn-outline btn-sm">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="cta-content">
            <h2>Siap Mendukung Kreativitas Siswa?</h2>
            <p>Bergabunglah dengan komunitas kami dan dapatkan produk berkualitas sambil mendukung bakat siswa</p>
            <div class="cta-buttons">
                <a href="#" class="btn btn-white">Lihat Semua Produk</a>
                <a href="#" class="btn btn-outline" style="color: white; border-color: white;">Daftar Penjual</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-column">
                <h3>Marketplace SMK YPC</h3>
                <p>Platform jual beli produk karya siswa SMK YPC Tasikmalaya.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Produk</a></li>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Kontak</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt"></i> Jl. SMK YPC Tasikmalaya</li>
                    <li><i class="fas fa-phone"></i> (0265) 123456</li>
                    <li><i class="fas fa-envelope"></i> info@smkypc.sch.id</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Marketplace SMK YPC. All rights reserved.</p>
        </div>
    </footer>

    <!-- Toast -->
    <div class="toast" id="toast">
        <span id="toastMessage">Produk berhasil ditambahkan!</span>
    </div>

    <script>
        // Animasi scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi elemen saat scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            // Atur animasi untuk semua card
            document.querySelectorAll('.category-card, .product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            // Fungsi toast
            function showToast(message) {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');
                toastMessage.textContent = message;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3000);
            }

            // Event listener untuk tombol beli
            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.innerHTML.includes('shopping-cart')) {
                        e.preventDefault();
                        const product = this.closest('.product-card').querySelector('.product-title').textContent;
                        showToast(`${product} ditambahkan ke keranjang!`);

                        // Animasi ikon keranjang
                        const icon = document.createElement('i');
                        icon.className = 'fas fa-shopping-cart';
                        icon.style.cssText = `
                            position: fixed;
                            z-index: 10000;
                            color: var(--secondary);
                            font-size: 20px;
                            pointer-events: none;
                        `;
                        document.body.appendChild(icon);

                        const startRect = this.getBoundingClientRect();
                        const endRect = document.querySelector('.auth-section').getBoundingClientRect();

                        icon.animate([
                            {
                                left: `${startRect.left}px`,
                                top: `${startRect.top}px`,
                                opacity: 1
                            },
                            {
                                left: `${endRect.left}px`,
                                top: `${endRect.top}px`,
                                opacity: 0
                            }
                        ], {
                            duration: 1000,
                            easing: 'ease-out'
                        });

                        setTimeout(() => document.body.removeChild(icon), 1000);
                    }
                });
            });

            // Pencarian
            document.querySelector('.search-bar button').addEventListener('click', function() {
                const query = document.querySelector('.search-bar input').value;
                if (query) {
                    showToast(`Mencari: ${query}`);
                }
            });

            document.querySelector('.search-bar input').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    document.querySelector('.search-bar button').click();
                }
            });
        });
    </script>
</body>
</html>
