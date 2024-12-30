<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard - Berita</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar">
        <h4>Admin Portal Berita</h4>
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <!-- Pengguna -->
        <a href="{{ route('user.index') }}">
          <i class="fas fa-users"></i> Pengguna
        </a>

        <!-- Berita -->
        <a href="{{ route('news.index') }}">
          <i class="fas fa-newspaper"></i> Berita
        </a>
      </div>

      <!-- Content -->
      <div class="content flex-grow-1">
        <!-- User Info and Logout Button -->
        <div class="user-info">
            <!-- User Greeting (Hi, [Username] or Guest) -->
            <span class="user-greeting" onclick="toggleDropdown()">Hi, {{ auth()->user()->name ?? 'Guest' }}</span>
        
            <!-- Dropdown Menu -->
            <div id="dropdown-menu" class="dropdown-menu">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn fas fa-sign-out-alt">Logout</button>
                </form>
            </div>
        </div>

        <h2 class="mb-4" style="font-weight: bold;">Tambah Berita</h2>

        <!-- Vertical Form -->
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Berita Baru</h5>

              <!-- Form to Add Berita -->
              <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                </div>
    
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                </div>
    
                <div class="mb-3">
                    <label for="konten" class="form-label">Konten Berita</label>
                    <textarea id="konten" name="konten" class="form-control" rows="10" required>{{ old('konten') }}</textarea>
                </div>
    
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Simpan Berita</button>
                    <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
