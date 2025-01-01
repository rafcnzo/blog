<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KomentarController extends Controller
{
    public function store(Request $request, $beritaId)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambah komentar');
        }

        // Validasi input
        $validated = $request->validate([
            'suggestion' => 'required|max:500'
        ]);

        // Simpan komentar
        Komentar::create([
            'id_berita' => $beritaId,
            'user_id' => Auth::id(),
            'tanggal' => Carbon::now(), // Gunakan Carbon untuk tanggal
            'suggestion' => $validated['suggestion']
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan');
    }

    public function delete($komentarId)
    {
        // Cari komentar
        $komentar = Komentar::findOrFail($komentarId);

        // Cek otorisasi - hanya pemilik komentar yang bisa menghapus
        if (Auth::id() !== $komentar->user_id) {
            return back()->with('error', 'Anda tidak memiliki izin menghapus komentar ini');
        }

        // Hapus komentar
        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus');
    }

    // ... method lainnya tetap sama
}