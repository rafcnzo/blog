<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Sansita:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <title>@yield('title', 'Portal Berita')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Portal Berita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('berita.populer') }}">Berita Populer</a>
                    </li>
                    
                    @if(Auth::check() && Auth::user()->role === 'owner')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news.create') }}">Tambah Berita</a>
                    </li>
                    @endif
    
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                                Hi, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item d-flex gap-2">
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">Log in</a>
                            <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="container">
                        <h2>@yield('title')</h2>
                        @yield('content')
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="container">
                        <h2>
                            <i class="fas fa-chart-bar me-2"></i>
                            Statistik
                        </h2>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fas fa-users"></i>
                                <span>Pengguna Terdaftar: <strong>{{ $jumlah_pengguna }}</strong></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-newspaper"></i>
                                <span>Total Berita: <strong>{{ $jumlah_berita }}</strong></span>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-eye"></i>
                                <span>Kunjungan Hari Ini: <strong>20</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="text-center p-3">
            © 2024 Portal Berita: SA02_041, 042, 052, 060, 061.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>