<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar buku yang sudah dikembalikan.
     */
    public function index()
    {
        // Kita ambil data dari tabel peminjamans yang statusnya 'kembali'
        // Eager loading 'user' dan 'buku' untuk menghemat query (N+1 problem)
        $pengembalian = Peminjaman::with(['user', 'buku'])
            ->where('status', 'kembali') // Sesuaikan string ini jika di DB kamu pakai 'dikembalikan'
            ->orderBy('tgl_kembali', 'desc')
            ->get();

        // Mengirimkan data ke folder resources/views/admin/pengembalian/index.blade.php
        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     * Optional: Jika kamu butuh fungsi untuk memproses pengembalian dari halaman antrean
     */
    public function store(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'status' => 'kembali',
            'tgl_kembali' => now(), // Mengisi tgl_kembali dengan waktu sekarang
            'keterangan_petugas' => $request->keterangan ?? 'Buku dikembalikan dalam kondisi baik'
        ]);

        // Kembalikan stok buku
        if ($peminjaman->buku) {
            $peminjaman->buku->increment('stok');
        }

        return redirect()->back()->with('success', 'Status pengembalian berhasil diperbarui.');
    }
}