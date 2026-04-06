<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LaporanBukuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);Route::put('/peminjaman/kembalikan/{id}', [PeminjamanController::class, 'ajukanKembali'])->name('peminjaman.ajukanKembali');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('pageDashboard');

    // Users
    Route::get('/users', [UsersController::class, 'index'])
        ->name('pageUsers');

    Route::get('/peminjaman/{peminjaman}/cetak', [PeminjamanController::class, 'cetakStruk'])->name('peminjaman.cetak');

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */
    Route::resource('kategori', CategoryController::class)
        ->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | Buku
    |--------------------------------------------------------------------------
    */
    // 1. Rute Khusus Admin (Wajib di atas resource atau didefinisikan manual)
    Route::get('/buku/list', [BukuController::class, 'list'])->name('buku.list');

    // 2. Rute Resource (index, create, store, show, edit, update, destroy)
    Route::resource('buku', BukuController::class);

    // 3. Pinjam buku
    Route::post('/buku/{buku}/pinjam', [PeminjamanController::class, 'pinjam'])->name('buku.pinjam');
    /*
   /*
|--------------------------------------------------------------------------
| Peminjaman Routes
|--------------------------------------------------------------------------
*/
Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
    // Halaman Daftar Peminjaman User
    Route::get('/', [PeminjamanController::class, 'index'])->name('index');

    // Fitur Cancel (User membatalkan booking/pending)
    Route::post('/{peminjaman}/cancel', [PeminjamanController::class, 'cancel'])->name('cancel');

    // Fitur Minta Kembali (User klik tombol "Refun / Kembali")
    Route::post('/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('kembalikan');

    // Halaman Manajemen Petugas (Antrean Peminjaman & Pengembalian)
    Route::get('/petugas', [PeminjamanController::class, 'petugasIndex'])->name('petugas');

    // Fitur Pegawai: Konfirmasi Buku diserahkan ke User (Ambil)
    Route::post('/{peminjaman}/ambil', [PeminjamanController::class, 'konfirmasiAmbil'])->name('konfirmasiAmbil');

    // FIX ERROR: Fitur Pegawai: Konfirmasi Buku sudah kembali (Terima fisik buku & tambah stok)
    Route::post('/{peminjaman}/konfirmasi-kembali', [PeminjamanController::class, 'konfirmasiKembali'])->name('konfirmasiKembali');

    // Fitur Cetak Struk
    Route::get('/{peminjaman}/cetak', [PeminjamanController::class, 'cetakStruk'])->name('cetak');
    
    // Fitur Kembali (Opsional, jika masih pakai method lama)
    Route::post('/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])->name('kembali');
});


    /*
    |--------------------------------------------------------------------------
    | UlasanRoutes
    |--------------------------------------------------------------------------
    */
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store')->middleware('auth');
    Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

    /*
    |--------------------------------------------------------------------------
    | Laporan Buku Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/laporan-buku', [LaporanBukuController::class, 'index'])->name('laporan.index');

    Route::middleware(['auth'])->group(function () {
        Route::resource('users', UsersController::class);
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
        Route::post('/booking/{buku}', [BookingController::class, 'store'])->name('booking.store');
        Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    });
    /*
    |--------------------------------------------------------------------------
    | Pengembalian Routes
    |--------------------------------------------------------------------------
    */
    // Hapus 'checkRole:1,3' karena menyebabkan error, cukup pakai 'auth'
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian/{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');

});
