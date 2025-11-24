@extends('member.layout')

@section('content')
<style>
    .card-custom {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        padding: 20px;
        background: #ffffff;
    }

    .table-modern {
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }

    .table-modern thead {
        background: #4f46e5;
        color: #fff;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    .table-modern tbody tr:hover {
        background: #f3f4f6;
    }

    .btn-add {
        background: #4f46e5;
        border: none;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 10px;
    }

    .btn-add:hover {
        background: #4338ca;
    }

    .btn-action {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .img-thumb {
        border-radius: 8px;
        border: 1px solid #ddd;
        width: 60px;
        height: 60px;
        object-fit: cover;
    }
</style>

<div class="container mt-4">

    <div class="card-custom mb-3 d-flex justify-content-between align-items-center">
        <h4 class="m-0 fw-bold">📦 Manajemen Produk</h4>
        <a href="{{ route('member.produk.create') }}" class="btn btn-add text-white">
            + Tambah Produk
        </a>
    </div>

    <div class="table-modern shadow-sm">
        <table class="table table-bordered m-0">
            <thead>
                <tr>
                    <th style="width: 90px;">Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th width="180px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($produk as $p)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$p->gambar) }}"
                             class="img-thumb">
                    </td>

                    <td class="align-middle fw-semibold">
                        {{ $p->nama }}
                    </td>

                    <td class="align-middle">
                        <span class="badge bg-primary">{{ $p->kategori->nama }}</span>
                    </td>

                    <td class="align-middle fw-bold text-success">
                        Rp {{ number_format($p->harga,0,",",".") }}
                    </td>

                    <td class="align-middle">{{ $p->stok }}</td>

                    <td class="align-middle">

                        <a href="{{ route('member.produk.edit', $p->id) }}"
                           class="btn btn-warning btn-action">
                           ✏ Edit
                        </a>

                        <form action="{{ route('member.produk.destroy',$p->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-action"
                                onclick="return confirm('Hapus produk ini?')">
                                🗑 Hapus
                            </button>

                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection
