<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $produk->nama }} - Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        .product-image {
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.02);
        }

        .info-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .price-tag {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
        }

        .stock-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
        }

        .stock-available {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .stock-low {
            background: #fff3cd;
            color: #856404;
            border: 2px solid #ffeaa7;
        }

        .stock-out {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .btn-back {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .description-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px dashed #dee2e6;
        }

        .category-badge {
            background: linear-gradient(135deg, #17a2b8, #6f42c1);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="product-card">
                    <div class="card-header text-center">
                        <h2 class="mb-0"><i class="fas fa-cube me-2"></i>{{ $produk->nama }}</h2>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Gambar Produk -->
                            <div class="col-md-6 mb-4">
                                <div class="text-center">
                                    <img src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                         class="img-fluid product-image shadow"
                                         style="max-height: 400px; object-fit: cover;"
                                         alt="{{ $produk->nama }}">
                                </div>
                            </div>

                            <!-- Informasi Produk -->
                            <div class="col-md-6">
                                <div class="info-item">
                                    <h5 class="mb-2"><i class="fas fa-tags me-2 text-primary"></i><strong>Kategori</strong></h5>
                                    <span class="category-badge">{{ $produk->kategori->nama ?? '-' }}</span>
                                </div>

                                <div class="info-item">
                                    <h5 class="mb-2"><i class="fas fa-tag me-2 text-success"></i><strong>Harga</strong></h5>
                                    <span class="price-tag fs-4">
                                        <i class="fas fa-money-bill-wave me-2"></i>
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="info-item">
                                    <h5 class="mb-2"><i class="fas fa-boxes me-2 text-warning"></i><strong>Stok Tersedia</strong></h5>
                                    <span class="stock-badge {{ $produk->stok > 10 ? 'stock-available' : ($produk->stok > 0 ? 'stock-low' : 'stock-out') }}">
                                        <i class="fas {{ $produk->stok > 0 ? 'fa-check' : 'fa-times' }} me-2"></i>
                                        {{ $produk->stok }} Unit
                                    </span>
                                </div>

                                <div class="info-item">
                                    <h5 class="mb-3"><i class="fas fa-align-left me-2 text-info"></i><strong>Deskripsi Produk</strong></h5>
                                    <div class="description-box">
                                        <p class="mb-0" style="line-height: 1.8; color: #495057;">
                                            <i class="fas fa-quote-left me-2 text-muted"></i>
                                            {{ $produk->deskripsi }}
                                            <i class="fas fa-quote-right ms-2 text-muted"></i>
                                        </p>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <a href="/" class="btn btn-back">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Kembali ke Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animasi sederhana untuk elemen
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.info-item, .product-image');
            elements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    element.style.transition = 'all 0.5s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>
