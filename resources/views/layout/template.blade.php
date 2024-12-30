<!-- Start of Selection -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}"> <!-- Link ke file template.css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>@yield('title', 'Portal Berita')</title>
</head>
<body>
    <nav>@yield('navbar')</nav>
    

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <h2>Berita Terbaru</h2>
                    @yield('content')
                </div>
            </div>
            <div class="col-md-4">
                <div class="container">
                    <h2>Statistik</h2>
                    <ul class="list-group">
                        <li class="list-group-item"><i class="fas fa-users"></i> Jumlah Pengguna Terdaftar: 100</li>
                        <li class="list-group-item"><i class="fas fa-newspaper"></i> Jumlah Berita: 50</li>
                        <li class="list-group-item"><i class="fas fa-eye"></i> Jumlah Kunjungan Hari Ini: 200</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- End of Selection -->
