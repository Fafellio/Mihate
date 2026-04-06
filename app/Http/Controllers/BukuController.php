<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Category; 
use App\Models\Peminjaman;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // HALAMAN INDEX BUKU (landing)
    public function index()
    {
        $bukus = Buku::latest()->get();
        return view('buku.index', compact('bukus'));
    }

   public function show($id)
{
    // Gunakan with('category') agar data kategorinya ikut ke ambil
    $buku = Buku::with('category', 'ulasans.user')->findOrFail($id);
    
    return view('buku.show', compact('buku'));
}

    // HALAMAN LIST BUKU (CRUD)
   public function list()
{
    $bukus = Buku::latest()->get();
    $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
    return view('buku.list', compact('bukus', 'peminjamans'));
}

    // FORM TAMBAH BUKU
   public function create()
{
    // Mengambil semua data kategori dari database
    $categories = \App\Models\Category::all(); 
    
    return view('buku.create', compact('categories'));
}

    // SIMPAN DATA
   public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'judul'       => 'required',
        'penulis'     => 'required',
        'category_id' => 'required|exists:categories,id',
        'stok'        => 'required|integer|min:0',
        'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // 2. Ambil data (kecuali cover karena akan diproses manual)
    $data = $request->only(['judul', 'penulis', 'category_id', 'stok', 'deskripsi']);

    // 3. Proses upload cover jika ada
    if ($request->hasFile('cover')) {
        $data['cover'] = $request->file('cover')->store('cover_buku', 'public');
    }

    // 4. Simpan ke database
    \App\Models\Buku::create($data);

    return redirect()->route('buku.list')->with('success', 'Buku berhasil ditambahkan');
}

   public function edit($id)
{
    $buku = Buku::findOrFail($id);
    $categories = \App\Models\Category::all(); // Tambahkan ini
    return view('buku.edit', compact('buku', 'categories'));
}

public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);

    // 1. Tambahkan validasi video (3MB sesuai permintaan sebelumnya)
    $request->validate([
        'judul'       => 'required',
        'penulis'     => 'required',
        'category_id' => 'required|exists:categories,id',
        'stok'        => 'required|integer|min:0',
        'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        'video'       => 'nullable|mimes:mp4,mov,ogg,qt|max:3072' 
    ]);

    $data = $request->all();

    // 2. Logika update cover + Hapus file lama
    if ($request->hasFile('cover')) {
        // Hapus file lama dari storage agar tidak penuh
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }
        $data['cover'] = $request->file('cover')->store('cover_buku', 'public');
    }

    // 3. Logika update video + Hapus file lama
    if ($request->hasFile('video')) {
        // Hapus video lama dari storage jika user upload video baru
        if ($buku->video) {
            Storage::disk('public')->delete($buku->video);
        }
        $data['video'] = $request->file('video')->store('video_promosi', 'public');
    }

    $buku->update($data);

    return redirect()->route('buku.list')
        ->with('success', 'Buku dan video berhasil diupdate');
}
   public function destroy($id)
{
    $buku = Buku::findOrFail($id);

    // Hapus Cover
    if ($buku->cover) {
        Storage::disk('public')->delete($buku->cover);
    }

    // Hapus Video
    if ($buku->video) {
        Storage::disk('public')->delete($buku->video);
    }

    $buku->delete();

    return redirect()->back()->with('success', 'Buku dan file terkait berhasil dihapus');
}
}
