@extends('layout.template') <!-- Menggunakan layout.blade.php -->

@section('title', 'Berita Terbaru') <!-- Mengganti bagian title -->
<link rel="stylesheet" href="{{ asset('css/news.css') }}">

@section('navbar')
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
@endsection
@section('content')
<div class="container">
    @foreach($berita as $item)
    <div class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $item->thumbnail_url }}" 
                     alt="{{ $item->judul }}" 
                     class="img-fluid rounded"
                     onerror="this.src='{{ asset('images/default-thumbnail.jpg') }}'"
                     style="object-fit: cover; height: 200px; width: 100%;">
            </div>
            <div class="col-md-8">
                <h4>
                    <a href="{{ route('detail', $item->id_berita) }}" class="news-title">
                        {{ $item->judul }}
                    </a>
                </h4>
                
                <!-- Opsi Edit dan Hapus yang sudah dimodifikasi -->
                @if(Auth::check() && Auth::user()->role === 'owner')
                <div class="text-muted small mb-2">
                    <a href="{{ route('news.edit', $item->id_berita) }}" class="text-dark text-decoration-none">Edit</a>
                    <span class="mx-1">|</span>
                    <form action="{{ route('news.destroy', $item->id_berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-dark text-decoration-none border-0 bg-transparent p-0">Hapus</button>
                    </form>
                </div>
                @endif

                <p class="news-meta">
                    Posted by {{ $item->user->name ?? 'Unknown' }} - 
                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : 'N/A' }}
                </p>
                <p>
                    {{ Str::limit($item->konten, 150) }} 
                    <a href="{{ route('detail', $item->id_berita) }}" class="read-more">Baca selengkapnya</a>
                </p>
            </div>
        </div>
    </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $berita->links() }}
    </div>
</div>
@endsection
