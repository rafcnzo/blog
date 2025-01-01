@extends('layout.template')

@section('title', 'Berita Populer')
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
@parent
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
                <p class="text-muted">
                    Posted by {{ $item->user->name }} - 
                    {{ $item->created_at->format('d M Y') }}
                    
                    {{-- Tampilkan jumlah komentar --}}
                    <span class="ms-2">
                        <i class="fas fa-comment"></i> 
                        {{ $item->komentars_count }} Komentar
                    </span>
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