<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('ulasans', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        // Menghubungkan ke tabel bukus
        $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
        
        // Skor rating (1 sampai 5)
        $table->integer('rating'); 
        
        // Isi komentar/ulasan
        $table->text('ulasan'); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
