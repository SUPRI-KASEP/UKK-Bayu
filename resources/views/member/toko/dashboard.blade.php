@extends('member.layout')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .store-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .store-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .store-image {
            height: 200px;
            object-fit: cover;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }
        .step-indicator::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e9ecef;
            z-index: 1;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .step.active .step-number {
            background-color: #0d6efd;
            color: white;
        }
        .step.completed .step-number {
            background-color: #198754;
            color: white;
        }
        .step-label {
            font-size: 0.875rem;
            text-align: center;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .preview-image {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<>
    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-1">Daftar Toko</h1>
                        <p class="text-muted">Lengkapi data toko Anda untuk mulai menjual produk</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-store me-1"></i>
                                Belum Memiliki Toko
                            </span>
                        </div>
                        <a href="{{ route('member.beranda') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Notifikasi -->
        <div id="alertContainer"></div>

        <!-- Jika belum memiliki toko -->
        <div id="noStoreSection">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-store fa-4x text-muted mb-3"></i>
                                <h3 class="text-muted">Anda Belum Memiliki Toko</h3>
                                <p class="text-muted">Daftarkan toko Anda sekarang untuk mulai menjual produk di platform kami.</p>
                            </div>
                            <button class="btn btn-primary btn-lg" id="startRegistrationBtn">
                                <i class="fas fa-plus me-2"></i>Daftarkan Toko Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Keuntungan -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="text-center mb-4">Keuntungan Memiliki Toko</h4>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0">
                        <div class="card-body text-center">
                            <i class="fas fa-shopping-cart fa-2x text-primary mb-3"></i>
                            <h5>Jual Produk</h5>
                            <p class="text-muted">Mulai menjual produk Anda kepada jutaan pelanggan potensial</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-2x text-success mb-3"></i>
                            <h5>Analisis Bisnis</h5>
                            <p class="text-muted">Akses dashboard analisis untuk memantau perkembangan toko</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0">
                        <div class="card-body text-center">
                            <i class="fas fa-headset fa-2x text-info mb-3"></i>
                            <h5>Dukungan Penuh</h5>
                            <p class="text-muted">Dapatkan dukungan tim kami untuk mengembangkan toko Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pendaftaran Toko -->
        <div id="registrationForm" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Step Indicator -->
                    <div class="step-indicator">
                        <div class="step active" id="step1">
                            <div class="step-number">1</div>
                            <div class="step-label">Data Toko</div>
                        </div>
                        <div class="step" id="step2">
                            <div class="step-number">2</div>
                            <div class="step-label">Alamat</div>
                        </div>
                        <div class="step" id="step3">
                            <div class="step-number">3</div>
                            <div class="step-label">Konfirmasi</div>
                        </div>
                    </div>

                    <!-- Form Data Toko -->
                    <div class="form-section active" id="section1">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-store me-2"></i>Data Toko</h5>
                            </div>
                            <div class="card-body">
                                <form id="storeForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="storeName" class="form-label">Nama Toko <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="storeName" name="storeName" required>
                                                <div class="form-text">Nama toko akan menjadi identitas toko Anda</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="storeCategory" class="form-label">Kategori Toko <span class="text-danger">*</span></label>
                                                <select class="form-select" id="storeCategory" name="storeCategory" required>
                                                    <option value="">Pilih Kategori</option>
                                                    <option value="Fashion">Fashion</option>
                                                    <option value="Elektronik">Elektronik</option>
                                                    <option value="Makanan & Minuman">Makanan & Minuman</option>
                                                    <option value="Kesehatan & Kecantikan">Kesehatan & Kecantikan</option>
                                                    <option value="Rumah Tangga">Rumah Tangga</option>
                                                    <option value="Olahraga">Olahraga</option>
                                                    <option value="Hobi">Hobi</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="storePhone" class="form-label">Telepon Toko <span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="storePhone" name="storePhone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="storeDescription" class="form-label">Deskripsi Toko</label>
                                                <textarea class="form-control" id="storeDescription" name="storeDescription" rows="5" placeholder="Jelaskan tentang toko Anda..."></textarea>
                                                <div class="form-text">Maksimal 500 karakter</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="storeLogo" class="form-label">Logo Toko</label>
                                                <input type="file" class="form-control" id="storeLogo" name="storeLogo" accept="image/*">
                                                <div class="form-text">Format: JPG, PNG. Maksimal 2MB</div>
                                                <div id="logoPreview" class="mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" id="nextToStep2">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Alamat Toko -->
                    <div class="form-section" id="section2">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Alamat Toko</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                            <select class="form-select" id="province" name="province" required>
                                                <option value="">Pilih Provinsi</option>
                                                <option value="DKI Jakarta">DKI Jakarta</option>
                                                <option value="Jawa Barat">Jawa Barat</option>
                                                <option value="Jawa Tengah">Jawa Tengah</option>
                                                <option value="Jawa Timur">Jawa Timur</option>
                                                <option value="Banten">Banten</option>
                                                <option value="DI Yogyakarta">DI Yogyakarta</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                            <select class="form-select" id="city" name="city" required>
                                                <option value="">Pilih Kota/Kabupaten</option>
                                            <!-- Options akan diisi berdasarkan provinsi yang dipilih -->
                                            <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                <option value="Jakarta Utara">Jakarta Utara</option>
                                                <option value="Jakarta Barat">Jakarta Barat</option>
                                                <option value="Jakarta Timur">Jakarta Timur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="district" name="district" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="postalCode" class="form-label">Kode Pos</label>
                                            <input type="text" class="form-control" id="postalCode" name="postalCode">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="fullAddress" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="fullAddress" name="fullAddress" rows="3" required placeholder="Jl. Contoh No. 123, RT/RW ..."></textarea>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="sameAsProfile" name="sameAsProfile">
                                    <label class="form-check-label" for="sameAsProfile">
                                        Gunakan alamat yang sama dengan profil saya
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" id="backToStep1">
                                        <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary" id="nextToStep3">
                                        Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Konfirmasi Pendaftaran -->
                    <div class="form-section" id="section3">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Konfirmasi Pendaftaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Perhatian:</strong> Pastikan semua data yang Anda masukkan sudah benar. Data toko tidak dapat diubah dalam 7 hari setelah pendaftaran.
                                </div>
                                
                                <h6 class="mb-3">Ringkasan Data Toko:</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">Nama Toko</th>
                                                <td id="confirmStoreName">-</td>
                                            </tr>
                                            <tr>
                                                <th>Kategori</th>
                                                <td id="confirmStoreCategory">-</td>
                                            </tr>
                                            <tr>
                                                <th>Telepon</th>
                                                <td id="confirmStorePhone">-</td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <td id="confirmStoreDescription">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="40%">Provinsi</th>
                                                <td id="confirmProvince">-</td>
                                            </tr>
                                            <tr>
                                                <th>Kota</th>
                                                <td id="confirmCity">-</td>
                                            </tr>
                                            <tr>
                                                <th>Kecamatan</th>
                                                <td id="confirmDistrict">-</td>
                                            </tr>
                                            <tr>
                                                <th>Kode Pos</th>
                                                <td id="confirmPostalCode">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Alamat Lengkap:</strong>
                                    <p id="confirmFullAddress" class="mt-1">-</p>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Logo Toko:</strong>
                                    <div id="confirmLogoPreview" class="mt-2"></div>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        Saya menyetujui <a href="#" target="_blank">Syarat dan Ketentuan</a> serta <a href="#" target="_blank">Kebijakan Privasi</a> yang berlaku
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" id="backToStep2">
                                        <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-success" id="submitRegistration" disabled>
                                        <i class="fas fa-paper-plane me-2"></i> Daftarkan Toko
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jika sudah memiliki toko -->
        <div id="hasStoreSection" style="display: none;">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-1">Toko Saya</h4>
                                    <p class="text-muted mb-0">Kelola toko dan produk Anda dari sini</p>
                                </div>
                                <div>
                                    <span class="badge bg-success me-2">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                    <a href="{{ url('/member/products') }}" class="btn btn-primary">
                                        <i class="fas fa-box me-1"></i> Kelola Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card store-card">
                        <img src="https://via.placeholder.com/300x200?text=Logo+Toko" class="card-img-top store-image" alt="Logo Toko">
                        <div class="card-body">
                            <h5 class="card-title" id="myStoreName">Nama Toko</h5>
                            <p class="card-text">
                                <span class="badge bg-secondary" id="myStoreCategory">Kategori</span>
                                <span class="badge bg-success">Aktif</span>
                            </p>
                            <p class="card-text" id="myStoreDescription">Deskripsi toko akan muncul di sini.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    <span id="myStoreLocation">Lokasi</span>
                                </small>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" id="editStoreBtn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" id="viewStoreBtn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Toko -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 id="productCount">0</h4>
                                            <p class="mb-0">Total Produk</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-box fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 id="orderCount">0</h4>
                                            <p class="mb-0">Pesanan Bulan Ini</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-shopping-cart fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 id="viewCount">0</h4>
                                            <p class="mb-0">Dilihat Bulan Ini</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-eye fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 id="ratingValue">0</h4>
                                            <p class="mb-0">Rating Toko</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-star fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Aksi Cepat</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <a href="{{ url('/member/products/create') }}" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-plus me-1"></i> Tambah Produk
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ url('/member/orders') }}" class="btn btn-outline-success btn-sm w-100">
                                        <i class="fas fa-shopping-cart me-1"></i> Kelola Pesanan
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-info btn-sm w-100" id="promoteStoreBtn">
                                        <i class="fas fa-bullhorn me-1"></i> Promosikan Toko
                                    </button>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-secondary btn-sm w-100" id="storeSettingsBtn">
                                        <i class="fas fa-cog me-1"></i> Pengaturan
                                    </button>
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
        // Data toko (simulasi)
        let userStore = null; // null berarti belum memiliki toko
        let currentStep = 1;

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

        // Fungsi untuk memuat tampilan berdasarkan status toko
        function loadStoreView() {
            if (userStore) {
                // Jika sudah memiliki toko
                document.getElementById('noStoreSection').style.display = 'none';
                document.getElementById('registrationForm').style.display = 'none';
                document.getElementById('hasStoreSection').style.display = 'block';
                
                // Isi data toko
                document.getElementById('myStoreName').textContent = userStore.name;
                document.getElementById('myStoreCategory').textContent = userStore.category;
                document.getElementById('myStoreDescription').textContent = userStore.description;
                document.getElementById('myStoreLocation').textContent = `${userStore.city}, ${userStore.province}`;
                
                // Isi statistik
                document.getElementById('productCount').textContent = userStore.stats.products;
                document.getElementById('orderCount').textContent = userStore.stats.orders;
                document.getElementById('viewCount').textContent = userStore.stats.views;
                document.getElementById('ratingValue').textContent = userStore.stats.rating;
            } else {
                // Jika belum memiliki toko
                document.getElementById('noStoreSection').style.display = 'block';
                document.getElementById('registrationForm').style.display = 'none';
                document.getElementById('hasStoreSection').style.display = 'none';
            }
        }

        // Fungsi untuk berpindah step
        function goToStep(step) {
            // Sembunyikan semua section
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Nonaktifkan semua step
            document.querySelectorAll('.step').forEach(stepEl => {
                stepEl.classList.remove('active', 'completed');
            });
            
            // Tampilkan section yang aktif
            document.getElementById(`section${step}`).classList.add('active');
            
            // Update step indicator
            for (let i = 1; i <= step; i++) {
                if (i === step) {
                    document.getElementById(`step${i}`).classList.add('active');
                } else {
                    document.getElementById(`step${i}`).classList.add('completed');
                }
            }
            
            currentStep = step;
        }

        // Fungsi untuk validasi step 1
        function validateStep1() {
            const storeName = document.getElementById('storeName').value.trim();
            const storeCategory = document.getElementById('storeCategory').value;
            const storePhone = document.getElementById('storePhone').value.trim();
            
            if (!storeName) {
                showAlert('Nama toko harus diisi!', 'danger');
                return false;
            }
            
            if (!storeCategory) {
                showAlert('Kategori toko harus dipilih!', 'danger');
                return false;
            }
            
            if (!storePhone) {
                showAlert('Telepon toko harus diisi!', 'danger');
                return false;
            }
            
            return true;
        }

        // Fungsi untuk validasi step 2
        function validateStep2() {
            const province = document.getElementById('province').value;
            const city = document.getElementById('city').value;
            const district = document.getElementById('district').value.trim();
            const fullAddress = document.getElementById('fullAddress').value.trim();
            
            if (!province) {
                showAlert('Provinsi harus dipilih!', 'danger');
                return false;
            }
            
            if (!city) {
                showAlert('Kota/Kabupaten harus dipilih!', 'danger');
                return false;
            }
            
            if (!district) {
                showAlert('Kecamatan harus diisi!', 'danger');
                return false;
            }
            
            if (!fullAddress) {
                showAlert('Alamat lengkap harus diisi!', 'danger');
                return false;
            }
            
            return true;
        }

        // Fungsi untuk mengisi data konfirmasi
        function fillConfirmationData() {
            document.getElementById('confirmStoreName').textContent = document.getElementById('storeName').value;
            document.getElementById('confirmStoreCategory').textContent = document.getElementById('storeCategory').value;
            document.getElementById('confirmStorePhone').textContent = document.getElementById('storePhone').value;
            document.getElementById('confirmStoreDescription').textContent = document.getElementById('storeDescription').value || '-';
            document.getElementById('confirmProvince').textContent = document.getElementById('province').value;
            document.getElementById('confirmCity').textContent = document.getElementById('city').value;
            document.getElementById('confirmDistrict').textContent = document.getElementById('district').value;
            document.getElementById('confirmPostalCode').textContent = document.getElementById('postalCode').value || '-';
            document.getElementById('confirmFullAddress').textContent = document.getElementById('fullAddress').value;
            
            // Preview logo
            const logoFile = document.getElementById('storeLogo').files[0];
            const logoPreview = document.getElementById('confirmLogoPreview');
            if (logoFile) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail preview-image" alt="Logo Toko">`;
                };
                reader.readAsDataURL(logoFile);
            } else {
                logoPreview.innerHTML = '<span class="text-muted">Tidak ada logo</span>';
            }
        }

        // Fungsi untuk mendaftarkan toko
        function registerStore() {
            const storeData = {
                id: Date.now(),
                name: document.getElementById('storeName').value,
                category: document.getElementById('storeCategory').value,
                phone: document.getElementById('storePhone').value,
                description: document.getElementById('storeDescription').value,
                province: document.getElementById('province').value,
                city: document.getElementById('city').value,
                district: document.getElementById('district').value,
                postalCode: document.getElementById('postalCode').value,
                fullAddress: document.getElementById('fullAddress').value,
                logo: document.getElementById('storeLogo').files[0] ? 
                      URL.createObjectURL(document.getElementById('storeLogo').files[0]) : 
                      'https://via.placeholder.com/300x200?text=Logo+Toko',
                stats: {
                    products: 0,
                    orders: 0,
                    views: 0,
                    rating: 0
                },
                createdAt: new Date().toISOString()
            };
            
            // Simpan data toko
            userStore = storeData;
            
            // Tampilkan notifikasi sukses
            showAlert('Selamat! Toko Anda berhasil didaftarkan.', 'success');
            
            // Kembali ke tampilan toko
            loadStoreView();
        }

        // Event listeners saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Load tampilan awal
            loadStoreView();
            
            // Tombol mulai pendaftaran
            document.getElementById('startRegistrationBtn').addEventListener('click', function() {
                document.getElementById('noStoreSection').style.display = 'none';
                document.getElementById('registrationForm').style.display = 'block';
            });
            
            // Navigasi step
            document.getElementById('nextToStep2').addEventListener('click', function() {
                if (validateStep1()) {
                    goToStep(2);
                }
            });
            
            document.getElementById('backToStep1').addEventListener('click', function() {
                goToStep(1);
            });
            
            document.getElementById('nextToStep3').addEventListener('click', function() {
                if (validateStep2()) {
                    fillConfirmationData();
                    goToStep(3);
                }
            });
            
            document.getElementById('backToStep2').addEventListener('click', function() {
                goToStep(2);
            });
            
            // Preview logo
            document.getElementById('storeLogo').addEventListener('change', function() {
                const file = this.files[0];
                const preview = document.getElementById('logoPreview');
                
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail preview-image" alt="Preview Logo">`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = '';
                }
            });
            
            // Checkbox persetujuan
            document.getElementById('agreeTerms').addEventListener('change', function() {
                document.getElementById('submitRegistration').disabled = !this.checked;
            });
            
            // Submit pendaftaran
            document.getElementById('submitRegistration').addEventListener('click', function() {
                registerStore();
            });
            
            // Checkbox alamat sama dengan profil
            document.getElementById('sameAsProfile').addEventListener('change', function() {
                if (this.checked) {
                    // Isi otomatis dengan data profil (contoh)
                    document.getElementById('province').value = 'DKI Jakarta';
                    document.getElementById('city').value = 'Jakarta Selatan';
                    document.getElementById('district').value = 'Kebayoran Baru';
                    document.getElementById('postalCode').value = '12120';
                    document.getElementById('fullAddress').value = 'Jl. Contoh Alamat Profil No. 123';
                }
            });
            
            // Simulasi: untuk demo, kita anggap user belum memiliki toko
            userStore = null;
            loadStoreView();
        });
    </script>

@endsection