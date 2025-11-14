<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Toko;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Create member user
        $member = User::create([
            'name' => 'Test Member',
            'username' => 'member',
            'email' => 'member@example.com',
            'password' => bcrypt('member123'),
            'role' => 'user',
        ]);

        // Create toko for member
        Toko::create([
            'nama' => 'Toko ABC',
            'alamat' => 'Jl. Contoh No. 123',
            'user_id' => $member->id,
        ]);

        // Seed Kategori
        Kategori::create(['nama' => 'Elektronik']);
        Kategori::create(['nama' => 'Pakaian']);
        Kategori::create(['nama' => 'Makanan']);
    }
}
