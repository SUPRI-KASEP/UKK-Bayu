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
            background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .dashboard-content {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            animation: fadeInUp .6s ease;
            max-width: 650px;
            margin: 2rem auto;
            border: 1px solid rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        h2 {
            font-weight: 800;
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
            width: 80px;
            height: 4px;
            background: var(--gradient);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.8rem;
            position: relative;
        }

        label {
            font-weight: 700;
            margin-bottom: 0.8rem;
            display: block;
            color: #2d3748;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control {
            border-radius: 12px;
            padding: 1rem 1.2rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            font-size: 1rem;
            background: #fafbff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
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

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5;
        }

        .btn-primary {
            background: var(--gradient);
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 0.5rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3a56d4, #372fb0);
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Icon styling for form elements */
        .form-group::before {
            font-family: 'bootstrap-icons';
            position: absolute;
            top: 2.8rem;
            left: 1rem;
            color: var(--primary);
            font-size: 1.2rem;
            z-index: 2;
        }

        .form-group:nth-child(1)::before {
            content: "\F5B0"; /* bi-shop icon */
        }

        .form-group:nth-child(2)::before {
            content: "\F3E8"; /* bi-geo-alt icon */
        }

        .form-group:nth-child(1) .form-control,
        .form-group:nth-child(2) .form-control {
            padding-left: 3rem;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                padding: 0.9rem 1rem;
            }

            .form-group:nth-child(1) .form-control,
            .form-group:nth-child(2) .form-control {
                padding-left: 2.8rem;
            }

            .form-group::before {
                left: 0.8rem;
                font-size: 1.1rem;
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

            .btn-primary {
                padding: 0.9rem 1.5rem;
                font-size: 1rem;
            }
        }

        /* Loading state for button */
        .btn-primary.loading {
            position: relative;
            color: transparent;
        }

        .btn-primary.loading::after {
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
    </style>
    <div class="dashboard-content">
        <h2>Edit Toko</h2>

        <form action="{{ route('admin.toko.update', $toko) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama Toko</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $toko->nama }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" class="form-control" required>{{ $toko->alamat }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-2"></i>Update Data Toko
            </button>
            <a href="{{ route('admin.toko.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
            </a>
        </form>
    </div>
@endsection
