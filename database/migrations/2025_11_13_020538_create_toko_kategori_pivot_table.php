<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('toko_kategori', function (Blueprint $table) {
            $table->id();

            // Sesuaikan dengan nama tabel yang sebenarnya
            $table->foreignId('toko_id')
                  ->constrained('toko') // nama tabel: 'toko' bukan 'tokos'
                  ->onDelete('cascade');

            $table->foreignId('kategori_id')
                  ->constrained('kategori') // nama tabel: 'kategori' bukan 'kategoris'
                  ->onDelete('cascade');

            $table->timestamps();

            // Add unique constraint to prevent duplicate relationships
            $table->unique(['toko_id', 'kategori_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko_kategori');
    }
};
