    @extends('admin.template')

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
            --gradient: linear-gradient(135deg, #4361ee, #3f37c9);
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
        }

        body {
            background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        h3 {
            color: var(--secondary);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid;
            margin-bottom: 2rem;
        }

        .alert-warning {
            background: rgba(248, 150, 30, 0.1);
            color: #b45309;
            border-left-color: var(--warning);
        }

        .alert-success {
            background: rgba(76, 201, 240, 0.1);
            color: #0a6c7c;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: rgba(247, 37, 133, 0.1);
            color: #9d174d;
            border-left-color: var(--danger);
        }

        .table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .table thead {
            background: var(--gradient);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1.2rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            padding: 1.2rem 1rem;
            vertical-align: middle;
            border: none;
            font-size: 0.95rem;
            color: #374151;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: var(--transition);
            border: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            color: white;
        }

        /* Badge for waiting count */
        .waiting-badge {
            background: var(--warning);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
            box-shadow: 0 2px 8px rgba(248, 150, 30, 0.3);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody, .table tbody tr, .table tbody td {
                display: block;
                width: 100%;
            }

            .table tbody tr {
                margin-bottom: 1.5rem;
                border-radius: 12px;
                box-shadow: var(--shadow);
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
                color: #6b7280;
                font-size: 0.85rem;
                min-width: 120px;
            }

            .table tbody td:last-child {
                flex-direction: column;
                align-items: stretch;
                gap: 0.5rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 1rem;
            }

            h3 {
                font-size: 1.5rem;
                text-align: center;
            }

            .alert {
                padding: 1rem;
                text-align: center;
            }

            .table tbody td {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.3rem;
            }

            .table tbody td::before {
                margin-bottom: 0.2rem;
            }
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

        .table {
            animation: fadeIn 0.6s ease-out;
        }

        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }
    </style>


    <h3>
        <i class="bi bi-shop"></i> Daftar Pengajuan Toko
        @if($tokoMenunggu > 0)
        <span class="waiting-badge">{{ $tokoMenunggu }} Menunggu</span>
        @endif
    </h3>

    @if($tokoMenunggu > 0)
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle"></i>
        Ada <b>{{ $tokoMenunggu }}</b> toko yang menunggu persetujuan!
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Toko</th>
                    <th>Pemilik</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($toko as $t)
                <tr>
                    <td data-label="Nama Toko">
                        <strong>{{ $t->nama }}</strong>
                    </td>
                    <td data-label="Pemilik">
                        <i class="bi bi-person"></i> {{ $t->user->name }}
                    </td>
                    <td data-label="Alamat">
                        <i class="bi bi-geo-alt"></i> {{ $t->alamat }}
                    </td>
                    <td data-label="Kontak">
                        @if($t->kontak)
                        <i class="bi bi-telephone"></i> {{ $t->kontak }}
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td data-label="Aksi">
                        <form method="POST" action="{{ route('admin.toko.setujui', $t->id) }}" style="display:inline-block;">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                <i class="bi bi-check-lg"></i> Setujui
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.toko.tolak', $t->id) }}" style="display:inline-block;">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-x-lg"></i> Tolak
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if(count($toko) === 0)
                <tr>
                    <td colspan="5" class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h5>Tidak ada pengajuan toko</h5>
                        <p class="text-muted">Semua pengajuan telah diproses</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

