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
            --gradient: linear-gradient(135deg, #4361ee, #3f37c9);
            --shadow: 0 8px 30px rgba(67, 97, 238, 0.15);
            --shadow-hover: 0 12px 40px rgba(67, 97, 238, 0.25);
        }

        body {
            background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .dashboard-content {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            animation: slideInUp 0.6s ease-out;
            max-width: 600px;
            margin: 2rem auto;
            border: 1px solid rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        h2 {
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            padding-bottom: 1rem;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: block;
            color: #2d3748;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control {
            border-radius: 12px;
            padding: 1rem 1.2rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            font-size: 1rem;
            background: #fafbff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
            font-weight: 500;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            background: #ffffff;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #cbd5e0;
        }

        /* Icon styling */
        .form-group::before {
            font-family: 'bootstrap-icons';
            content: "\F5B0";
            position: absolute;
            top: 2.8rem;
            left: 1rem;
            color: var(--primary);
            font-size: 1.2rem;
            z-index: 2;
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.9rem 2.5rem;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            min-width: 140px;
            justify-content: center;
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3a56d4, #372fb0);
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            color: white;
        }

        .btn:active {
            transform: translateY(-1px);
        }

        /* Animation */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Form validation states */
        .form-control:invalid:not(:focus) {
            border-color: #e53e3e;
        }

        .form-control:valid:not(:focus) {
            border-color: #38a169;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .dashboard-content {
                margin: 1rem;
                padding: 2rem 1.5rem;
                border-radius: 16px;
            }

            h2 {
                font-size: 1.7rem;
            }

            .form-control {
                padding: 0.9rem 1rem 0.9rem 2.8rem;
            }

            .form-group::before {
                left: 0.8rem;
                font-size: 1.1rem;
            }

            .btn {
                width: 100%;
                padding: 1rem 2rem;
            }
        }

        @media (max-width: 480px) {
            .dashboard-content {
                padding: 1.5rem 1.2rem;
                margin: 0.5rem;
            }

            h2 {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .btn {
                padding: 0.9rem 1.5rem;
                font-size: 0.95rem;
            }
        }

        /* Loading state */
        .btn.loading {
            position: relative;
            color: transparent;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-right-color: transparent;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Focus states for accessibility */
        .btn:focus,
        .form-control:focus {
            outline: none;
        }

        .btn:focus-visible {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.5);
        }

        /* Success message styling */
        .alert-success {
            background: rgba(72, 187, 120, 0.1);
            border: 1px solid rgba(72, 187, 120, 0.2);
            border-left: 4px solid #48bb78;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            color: #2d3748;
        }
    </style>

    <div class="dashboard-content">
        <h2>Tambah Kategori</h2>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input type="text" name="nama" id="nama" class="form-control" required
                       placeholder="Masukkan nama kategori">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Simpan Kategori
                </button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
            </a>
            </div>
        </form>
    </div>
@endsection

