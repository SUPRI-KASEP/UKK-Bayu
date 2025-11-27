{{-- resources/views/member/layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Member Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Styling untuk layout flexbox */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        main {
            flex: 1;
        }

        .navbar-nav .nav-link {
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #d1d5db !important;
        }

        /* Styling untuk footer */
        .footer {
            margin-top: auto;
            background-color: #1e293b;
        }

        /* Active state untuk navbar */
        .navbar-nav .nav-link.active {
            color: #ffffff !important;
            font-weight: 600;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: #1e293b">
        <div class="container-fluid">
            {{-- Brand di kiri --}}
            <a class="navbar-brand fw-bold ms-3" href="{{ route('member.beranda') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Halaman Member
            </a>

            {{-- Mobile Toggle Button --}}
            <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Navbar Content di kanan --}}
            <div class="collapse navbar-collapse" id="navbarContent">
                <div class="navbar-nav ms-auto align-items-center me-3">
                    {{-- Beranda --}}
                    <a href="{{ route('member.beranda') }}"
                       class="nav-link mx-2 {{ request()->routeIs('member.beranda') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>

                    {{-- Produk --}}
                    <a href="{{ route('member.produk') }}"
                       class="nav-link mx-2 {{ request()->routeIs('member.produk') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-box me-1"></i>Produk
                    </a>

                    {{-- Toko --}}
                    <a href="{{ route('member.toko') }}"
                       class="nav-link mx-2 {{ request()->routeIs('member.toko') ? 'active fw-bold' : '' }}">
                        <i class="fas fa-store me-1"></i>Toko
                    </a>

                    {{-- Logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow-1 py-4">
        <div class="container">
            {{-- Page Header --}}
            @hasSection('page-header')
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h1 class="h3 mb-0 text-primary">@yield('page-header')</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Main Content --}}
            @yield('content')
        </div>
    </main>

    {{-- Footer Menempel Bawah --}}
    <footer class="footer text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold">Member Dashboard</h5>
                    <p class="mb-0">Sistem manajemen member yang mudah dan efisien.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} Member Dashboard. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Additional Scripts --}}
    @stack('scripts')
</body>
</html>
