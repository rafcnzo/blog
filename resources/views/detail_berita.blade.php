@extends('layout.template')
@section('title', $news->judul) <!-- Mengganti bagian title -->

@section('content')
    <p class="text-muted">
        Diposting oleh {{ $news->user->name }} - 
        {{ $news->created_at->format('d M Y') }}
    </p>
    
    @if($news->thumbnail)
    <img src="{{ $news->thumbnail_url }}" 
         alt="{{ $news->judul }}"  
         class="img-fluid mb-4">
    @endif
    
    <div class="news-content">
        {!! nl2br(e($news->konten)) !!}
    </div>

    <a href="{{ route('welcome') }}" class="btn btn-primary mt-3">
        Kembali ke Daftar Berita
    </a>

    {{-- Section Komentar --}}
    <div class="mt-5">
        <h4>Komentar ({{ $news->komentars->count() }})</h4>
        
        {{-- List Komentar --}}
        <div class="comments-section">
            @forelse($news->komentars as $komentar)
            <div class="comment mb-3 p-3 border rounded">
                <div class="comment-header d-flex justify-content-between">
                    <h5 class="mb-1">{{ $komentar->user->name }}</h5>
                    <small class="text-muted">
                        {{ $komentar->tanggal->format('d M Y') }}
                        
                        {{-- Tombol hapus komentar --}}
                        @if(Auth::id() == $komentar->user_id)
                        <form action="{{ route('komentar.delete', $komentar->id_komentar) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Hapus komentar?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                        @endif
                    </small>
                </div>
                <p class="mt-2">{{ $komentar->suggestion }}</p>
            </div>
            @empty
            <p class="text-muted">Belum ada komentar</p>
            @endforelse
        </div>

        {{-- Form Komentar --}}
        <div class="comment-form mt-4">
            <h4>Tambah Komentar</h4>
            @if(Auth::check())
            <form action="{{ route('komentar.store', $news->id_berita) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Komentar</label>
                    <textarea 
                        class="form-control" 
                        id="comment" 
                        name="suggestion" 
                        rows="3" 
                        placeholder="Tulis komentar Anda"
                        required
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
            @else
            <div class="alert alert-warning">
                Silakan <a href="{{ route('login') }}">login</a> untuk menambah komentar
            </div>
            @endif
        </div>
    </div>
@endsection
