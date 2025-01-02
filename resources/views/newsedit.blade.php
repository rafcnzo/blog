@extends('layout.template')

@section('title', 'Edit Berita')

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
    <form action="{{ route('news.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Berita</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
            @if ($berita->thumbnail)
                <div class="mt-2">
                    <img src="{{ asset($berita->thumbnail) }}" alt="Thumbnail" class="img-thumbnail" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Konten Berita</label>
            <textarea id="konten" name="konten" class="form-control" rows="10" required>{{ old('konten', $berita->konten) }}</textarea>
        </div>

        <div class="text-left">
            <button type="submit" class="btn btn-primary">Update Berita</button>
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection