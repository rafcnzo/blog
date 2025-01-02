@extends('layout.template')

@section('title', 'Berita Populer')
<link rel="stylesheet" href="{{ asset('css/news.css') }}">

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
        {{ $berita->links('pagination::bootstrap-4')}}
    </div>
</div>
@endsection