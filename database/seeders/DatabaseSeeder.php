<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Produk;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed Toko
        Toko::create([
            'nama' => 'Toko ABC',
            'alamat' => 'Jl. Contoh No. 123',
            'user_id' => 1,
        ]);

        Toko::create([
            'nama' => 'Toko XYZ',
            'alamat' => 'Jl. Lain No. 456',
            'user_id' => 1,
        ]);

        // Seed Kategori
        Kategori::create(['nama' => 'Elektronik']);
        Kategori::create(['nama' => 'Pakaian']);
        Kategori::create(['nama' => 'Makanan']);

        // Seed Produk
        Produk::create([
            'nama' => 'Laptop',
            'harga' => 5000000,
            'deskripsi' => 'Laptop gaming',
            'kategori_id' => 1,
            'toko_id' => 1,
        ]);

        Produk::create([
            'nama' => 'Kaos',
            'harga' => 50000,
            'deskripsi' => 'Kaos katun',
            'kategori_id' => 2,
            'toko_id' => 2,
        ]);
    }
}
