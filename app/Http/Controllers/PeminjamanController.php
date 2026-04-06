<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Halaman daftar pinjaman milik User (Member)
     */
    public function index()
    {
        $peminjamans = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'pinjam', 'terlambat','permintaan_kembali'])
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Halaman Manajemen Antrean untuk Petugas
     */
    public function petugasIndex(Request $request)
{
    // 1. Cek Otomatis Terlambat
    Peminjaman::where('status', 'pinjam')
        ->where('tgl_kembali', '<', now())
        ->update(['status' => 'terlambat']);

    // 2. Query Data Antrean
    $query = Peminjaman::with(['buku', 'user']);

    if ($request->search) {
        $query->where('nomor_antrian', 'like', '%' . $request->search . '%');
    }

    // Filter: Tambahkan 'permintaan_kembali' supaya tidak hilang dari list petugas
    if ($request->filter == 'arsip') {
        $query->whereIn('status', ['kembali', 'ditolak', 'cancel']);
    } else {
        // DI SINI TAMBAHANNYA BANG!
        $query->whereIn('status', ['pending', 'pinjam', 'terlambat', 'permintaan_kembali']);
    }

    $peminjamans = $query->orderBy('created_at', 'desc')->get();
    $bukus = Buku::all();

    return view('peminjaman.petugas', compact('peminjamans', 'bukus'));
}

    /**
     * Proses Klik Pinjam oleh User (Status awal: Pending)
     */
    public function pinjam(Request $request, Buku $buku)
    {
        $request->validate(['durasi' => 'required|integer|min:1|max:7']);

        if ($buku->stok <= 0) return back()->with('error', 'Stok buku habis');

        $sudahPinjam = Peminjaman::where('user_id', auth()->id())
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['pending', 'pinjam', 'terlambat'])
            ->exists();

        if ($sudahPinjam) return back()->with('error', 'Kamu sudah memiliki pesanan aktif untuk buku ini');

        DB::transaction(function () use ($buku, $request) {
            $lastEntry = Peminjaman::whereNotNull('nomor_antrian')->orderBy('nomor_antrian', 'desc')->first();
            $newNumber = ($lastEntry) ? $lastEntry->nomor_antrian + 1 : 1;

            $buku->decrement('stok'); 

            Peminjaman::create([
                'user_id'       => auth()->id(),
                'buku_id'       => $buku->id,
                'tgl_pinjam'    => now(),
                'tgl_kembali'   => now()->addDays((int) $request->durasi),
                'status'        => 'pending', 
                'nomor_antrian' => $newNumber
            ]);
        });

        return back()->with('success', 'Berhasil memesan. Silakan tunggu konfirmasi petugas.');
    }

    /**
     * Petugas menyetujui (Pending -> Pinjam)
     */
    public function konfirmasiAmbil(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'pinjam']);
        return back()->with('success', 'Buku telah diserahkan. Status: DIPINJAM');
    }

    /**
     * Petugas menerima pengembalian (Input Kondisi)
     */
  public function konfirmasiKembali(Request $request, Peminjaman $peminjaman)
{
    // 1. Validasi input
    $request->validate([
        'kondisi_buku' => 'required|in:baik,rusak,hilang',
        'keterangan'   => 'nullable|string'
    ]);

    // 2. Cek apakah statusnya valid untuk dikembalikan
    // Kita izinkan status 'pinjam', 'terlambat', dan 'permintaan_kembali'
    $statusValid = ['pinjam', 'terlambat', 'permintaan_kembali'];
    if (!in_array($peminjaman->status, $statusValid)) {
        return back()->with('error', 'Status peminjaman ini tidak valid untuk dikembalikan.');
    }

    try {
        DB::transaction(function () use ($peminjaman, $request) {
            // 3. Update data peminjaman
            $peminjaman->update([
                'status'             => 'kembali',
                'kondisi_buku'       => $request->kondisi_buku,
                'keterangan_petugas' => $request->keterangan,
                // Pastikan kolom ini ada di migrasi/database Abang
                'tgl_kembali'        => now(), 
            ]);

            // 4. Logika Stok: Hanya bertambah jika buku tidak hilang
            if ($request->kondisi_buku !== 'hilang') {
                $peminjaman->buku->increment('stok');
            }
        });

        return back()->with('success', 'Berhasil! Buku diterima dengan kondisi: ' . strtoupper($request->kondisi_buku));

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
    }
}

    /**
     * Petugas menolak permohonan (Pending -> Ditolak)
     */
    public function cancel(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            $peminjaman->update(['status' => 'ditolak']);
            $peminjaman->buku->increment('stok');
        });

        return back()->with('success', 'Permohonan berhasil ditolak.');
    }

    public function kembalikan($id)
{
    $peminjaman = \App\Models\Peminjaman::findOrFail($id);

    // Ubah ke status baru
    $peminjaman->update([
        'status' => 'permintaan_kembali'
    ]);

    return redirect()->back()->with('success', 'Permintaan pengembalian terkirim. Tunggu konfirmasi petugas.');
}

   /**
 * Cetak Struk PDF
 */
public function cetakStruk($id)
{
    // 1. Ambil data peminjaman beserta relasi user dan buku
    $peminjaman = Peminjaman::with(['user', 'buku'])->findOrFail($id);

    // 2. Siapkan data untuk dikirim ke view
    // Pastikan semua variabel yang dipanggil di Blade (seperti nama_web) ada di sini
    $data = [
        'nama_web' => 'E-Perpustakaan Digital', // Variabel yang tadi error
        'antrian'  => $peminjaman->nomor_antrian ?? '-',
        'nama'     => $peminjaman->user->name,
        'email'    => $peminjaman->user->email,
        'judul'    => $peminjaman->buku->judul,
        // Gunakan parse() agar bisa diformat tanggalnya di Blade jika perlu
        'pinjam'   => \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d/m/Y'),
        'kembali'  => \Carbon\Carbon::parse($peminjaman->tgl_kembali)->format('d/m/Y'),
    ];

    // 3. Load view dengan data yang sudah lengkap
    $pdf = Pdf::loadView('peminjaman.struk', $data);

    // 4. Stream atau download PDF
    return $pdf->stream('struk-peminjaman-' . $peminjaman->nomor_antrian . '.pdf');
}
}