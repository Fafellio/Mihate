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
    Schema::table('peminjamans', function (Blueprint $table) {
        $table->string('kondisi_buku')->nullable(); // Untuk menyimpan 'baik', 'rusak', atau 'hilang'
        $table->text('keterangan_petugas')->nullable(); // Untuk catatan tambahan
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            //
        });
    }
};
