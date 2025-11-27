@extends('member.layout')

@section('title', 'Marketplace Member')

@section('content')
    <div class="text-center mb-4">
        <h1>Selamat Datang di Marketplace</h1>
        <p class="lead">Jelajahi produk dari seluruh member kami</p>

        {{-- Info toko user --}}
        @if($toko)
            <div class="alert alert-info d-inline-block">
                <i class="fas fa-store"></i>
                Toko Anda: <strong>{{ $toko->nama }}</strong> |
                <a href="{{ route('member.produk') }}" class="alert-link">Kelola Produk Saya</a>
            </div>
        @else
            <div class="alert alert-warning d-inline-block">
                <i class="fas fa-info-circle"></i>
                Anda belum memiliki toko.
                <a href="{{ route('member.toko') }}" class="alert-link">Buat toko sekarang</a>
                untuk mulai berjualan!
            </div>
        @endif
    </div>

    {{-- Filter & Search --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari produk...">
        </div>
        <div class="col-md-3">
            <select id="categoryFilter" class="form-select">
                <option value="all">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select id="ownerFilter" class="form-select">
                <option value="all">Semua Penjual</option>
                @if($toko)
                    <option value="my">Produk Saya</option>
                @endif
                <option value="others">Produk Member Lain</option>
            </select>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="row" id="productsContainer">
        @forelse($produk as $p)
            <div class="col-md-6 col-lg-3 mb-4 product-item"
                 data-id="{{ $p->id }}"
                 data-name="{{ strtolower($p->nama) }}"
                 data-category="{{ $p->kategori_id }}"
                 data-price="{{ $p->harga }}"
                 data-stock="{{ $p->stok }}"
                 data-owner="{{ $toko && $p->toko_id == $toko->id ? 'my' : 'others' }}">

                <div class="card h-100 shadow-sm product-card">
                    {{-- Badge untuk produk sendiri --}}
                    @if($toko && $p->toko_id == $toko->id)
                        <div class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-primary">
                                <i class="fas fa-star me-1"></i>Produk Saya
                            </span>
                        </div>
                    @endif

                    {{-- Gambar Produk --}}
                    <img src="{{ $p->gambar ? asset('storage/'.$p->gambar) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                         class="card-img-top product-image" alt="{{ $p->nama }}"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        {{-- Nama Produk --}}
                        <h5 class="card-title mb-1">{{ $p->nama }}</h5>

                        {{-- Info Penjual --}}
                        <p class="text-muted small mb-2">
                            <i class="fas fa-store"></i>
                            {{ $p->toko->nama }}
                            @if($toko && $p->toko_id == $toko->id)
                                <span class="text-success">(Anda)</span>
                            @endif
                        </p>

                        {{-- Kategori --}}
                        <p class="text-muted mb-2 small">
                            <i class="fas fa-tag"></i> {{ $p->kategori->nama ?? '-' }}
                        </p>

                        {{-- Deskripsi --}}
                        <p class="card-text flex-grow-1 small text-muted">
                            {{ Str::limit($p->deskripsi, 100) }}
                        </p>

                        {{-- Stok --}}
                        <div class="mb-2">
                            <span class="badge bg-{{ $p->stok > 0 ? 'success' : 'danger' }}">
                                <i class="fas fa-box"></i> Stok: {{ $p->stok }}
                            </span>
                        </div>

                        {{-- Harga & Action Buttons --}}
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <h5 class="text-primary mb-0">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </h5>

                            <div class="action-buttons">
                                {{-- Tombol WA --}}
                                <a href="https://wa.me/{{ $p->toko->kontak ?? '' }}?text={{ urlencode('Halo, saya ingin membeli produk '.$p->nama.' dari toko '.$p->toko->nama) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-success"
                                   title="Chat Penjual">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                {{-- Tombol Detail --}}
                                <a href="{{ route('member.show', $p->id) }}"
                                    class="btn btn-sm btn-outline-info"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Edit & Hapus (hanya untuk produk sendiri) --}}
                                @if($toko && $p->toko_id == $toko->id)
                                    <a href="{{ route('member.produk.edit', $p->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('member.produk.destroy', $p->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Break row setiap 4 produk --}}
            @if(($loop->iteration) % 4 == 0 && !$loop->last)
                </div><div class="row">
            @endif

        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada produk di marketplace</h4>
                <p class="text-muted">Jadilah yang pertama menambahkan produk!</p>
                @if($toko)
                    <a href="{{ route('member.produk.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Produk Pertama
                    </a>
                @else
                    <a href="{{ route('member.toko') }}" class="btn btn-primary">
                        <i class="fas fa-store"></i> Buat Toko Dulu
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- JavaScript untuk Filter --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const ownerFilter = document.getElementById('ownerFilter');
            const productItems = document.querySelectorAll('.product-item');

            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;
                const selectedOwner = ownerFilter.value;

                let visibleCount = 0;

                productItems.forEach(item => {
                    const productName = item.getAttribute('data-name');
                    const productCategory = item.getAttribute('data-category');
                    const productOwner = item.getAttribute('data-owner');

                    const nameMatch = productName.includes(searchTerm);
                    const categoryMatch = selectedCategory === 'all' || productCategory === selectedCategory;
                    const ownerMatch = selectedOwner === 'all' || productOwner === selectedOwner;

                    if (nameMatch && categoryMatch && ownerMatch) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada produk
                const container = document.getElementById('productsContainer');
                let noProductsMsg = container.querySelector('.no-products-message');

                if (visibleCount === 0 && !noProductsMsg) {
                    noProductsMsg = document.createElement('div');
                    noProductsMsg.className = 'col-12 text-center py-5 no-products-message';
                    noProductsMsg.innerHTML = `
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak ada produk yang sesuai</h4>
                        <p class="text-muted">Coba gunakan kata kunci atau filter lain</p>
                    `;
                    container.appendChild(noProductsMsg);
                } else if (visibleCount > 0 && noProductsMsg) {
                    noProductsMsg.remove();
                }
            }

            searchInput.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);
            ownerFilter.addEventListener('change', filterProducts);

            // Sembunyikan filter "Produk Saya" jika tidak punya toko
            @if(!$toko)
                const ownerFilterSelect = document.getElementById('ownerFilter');
                const myProductOption = ownerFilterSelect.querySelector('option[value="my"]');
                if (myProductOption) {
                    myProductOption.style.display = 'none';
                }
            @endif
        });
    </script>

    <style>
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        .action-buttons .btn {
            margin-left: 2px;
        }
    </style>
@endsection
