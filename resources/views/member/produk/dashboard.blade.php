@extends('member.layout')
@section('content')
    <style>
        .product-image {
            max-height: 300px;
            object-fit: cover;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
        .image-preview {
            max-height: 200px;
            object-fit: cover;
            display: none;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
    </style>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addProductForm" action="{{ route('member.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" min="0" required>
                                    </div>
                                    @error('harga')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok') }}" min="0" required>
                                    @error('stok')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB</div>
                                    <div class="mt-2">
                                        <img id="imagePreview" class="image-preview img-thumbnail" alt="Preview Gambar">
                                    </div>
                                    @error('gambar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Dashboard Produk</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Filter dan Pencarian -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari produk...">
                            <button class="btn btn-outline-secondary" type="button" id="searchButton">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="categoryFilter">
                            <option value="">Semua Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="sortBy">
                            <option value="terbaru">Terbaru</option>
                            <option value="terlama">Terlama</option>
                            <option value="harga_tertinggi">Harga Tertinggi</option>
                            <option value="harga_terendah">Harga Terendah</option>
                            <option value="stok_terbanyak">Stok Terbanyak</option>
                        </select>
                    </div>
                </div>

                <!-- Daftar Produk -->
                <div class="row" id="productsContainer">
                    @forelse($produk as $p)
                        <div class="col-md-6 col-lg-4 mb-4 product-item" 
                             data-name="{{ strtolower($p->nama) }}" 
                             data-category="{{ $p->kategori_id }}" 
                             data-price="{{ $p->harga }}"
                             data-stock="{{ $p->stok }}"
                             data-date="{{ $p->created_at }}">
                            <div class="card h-100">
                                <img src="{{ $p->gambar ? asset('storage/'.$p->gambar) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                                     class="card-img-top product-image" alt="{{ $p->nama }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1">{{ $p->nama }}</h5>
                                    <p class="text-muted mb-2">Kategori: {{ optional($p->kategori)->nama ?? '-' }}</p>
                                    <p class="card-text flex-grow-1">{{ Str::limit($p->deskripsi, 120) }}</p>
                                    <div class="mb-2">
                                        <span class="badge bg-{{ $p->stok > 0 ? 'success' : 'danger' }}">
                                            Stok: {{ $p->stok }}
                                        </span>
                                        <span class="badge bg-secondary ms-1">
                                            Berat: {{ $p->berat }}g
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="text-primary mb-0">Rp {{ number_format($p->harga,0,',','.') }}</h5>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-outline-info view-product" data-id="{{ $p->id }}" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary edit-product" data-id="{{ $p->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('member.produk.destroy', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada produk</h4>
                            <p class="text-muted">Silakan tambahkan produk terlebih dahulu di toko Anda.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Modal Detail Produk -->
                <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="productDetailContent">
                                <!-- Detail produk akan diisi via JavaScript -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview gambar saat memilih file
        document.getElementById('gambar').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });

        // Filter dan pencarian produk
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const sortBy = document.getElementById('sortBy');
            const productItems = document.querySelectorAll('.product-item');

            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const categoryValue = categoryFilter.value;
                const sortValue = sortBy.value;

                let filteredProducts = Array.from(productItems);

                // Filter berdasarkan pencarian
                if (searchTerm) {
                    filteredProducts = filteredProducts.filter(item => {
                        return item.getAttribute('data-name').includes(searchTerm);
                    });
                }

                // Filter berdasarkan kategori
                if (categoryValue) {
                    filteredProducts = filteredProducts.filter(item => {
                        return item.getAttribute('data-category') === categoryValue;
                    });
                }

                // Sort produk
                filteredProducts.sort((a, b) => {
                    switch (sortValue) {
                        case 'terbaru':
                            return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
                        case 'terlama':
                            return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
                        case 'harga_tertinggi':
                            return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
                        case 'harga_terendah':
                            return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
                        case 'stok_terbanyak':
                            return parseInt(b.getAttribute('data-stock')) - parseInt(a.getAttribute('data-stock'));
                        default:
                            return 0;
                    }
                });

                // Sembunyikan semua produk terlebih dahulu
                productItems.forEach(item => {
                    item.style.display = 'none';
                });

                // Tampilkan produk yang difilter
                filteredProducts.forEach(item => {
                    item.style.display = 'block';
                });

                // Jika tidak ada produk yang cocok
                const container = document.getElementById('productsContainer');
                const visibleProducts = container.querySelectorAll('.product-item[style="display: block"]');
                
                if (visibleProducts.length === 0) {
                    if (!container.querySelector('.no-products-message')) {
                        const noProducts = document.createElement('div');
                        noProducts.className = 'col-12 text-center py-5 no-products-message';
                        noProducts.innerHTML = `
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada produk ditemukan</h4>
                            <p class="text-muted">Coba ubah kata kunci pencarian atau filter kategori.</p>
                        `;
                        container.appendChild(noProducts);
                    }
                } else {
                    const noProductsMessage = container.querySelector('.no-products-message');
                    if (noProductsMessage) {
                        noProductsMessage.remove();
                    }
                }
            }

            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
            sortBy.addEventListener('change', filterProducts);

            // Event listener untuk tombol detail produk
            document.querySelectorAll('.view-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    showProductDetail(productId);
                });
            });

            // Event listener untuk tombol edit produk
            document.querySelectorAll('.edit-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    editProduct(productId);
                });
            });
        });

        // Fungsi untuk menampilkan detail produk
        function showProductDetail(productId) {
            // Dalam implementasi nyata, Anda akan mengambil data dari server
            // Di sini kita akan menggunakan data yang sudah ada di halaman
            
            const productElement = document.querySelector(`.product-item[data-id="${productId}"]`);
            if (productElement) {
                const productName = productElement.querySelector('.card-title').textContent;
                const productCategory = productElement.querySelector('.text-muted').textContent;
                const productDescription = productElement.querySelector('.card-text').textContent;
                const productPrice = productElement.querySelector('.text-primary').textContent;
                const productStock = productElement.querySelector('.badge.bg-success, .badge.bg-danger').textContent;
                const productImage = productElement.querySelector('.product-image').src;

                const detailContent = `
                    <div class="row">
                        <div class="col-md-6">
                            <img src="${productImage}" class="img-fluid rounded" alt="${productName}">
                        </div>
                        <div class="col-md-6">
                            <h4>${productName}</h4>
                            <p><strong>${productCategory}</strong></p>
                            <p><strong>Harga:</strong> ${productPrice}</p>
                            <p><strong>${productStock}</strong></p>
                            <p><strong>Deskripsi:</strong></p>
                            <p>${productDescription}</p>
                        </div>
                    </div>
                `;

                document.getElementById('productDetailContent').innerHTML = detailContent;
                const modal = new bootstrap.Modal(document.getElementById('productDetailModal'));
                modal.show();
            }
        }

        // Fungsi untuk edit produk (placeholder)
        function editProduct(productId) {
            // Redirect ke halaman edit produk
            window.location.href = `/member/produk/${productId}/edit`;
        }

        // Auto-hide alert setelah 5 detik
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
@endsection