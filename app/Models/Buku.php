<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman; // ⬅️ tambahin ini

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

   protected $fillable = [
    'judul', 
    'penulis', 
    'penerbit', 
    'category_id', 
    'sinopsis', 
    'tahun', 
    'stok', 
    'cover', 
    'video'  
];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public function ulasans()
{
    // Satu buku punya banyak ulasan
    return $this->hasMany(Ulasan::class, 'buku_id');
}

public function getRataRataRatingAttribute()
{
    $rataRata = $this->ulasans()->avg('rating');
    return $rataRata ? round($rataRata, 1) : 0;
}

// app/Models/Buku.php

// app/Models/Buku.php
public function category() 
{
    return $this->belongsTo(Category::class, 'category_id');
}
}
