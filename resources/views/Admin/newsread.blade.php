<!DOCTYPE html>
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
            <h4 style="text-align: center;">Admin Portal Berita</h4>
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('user.index') }}">
                <i class="fas fa-users"></i> Pengguna
            </a>
            <a class="active" href="{{ route('news.index') }}">
                <i class="fas fa-newspaper"></i> Berita
            </a>
        </div>

        <!-- Content -->
        <div class="content flex-grow-1">
            <!-- User Info and Logout Button -->
            <div class="user-info">
                <span class="user-greeting" onclick="toggleDropdown()">Hi, {{ auth()->user()->name ?? 'Guest' }}</span>
                <div id="dropdown-menu" class="dropdown-menu">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn fas fa-sign-out-alt">Logout</button>
                    </form>
                </div>
            </div>

            <h2 class="mb-4" style="font-weight: bold;">Berita</h2>

            <!-- Button Add New -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('news.create') }}" class="btn btn-add-new">
                    <i class="fas fa-plus"></i> Tambah Berita
                </a>
            </div>          

            <!-- Table Berita -->
            <div class="card">
                <h5 class="card-header">List Berita</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th>Konten</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($berita as $item)
                                <tr>
                                    <td>{{ $item->id_berita }}</td>
                                    <td>
                                        {{ Str::limit($item->judul, 50) }}
                                    </td>
                                    <td>{{ $item->name ?? 'Penulis Tidak Diketahui' }}</td>
                                    <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : 'Tidak ada tanggal' }}</td>
                                    <td>{{ $item->konten }}</td>
                                    <td>
                                        <a href="{{ route('news.edit', $item->id_berita) }}" class="text-primary me-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('news.delete', $item->id_berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada berita</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($berita->hasPages())
                    <div class="card-footer">
                        {{ $berita->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

        window.onclick = function(event) {
            if (!event.target.matches('.user-greeting') && !event.target.matches('.logout-btn')) {
                var dropdown = document.getElementById('dropdown-menu');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>
</body>
</html>