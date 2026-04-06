<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'buku_id', 'batas_ambil', 'status'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Buku (Penting untuk tampilan judul buku)
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
