<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $berita = Berita::with('user')
            ->orderBy('tanggal', 'desc')
            ->paginate(6);

        $jumlah_pengguna = User::count();
        $jumlah_berita = Berita::count();
        
        return view('welcome', compact('berita','jumlah_pengguna', 'jumlah_berita'));
    }

    public function show($id)
    {
        // Ambil detail berita beserta komentar
        $news = Berita::with(['user', 'komentars' => function($query) {
            $query->with('user')->orderBy('tanggal', 'desc');
        }])->findOrFail($id);
        
        $jumlah_pengguna = User::count();
        $jumlah_berita = Berita::count();
        
        return view('detail_berita', compact('news','jumlah_pengguna', 'jumlah_berita'));
    }
}