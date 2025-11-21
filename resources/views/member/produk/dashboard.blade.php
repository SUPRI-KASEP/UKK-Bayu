@extends('member.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Dashboard Produk</h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </button>
                </div>

                <!-- Alert Notifikasi -->
                <div id="alertContainer"></div>

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
                            <option value="Elektronik">Elektronik</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Perabotan">Perabotan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="sortBy">
                            <option value="name">Urutkan berdasarkan Nama</option>
                            <option value="price">Urutkan berdasarkan Harga</option>
                            <option value="date">Urutkan berdasarkan Tanggal</option>
                        </select>
                    </div>
                </div>

                <!-- Daftar Produk -->
                <div class="row" id="productsContainer">
                    <!-- Produk akan ditampilkan di sini secara dinamis -->
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center" id="paginationContainer">
                        <!-- Pagination akan di-generate secara dinamis -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Produk -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm" enctype="multipart/form-data">
                        <input type="hidden" id="productId" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="productName" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productCategory" class="form-label">Kategori</label>
                                    <select class="form-select" id="productCategory" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Pakaian">Pakaian</option>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Perabotan">Perabotan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="productPrice" name="price" min="0" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="productStock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="productStock" name="stock" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="productDescription" name="description" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="productImage" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                                    <div class="form-text">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</div>
                                    <div id="imagePreview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveProductBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Produk -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="detailImage" src="" alt="Gambar Produk" class="img-fluid rounded product-image">
                        </div>
                        <div class="col-md-6">
                            <h4 id="detailName" class="mb-3"></h4>
                            <p><strong>Kategori:</strong> <span id="detailCategory"></span></p>
                            <p><strong>Harga:</strong> Rp <span id="detailPrice"></span></p>
                            <p><strong>Stok:</strong> <span id="detailStock"></span></p>
                            <p><strong>Deskripsi:</strong></p>
                            <p id="detailDescription"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                    <p class="text-danger"><strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data produk contoh
        let products = [
            {
                id: 1,
                name: "Smartphone XYZ",
                category: "Elektronik",
                price: 2500000,
                stock: 15,
                description: "Smartphone dengan kamera 48MP, RAM 6GB, dan baterai 4000mAh.",
                image: "https://via.placeholder.com/300x200?text=Smartphone+XYZ"
            },
            {
                id: 2,
                name: "Kaos Polos Premium",
                category: "Pakaian",
                price: 85000,
                stock: 50,
                description: "Kaos polos dengan bahan katun premium, nyaman dipakai seharian.",
                image: "https://via.placeholder.com/300x200?text=Kaos+Polos"
            },
            {
                id: 3,
                name: "Kopi Arabica",
                category: "Makanan",
                price: 75000,
                stock: 30,
                description: "Kopi arabica pilihan dengan rasa yang khas dan aroma yang harum.",
                image: "https://via.placeholder.com/300x200?text=Kopi+Arabica"
            },
            {
                id: 4,
                name: "Meja Kerja Minimalis",
                category: "Perabotan",
                price: 1200000,
                stock: 5,
                description: "Meja kerja dengan desain minimalis, cocok untuk ruang kerja modern.",
                image: "https://via.placeholder.com/300x200?text=Meja+Kerja"
            }
        ];

        // Variabel global
        let currentPage = 1;
        const productsPerPage = 6;
        let currentProductId = null;

        // Fungsi untuk menampilkan produk
        function displayProducts(productsToDisplay = products) {
            const container = document.getElementById('productsContainer');
            container.innerHTML = '';

            // Hitung indeks untuk pagination
            const startIndex = (currentPage - 1) * productsPerPage;
            const endIndex = startIndex + productsPerPage;
            const paginatedProducts = productsToDisplay.slice(startIndex, endIndex);

            if (paginatedProducts.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada produk ditemukan</h4>
                        <p class="text-muted">Coba ubah filter pencarian atau tambahkan produk baru.</p>
                    </div>
                `;
                return;
            }

            paginatedProducts.forEach(product => {
                const productCard = `
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img src="${product.image}" class="card-img-top product-image" alt="${product.name}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">
                                    <span class="badge bg-secondary">${product.category}</span>
                                    <span class="badge ${product.stock > 0 ? 'bg-success' : 'bg-danger'}">
                                        ${product.stock > 0 ? 'Stok: ' + product.stock : 'Stok Habis'}
                                    </span>
                                </p>
                                <p class="card-text flex-grow-1">${product.description.substring(0, 100)}...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-primary">Rp ${product.price.toLocaleString('id-ID')}</h5>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-info view-product" data-id="${product.id}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary edit-product" data-id="${product.id}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-product" data-id="${product.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += productCard;
            });

            // Setup event listeners untuk tombol aksi
            setupActionButtons();
            
            // Update pagination
            updatePagination(productsToDisplay.length);
        }

        // Fungsi untuk setup tombol aksi
        function setupActionButtons() {
            // Tombol lihat detail
            document.querySelectorAll('.view-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-id'));
                    viewProduct(productId);
                });
            });

            // Tombol edit
            document.querySelectorAll('.edit-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-id'));
                    editProduct(productId);
                });
            });

            // Tombol hapus
            document.querySelectorAll('.delete-product').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = parseInt(this.getAttribute('data-id'));
                    confirmDelete(productId);
                });
            });
        }

        // Fungsi untuk melihat detail produk
        function viewProduct(id) {
            const product = products.find(p => p.id === id);
            if (product) {
                document.getElementById('detailName').textContent = product.name;
                document.getElementById('detailCategory').textContent = product.category;
                document.getElementById('detailPrice').textContent = product.price.toLocaleString('id-ID');
                document.getElementById('detailStock').textContent = product.stock;
                document.getElementById('detailDescription').textContent = product.description;
                document.getElementById('detailImage').src = product.image;
                
                const modal = new bootstrap.Modal(document.getElementById('productDetailModal'));
                modal.show();
            }
        }

        // Fungsi untuk mengedit produk
        function editProduct(id) {
            const product = products.find(p => p.id === id);
            if (product) {
                document.getElementById('productId').value = product.id;
                document.getElementById('productName').value = product.name;
                document.getElementById('productCategory').value = product.category;
                document.getElementById('productPrice').value = product.price;
                document.getElementById('productStock').value = product.stock;
                document.getElementById('productDescription').value = product.description;
                
                // Preview gambar
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.innerHTML = `<img src="${product.image}" class="img-thumbnail" style="max-height: 150px;">`;
                
                document.getElementById('productModalLabel').textContent = 'Edit Produk';
                const modal = new bootstrap.Modal(document.getElementById('productModal'));
                modal.show();
            }
        }

        // Fungsi untuk konfirmasi hapus produk
        function confirmDelete(id) {
            currentProductId = id;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            modal.show();
        }

        // Fungsi untuk menambah produk baru
        function addProduct() {
            // Reset form
            document.getElementById('productForm').reset();
            document.getElementById('productId').value = '';
            document.getElementById('imagePreview').innerHTML = '';
            document.getElementById('productModalLabel').textContent = 'Tambah Produk Baru';
            
            const modal = new bootstrap.Modal(document.getElementById('productModal'));
            modal.show();
        }

        // Fungsi untuk menyimpan produk (tambah/edit)
        function saveProduct() {
            const formData = new FormData(document.getElementById('productForm'));
            const id = formData.get('id');
            const name = formData.get('name');
            const category = formData.get('category');
            const price = parseInt(formData.get('price'));
            const stock = parseInt(formData.get('stock'));
            const description = formData.get('description');
            const imageFile = document.getElementById('productImage').files[0];

            // Validasi
            if (!name || !category || !price || !stock) {
                showAlert('Harap isi semua field yang wajib diisi!', 'danger');
                return;
            }

            if (id) {
                // Edit produk yang sudah ada
                const index = products.findIndex(p => p.id === parseInt(id));
                if (index !== -1) {
                    products[index] = {
                        ...products[index],
                        name,
                        category,
                        price,
                        stock,
                        description
                    };
                    
                    // Jika ada gambar baru, update gambar
                    if (imageFile) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            products[index].image = e.target.result;
                            displayProducts();
                        };
                        reader.readAsDataURL(imageFile);
                    } else {
                        displayProducts();
                    }
                    
                    showAlert('Produk berhasil diperbarui!', 'success');
                }
            } else {
                // Tambah produk baru
                const newId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
                const newProduct = {
                    id: newId,
                    name,
                    category,
                    price,
                    stock,
                    description,
                    image: 'https://via.placeholder.com/300x200?text=Produk+Baru'
                };
                
                // Jika ada gambar, gunakan gambar yang diupload
                if (imageFile) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        newProduct.image = e.target.result;
                        products.push(newProduct);
                        displayProducts();
                    };
                    reader.readAsDataURL(imageFile);
                } else {
                    products.push(newProduct);
                    displayProducts();
                }
                
                showAlert('Produk berhasil ditambahkan!', 'success');
            }
            
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
            modal.hide();
        }

        // Fungsi untuk menghapus produk
        function deleteProduct() {
            products = products.filter(p => p.id !== currentProductId);
            displayProducts();
            showAlert('Produk berhasil dihapus!', 'success');
            
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
            modal.hide();
            
            currentProductId = null;
        }

        // Fungsi untuk mencari produk
        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            
            let filteredProducts = products;
            
            // Filter berdasarkan pencarian
            if (searchTerm) {
                filteredProducts = filteredProducts.filter(product => 
                    product.name.toLowerCase().includes(searchTerm) || 
                    product.description.toLowerCase().includes(searchTerm)
                );
            }
            
            // Filter berdasarkan kategori
            if (categoryFilter) {
                filteredProducts = filteredProducts.filter(product => 
                    product.category === categoryFilter
                );
            }
            
            // Urutkan produk
            const sortBy = document.getElementById('sortBy').value;
            if (sortBy === 'name') {
                filteredProducts.sort((a, b) => a.name.localeCompare(b.name));
            } else if (sortBy === 'price') {
                filteredProducts.sort((a, b) => a.price - b.price);
            } else if (sortBy === 'date') {
                // Untuk contoh, kita anggap produk dengan ID lebih tinggi adalah yang lebih baru
                filteredProducts.sort((a, b) => b.id - a.id);
            }
            
            // Reset ke halaman pertama
            currentPage = 1;
            displayProducts(filteredProducts);
        }

        // Fungsi untuk update pagination
        function updatePagination(totalProducts) {
            const totalPages = Math.ceil(totalProducts / productsPerPage);
            const paginationContainer = document.getElementById('paginationContainer');
            paginationContainer.innerHTML = '';

            if (totalPages <= 1) return;

            // Tombol Previous
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>`;
            prevLi.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    displayProducts();
                }
            });
            paginationContainer.appendChild(prevLi);

            // Nomor halaman
            for (let i = 1; i <= totalPages; i++) {
                const pageLi = document.createElement('li');
                pageLi.className = `page-item ${i === currentPage ? 'active' : ''}`;
                pageLi.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                pageLi.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    displayProducts();
                });
                paginationContainer.appendChild(pageLi);
            }

            // Tombol Next
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>`;
            nextLi.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    displayProducts();
                }
            });
            paginationContainer.appendChild(nextLi);
        }

        // Fungsi untuk menampilkan alert
        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();
            
            const alertHtml = `
                <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            alertContainer.innerHTML = alertHtml;
            
            // Auto dismiss setelah 5 detik
            setTimeout(() => {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    const bsAlert = new bootstrap.Alert(alertElement);
                    bsAlert.close();
                }
            }, 5000);
        }

        // Event listeners saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan produk
            displayProducts();
            
            // Event listener untuk tombol tambah produk
            document.querySelector('[data-bs-target="#addProductModal"]').addEventListener('click', addProduct);
            
            // Event listener untuk tombol simpan produk
            document.getElementById('saveProductBtn').addEventListener('click', saveProduct);
            
            // Event listener untuk tombol konfirmasi hapus
            document.getElementById('confirmDeleteBtn').addEventListener('click', deleteProduct);
            
            // Event listener untuk pencarian
            document.getElementById('searchButton').addEventListener('click', searchProducts);
            document.getElementById('searchInput').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    searchProducts();
                }
            });
            
            // Event listener untuk filter dan sort
            document.getElementById('categoryFilter').addEventListener('change', searchProducts);
            document.getElementById('sortBy').addEventListener('change', searchProducts);
            
            // Event listener untuk preview gambar
            document.getElementById('productImage').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = 
                            `<img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection