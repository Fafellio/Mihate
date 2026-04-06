<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   // Di dalam DashboardController.php

public function index()
{
    $user = Auth::user();
    $userData = session('user_data');

    $bukus = Buku::latest()->take(12)->get();
    $pinjaman_saya = Peminjaman::where('user_id', $user->id)->with('buku')->latest()->get();

    $stats = [];
    $grafik = ['labels' => [], 'data' => []];
    $antrean_terbaru = collect();

    if (in_array($user->role_id, [1, 3])) {
  if (in_array($user->role_id, [1, 3])) {
    $stats = [
        'total_buku'   => Buku::count(),
        'total_user'   => User::where('role_id', 2)->count(),
        
        // Menghitung berapa ORANG (User) yang sedang memegang buku (Status Aktif)
        'total_peminjam' => Peminjaman::whereIn('status', ['pinjam', 'terlambat', 'permintaan_kembali'])
                            ->distinct('user_id')
                            ->count('user_id'), 
        
        // Menghitung berapa banyak permohonan yang butuh ACC (Box Oranye)
        'antrean'      => Peminjaman::where('status', 'pending')->count(),
    ];
    
    // ... sisa kode grafik
}
        
        // LOGIKA GRAFIK: Ambil data 7 hari terakhir
        // Kita hitung semua baris yang dibuat (created_at) di tabel peminjaman
        $dataPinjaman = Peminjaman::select(
                DB::raw('DATE(created_at) as tanggal'), 
                DB::raw('count(*) as jumlah')
            )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        for ($i = 6; $i >= 0; $i--) {
            $tgl = now()->subDays($i)->format('Y-m-d');
            // Pakai format hari Indonesia
            $labels[] = now()->subDays($i)->translatedFormat('D');
            $dataset[] = $dataPinjaman[$tgl] ?? 0;
        }

        $grafik = ['labels' => $labels, 'data' => $dataset];

        $antrean_terbaru = Peminjaman::with(['user', 'buku'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();
    }

    return view('dashboard.index', compact('userData', 'stats', 'bukus', 'pinjaman_saya', 'antrean_terbaru', 'grafik'));
}

}