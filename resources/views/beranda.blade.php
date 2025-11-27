<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace SMK YPC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html {scroll-behavior: smooth;}

        :root {
            --primary: #1e293b;
            --secondary: #38bdf8;
            --accent: #0ea5e9;
            --light: #f8fafc;
            --dark: #0f172a;
            --success: #10b981;
            --danger: #ef4444;
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
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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

        .category-card.active {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .category-card.active .category-icon {
            color: white;
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
            font-weight: 600;
        }

        .product-category {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }

        .product-description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-stock {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .stock-available {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stock-out {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
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

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #0da271;
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

        .cta p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
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
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Filter Styles */
        .product-item {
            transition: all 0.3s ease;
        }

        .product-item.hidden {
            display: none;
        }

        .no-products {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }

        .no-products i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
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

            .product-footer {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .product-actions {
                width: 100%;
            }

            .btn-sm {
                flex: 1;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 1rem;
            }

            .logo {
                font-size: 1.2rem;
            }

            .hero {
                padding: 4rem 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .categories, .products {
                padding: 2rem 1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-store"></i>
            <span>Marketplace Sekolah</span>
        </div>
        <ul class="nav-links">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#produk">Produk</a></li>
            <li><a href="#kategori">Kategori</a></li>
            <li><a href="#tentang">Tentang</a></li>
        </ul>
        <div class="auth-section">
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i>Login
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Karya Kreatif Sekolah</h1>
            <p>Temukan produk unik dan berkualitas langsung dari bakat siswa kami</p>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari produk favorit...">
                <button id="searchButton"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories" id="kategori">
        <h2 class="section-title">Kategori Produk</h2>
        <div class="categories-grid">
            <div class="category-card active" data-category="all">
                <div class="category-icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <h3>Semua</h3>
            </div>
            <div class="category-card" data-category="fashion">
                <div class="category-icon">
                    <i class="fas fa-tshirt"></i>
                </div>
                <h3>Fashion</h3>
            </div>
            <div class="category-card" data-category="makanan">
                <div class="category-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Makanan</h3>
            </div>
            <div class="category-card" data-category="teknologi">
                <div class="category-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3>Teknologi</h3>
            </div>
            <div class="category-card" data-category="kerajinan">
                <div class="category-icon">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <h3>Kerajinan</h3>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="products" id="produk">
        <h2 class="section-title">Produk Unggulan</h2>
        <div class="products-grid" id="productsGrid">
            @forelse($produk as $p)
                <div class="product-card product-item"
                     data-category="{{ strtolower($p->kategori->nama ?? 'lainnya') }}"
                     data-name="{{ strtolower($p->nama) }}"
                     data-price="{{ $p->harga }}">
                    <div class="product-image">
                        <img src="{{ $p->gambar ? asset('storage/'.$p->gambar) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                             alt="{{ $p->nama }}">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $p->nama }}</h3>
                        <p class="product-category">Kategori: {{ $p->kategori->nama ?? '-' }}</p>
                        <p class="product-description">{{ $p->deskripsi }}</p>

                        <div class="product-stock {{ $p->stok > 0 ? 'stock-available' : 'stock-out' }}">
                            <i class="fas {{ $p->stok > 0 ? 'fa-check' : 'fa-times' }}"></i>
                            Stok: {{ $p->stok }}
                        </div>

                        <div class="product-footer">
                            <div class="product-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                            <div class="product-actions">
                                <a href="https://wa.me/{{ $p->toko->kontak ?? '' }}?text={{ urlencode('Halo, saya ingin membeli produk '.$p->nama.' dari toko '.($p->toko->nama ?? '')) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-success"
                                   title="Chat Penjual">
                                    <i class="fab fa-whatsapp"></i> Beli
                                </a>
                                <a href="{{ route('produk.show', $p->id) }}" class="btn btn-sm btn-outline">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-products">
                    <i class="fas fa-box-open"></i>
                    <h3>Belum ada produk</h3>
                    <p>Silakan tambahkan produk terlebih dahulu di toko Anda.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- CTA -->
    <section class="cta" id="tentang">
        <div class="cta-content">
            <h2>Kami percaya setiap siswa memiliki potensi besar.</h2>
            <p>Marketplace Sekolah dibangun sebagai sarana untuk menampilkan karya terbaik mereka kepada publik, mendorong kreativitas, serta membuka peluang usaha bagi generasi muda yang berprestasi.</p>
            <div class="cta-buttons">
                <a href="#produk" class="btn btn-white" id="showAllProducts">
                    <i class="fas fa-th-large"></i> Lihat Semua Produk
                </a>
                <a href="#kategori" class="btn btn-outline" style="background: transparent; color: white; border-color: white;">
                    <i class="fas fa-tags"></i> Jelajahi Kategori
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-column">
                <h3>Marketplace Sekolah</h3>
                <p>Platform jual beli produk karya siswa.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#home"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="#produk"><i class="fas fa-box"></i> Produk</a></li>
                    <li><a href="#kategori"><i class="fas fa-tags"></i> Kategori</a></li>
                    <li><a href="#tentang"><i class="fas fa-info-circle"></i> Tentang</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Kontak</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt"></i> Jl. CISINGA</li>
                    <li><i class="fas fa-phone"></i> (0265) 123456</li>
                    <li><i class="fas fa-envelope"></i> info@sekolah.sch.id</li>
                    <li><i class="fas fa-clock"></i> Senin - Jumat: 08:00 - 16:00</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0"> &copy; {{ date('Y') }} Beranda. Ayo gabung</p>
        </div>
    </footer>

    <!-- Toast -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Produk berhasil ditambahkan!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Element references
            const categoryCards = document.querySelectorAll('.category-card');
            const productItems = document.querySelectorAll('.product-item');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const showAllProducts = document.getElementById('showAllProducts');
            const productsGrid = document.getElementById('productsGrid');

            // Current filter state
            let currentCategory = 'all';
            let currentSearch = '';

            // Filter products function
            function filterProducts() {
                let visibleCount = 0;

                productItems.forEach(item => {
                    const categoryMatch = currentCategory === 'all' ||
                                        item.getAttribute('data-category') === currentCategory;
                    const searchMatch = currentSearch === '' ||
                                      item.getAttribute('data-name').includes(currentSearch) ||
                                      item.getAttribute('data-category').includes(currentSearch);

                    if (categoryMatch && searchMatch) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                // Show no products message if no products visible
                const noProductsMsg = document.querySelector('.no-products');
                if (visibleCount === 0 && !noProductsMsg) {
                    const noProducts = document.createElement('div');
                    noProducts.className = 'no-products';
                    noProducts.innerHTML = `
                        <i class="fas fa-search"></i>
                        <h3>Tidak ada produk yang ditemukan</h3>
                        <p>Coba gunakan kata kunci lain atau pilih kategori berbeda.</p>
                    `;
                    productsGrid.appendChild(noProducts);
                } else if (noProductsMsg && visibleCount > 0) {
                    noProductsMsg.remove();
                }
            }

            // Category filter
            categoryCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove active class from all categories
                    categoryCards.forEach(c => c.classList.remove('active'));

                    // Add active class to clicked category
                    this.classList.add('active');

                    // Update current category and filter
                    currentCategory = this.getAttribute('data-category');
                    filterProducts();

                    // Show toast notification
                    showToast(`Menampilkan produk ${this.querySelector('h3').textContent}`);
                });
            });

            // Search functionality
            function performSearch() {
                currentSearch = searchInput.value.toLowerCase().trim();
                filterProducts();

                if (currentSearch) {
                    showToast(`Mencari: "${searchInput.value}"`);
                }
            }

            searchButton.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            // Show all products
            showAllProducts.addEventListener('click', function(e) {
                e.preventDefault();

                // Reset category filter
                categoryCards.forEach(c => c.classList.remove('active'));
                document.querySelector('[data-category="all"]').classList.add('active');
                currentCategory = 'all';

                // Reset search
                searchInput.value = '';
                currentSearch = '';

                // Filter products
                filterProducts();

                showToast('Menampilkan semua produk');

                // Scroll to products section
                document.getElementById('produk').scrollIntoView({
                    behavior: 'smooth'
                });
            });

            // Toast notification function
            function showToast(message) {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');

                toastMessage.textContent = message;
                toast.classList.add('show');

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }

            // Scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            // Animate elements on scroll
            document.querySelectorAll('.category-card, .product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Initialize filter
            filterProducts();
        });
    </script>
</body>
</html>
