<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function create()
    {
        $jumlah_pengguna = User::count();
        $jumlah_berita = Berita::count();
        
        return view('newscreate', compact('jumlah_pengguna', 'jumlah_berita'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048|required'
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = Str::slug($validated['judul']) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Simpan di storage/app/public/thumbnails
            $thumbnailPath = $file->storeAs('public/thumbnails', $filename);
        }

        Berita::create([
            'tanggal' => now(),
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'thumbnail' => $thumbnailPath ? str_replace('public/', '', $thumbnailPath) : null,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('welcome')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
    $berita = Berita::findOrFail($id);
    $jumlah_pengguna = User::count();
    $jumlah_berita = Berita::count();
        
    return view('newsedit', compact('berita','jumlah_pengguna', 'jumlah_berita'));
    }


    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($berita->thumbnail) {
                Storage::delete('public/' . $berita->thumbnail);
            }

            $file = $request->file('thumbnail');
            $filename = Str::slug($validated['judul']) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('public/thumbnails', $filename);

            $berita->thumbnail = str_replace('public/', '', $thumbnailPath);
        }

        $berita->judul = $validated['judul'];
        $berita->konten = $validated['konten'];
        $berita->save();

        return redirect()->route('welcome')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
    
        return redirect()->route('welcome')->with('success', 'Berita berhasil dihapus.');
    }
    
}