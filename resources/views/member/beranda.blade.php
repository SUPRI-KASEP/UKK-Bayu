{{-- resources/views/member/beranda.blade.php --}}
@extends('member.layout')

@section('title', 'Beranda Member')

@section('content')
    <div class="text-center mb-4">
        <h1>Selamat Datang di Beranda Member</h1>
        <p>Ini adalah halaman beranda khusus untuk member.</p>
    </div>

    <div class="row">
        @forelse($produk as $p)
            <div class="col-md-6 col-lg-3 mb-4 product-item" 
                 data-id="{{ $p->id }}"
                 data-name="{{ strtolower($p->nama) }}" 
                 data-category="{{ $p->kategori_id }}" 
                 data-price="{{ $p->harga }}"
                 data-stock="{{ $p->stok }}"
                 data-date="{{ $p->created_at->format('Y-m-d H:i:s') }}">
                 
                <div class="card h-100">
                    <img src="{{ $p->gambar ? asset('storage/'.$p->gambar) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                         class="card-img-top product-image" alt="{{ $p->nama }}"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $p->nama }}</h5>
                        <p class="text-muted mb-2">Kategori: {{ $p->kategori->nama ?? '-' }}</p>
                        <p class="card-text flex-grow-1">{{ Str::limit($p->deskripsi, 120) }}</p>

                        <div class="mb-2">
                            <span class="badge bg-{{ $p->stok > 0 ? 'success' : 'danger' }}">
                                Stok: {{ $p->stok }}
                            </span>
                        </div>

                        {{-- Bagian harga & tombol --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-primary mb-0">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </h5>

                            <div class="action-buttons">

                                {{-- Tombol WA Me --}}
                                <a href="https://wa.me/{{ $p->toko->kontak ?? '' }}?text={{ urlencode('Halo, saya ingin membeli produk '.$p->nama.' dari toko '.$p->toko->nama) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-success"
                                   title="Chat Penjual">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                <a href="{{ route('member.produk.show', $p->id) }}"
                                    class="btn btn-sm btn-outline-info"
                                    title="Detail">
                                        <i class="fas fa-eye"></i>
                                </a>


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

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(($loop->iteration) % 4 == 0 && !$loop->last)
                </div><div class="row">
            @endif

        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada produk</h4>
                <p class="text-muted">Silakan tambahkan produk terlebih dahulu di toko Anda.</p>
            </div>
        @endforelse
    </div>
@endsection
