<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\User;

class BeritaPopulerController extends Controller
{
    public function index()
    {
        // Misalnya, urutkan berdasarkan jumlah komentar atau view
        $berita = Berita::with('user')
            ->withCount('komentars') // Asumsikan relasi komentars sudah dibuat
            ->orderBy('komentars_count', 'desc')
            ->paginate(6);
        $jumlah_pengguna = User::count();
        $jumlah_berita = Berita::count();
            
        return view('populer', compact('berita','jumlah_pengguna', 'jumlah_berita'));
    }
}