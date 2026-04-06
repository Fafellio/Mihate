<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'buku_id' => 'required|exists:bukus,id',
        'rating'  => 'required|integer|min:1|max:5',
        'ulasan'  => 'required|string|min:5',
    ]);

    // Logika: Cari ulasan user ini di buku ini, kalau ada UPDATE, kalau ga ada CREATE
    \App\Models\Ulasan::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
        ],
        [
            'rating'  => $request->rating,
            'ulasan'  => $request->ulasan,
        ]
    );

    return back()->with('success', 'Ulasan Anda telah disimpan/diperbarui!');
}

// Tambahkan fungsi hapus
public function destroy($id)
{
    $ulasan = \App\Models\Ulasan::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $ulasan->delete();

    return back()->with('success', 'Ulasan berhasil dihapus.');
}
}
