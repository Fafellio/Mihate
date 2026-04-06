<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanBukuController extends Controller
{
    public function index()
    {
        // Kita ambil data yang sudah diproses petugas (kembali/rusak/hilang)
        $laporans = Peminjaman::with(['buku', 'user'])
            ->whereIn('status', ['kembali', 'terlambat']) // Mengambil data yang sudah selesai/bermasalah
            ->whereNotNull('kondisi_buku')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Statistik untuk Dashboard Laporan
        $stats = [
            'baik'   => $laporans->where('kondisi_buku', 'baik')->count(),
            'rusak'  => $laporans->where('kondisi_buku', 'rusak')->count(),
            'hilang' => $laporans->where('kondisi_buku', 'hilang')->count(),
        ];

        return view('laporan.index', compact('laporans', 'stats'));
    }
}