@extends('layout.template')

@section('title', 'Tambah Berita')

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
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>

<div class="form-container p-4">
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

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Berita</button>
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection