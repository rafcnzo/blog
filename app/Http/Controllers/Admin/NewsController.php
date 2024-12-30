<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
{
    $berita = Berita::select('berita.*', 'users.name')
        ->leftJoin('users', 'berita.user_id', '=', 'users.user_id')
        ->orderBy('berita.id_berita', 'asc')
        ->paginate(10);
    
    return view('Admin.newsread', compact('berita'));
}

    public function create()
    {
        return view('Admin.newscreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = Str::slug($validated['judul']) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('public/thumbnails', $filename);
            $thumbnailPath = str_replace('public/', 'storage/', $thumbnailPath);
        }

        Berita::create([
            'tanggal' => now(),
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'thumbnail' => $thumbnailPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('Admin.newsedit', compact('berita'));
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
                Storage::delete(str_replace('storage/', 'public/', $berita->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = Str::slug($validated['judul']) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('public/thumbnails', $filename);
            $thumbnailPath = str_replace('public/', 'storage/', $thumbnailPath);

            $berita->thumbnail = $thumbnailPath;
        }

        $berita->judul = $validated['judul'];
        $berita->konten = $validated['konten'];
        $berita->save();

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function delete($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($berita->thumbnail) {
            Storage::delete(str_replace('storage/', 'public/', $berita->thumbnail));
        }

        $berita->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus');
    }
}