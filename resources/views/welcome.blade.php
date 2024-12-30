@extends('layout.template') <!-- Menggunakan layout.blade.php -->

@section('title', 'Portal Berita') <!-- Mengganti bagian title -->

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Portal Berita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#services">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Berita Populer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Tambah Berita</a>
                    <li class="nav-item">
                        <a class="btn btn-custom" href="{{ route('login') }}">Log in</a>
                        <a class="btn btn-custom" href="{{ route('register') }}">Register</a>
                    </li>
            </ul>
            
        </div>
    </div>
</nav>