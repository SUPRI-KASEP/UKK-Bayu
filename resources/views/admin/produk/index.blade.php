    @extends('admin.beranda')

    @section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f72585;
            --info: #7209b7;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border-radius: 16px;
            --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --box-shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
        }

        body {
            background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .component-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2.5rem;
            margin-top: 1.5rem;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .component-content:hover {
            box-shadow: var(--box-shadow-hover);
        }

        .alert {
            border-radius: var(--border-radius);
            border: none;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: rgba(76, 201, 240, 0.1);
            color: #0a6c7c;
            border-left-color: var(--success);
        }

        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            background: white;
        }

        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1.5rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(67, 97, 238, 0.05) 0%, rgba(255,255,255,1) 100%);
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .table tbody td {
            padding: 1.5rem 1rem;
            vertical-align: middle;
            border: none;
            font-size: 1rem;
        }

        .badge {
            background: linear-gradient(135deg, var(--primary-light), var(--info));
            color: white;
            font-weight: 600;
            padding: 0.6rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.3);
        }

        .badge.bg-info {
            background: linear-gradient(135deg, var(--success), #3a86ff) !important;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, var(--warning), #fb5607) !important;
            color: white !important;
        }

        .fw-semibold {
            font-weight: 600;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .fw-bold.text-success {
            color: #10b981 !important;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            padding: 0.6rem 1rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.5rem 0.9rem;
            font-size: 0.8rem;
        }

        .btn-info {
            background: linear-gradient(135deg, var(--success), #3a86ff);
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #3ab0d6, #2a75ff);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(58, 134, 255, 0.3);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #fb5607);
            color: white;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e08617, #e64900);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(251, 86, 7, 0.3);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #e63946);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #e11473, #d00000);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
            color: white;
        }

        .empty-row {
            color: var(--gray);
            font-style: italic;
            background: rgba(0, 0, 0, 0.02);
            font-size: 1.1rem;
            padding: 3rem !important;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Header section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
        }

        .page-title {
            color: var(--secondary);
            font-weight: 800;
            font-size: 2rem;
            margin: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title i {
            margin-right: 0.5rem;
        }

        .add-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 12px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .component-content {
                padding: 1.5rem;
                margin: 1rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .table thead {
                display: none;
            }

            .table tbody, .table tbody tr, .table tbody td {
                display: block;
                width: 100%;
            }

            .table tbody tr {
                margin-bottom: 1.5rem;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
                padding: 1.5rem;
            }

            .table tbody td {
                padding: 0.8rem 0;
                border: none;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--gray);
                font-size: 0.85rem;
                min-width: 80px;
            }

            .action-buttons {
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .component-content {
                padding: 1.2rem;
            }

            .table tbody td {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .table tbody td::before {
                margin-bottom: 0.3rem;
            }

            .badge {
                font-size: 0.8rem;
                padding: 0.5rem 0.8rem;
            }
        }

        /* Price styling */
        .price {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>


    <div class="component-content fade-in">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
        @endif


        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 8%">ID</th>
                        <th style="width: 20%">Nama</th>
                        <th style="width: 15%">Harga</th>
                        <th style="width: 15%">Kategori</th>
                        <th style="width: 15%">Toko</th>
                        <th class="text-center" style="width: 27%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                    <tr>
                        <td data-label="ID"><span class="badge">{{ $produk->id }}</span></td>
                        <td data-label="Nama" class="fw-semibold">{{ $produk->nama }}</td>
                        <td data-label="Harga" class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td data-label="Kategori"><span class="badge bg-info">{{ $produk->kategori->nama }}</span></td>
                        <td data-label="Toko"><span class="badge bg-warning">{{ $produk->toko->nama }}</span></td>
                        <td data-label="Aksi" class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('admin.produk.show', $produk) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center empty-row py-5">
                            <i class="bi bi-box display-4 d-block mb-3" style="color: #6c757d;"></i>
                            Belum ada data produk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

