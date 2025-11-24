<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('ypc2025'),
            'role' => 'admin',
        ]);


        // Seed kategori
        Kategori::create(['nama' => 'Elektronik']);
        Kategori::create(['nama' => 'Pakaian']);
        Kategori::create(['nama' => 'Makanan']);
    }
}
