<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'tanggal', 
        'judul',
        'konten', 
        'thumbnail',
        'user_id'
    ];

    // Accessor untuk thumbnail
    public function getThumbnailUrlAttribute()
    {
        // Jika thumbnail kosong atau tidak ada, kembalikan default
        if (!$this->thumbnail) {
            return asset('images/default-thumbnail.jpg');
        }

        // Jika thumbnail adalah URL penuh, kembalikan langsung
        if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
            return $this->thumbnail;
        }

        // Jika thumbnail adalah path lokal
        $path = str_replace('public/', '', $this->thumbnail);
        
        // Pastikan file ada di storage
        return Storage::exists('public/' . $path) 
            ? asset('storage/' . $path)
            : asset('images/default-thumbnail.jpg');
    }

    // Tambahkan accessor ke $appends
    protected $appends = ['thumbnail_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_berita', 'id_berita');
    }
}