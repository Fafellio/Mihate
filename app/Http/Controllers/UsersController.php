<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan import Model User
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data user dari database
        // Gunakan paginate agar jika user banyak, halaman tidak terlalu panjang
        $users = User::latest()->paginate(10);

        // 2. Kirim data ke view 'users.index'
        return view('users.index', compact('users'));
    }


    /**
     * Memproses pembaruan Nama dan Role User
     */
    public function update(Request $request, User $user)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|in:1,2,3', // Sesuai database: 1=Admin, 2=User, 3=Pegawai
        ]);

        // 2. Update data ke database
        $user->update([
            'name' => $request->name,
            'role_id' => $request->role_id,
        ]);

        // 3. Kembali dengan pesan sukses
        return back()->with('success', 'Data user ' . $user->name . ' berhasil diperbarui.');
    }

    /**
     * Tambahkan fungsi hapus agar manajemen user berfungsi
     */
    public function destroy(User $user)
    {
        // Jangan biarkan user menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
