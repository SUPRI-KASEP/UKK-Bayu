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

            $table->foreignId('toko_id')
                  ->constrained('toko') 
                  ->onDelete('cascade');

            $table->foreignId('kategori_id')
                  ->constrained('kategori') 
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
