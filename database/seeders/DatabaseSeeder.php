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
            'password' => bcrypt('ypc2025'),
            'role' => 'admin',
        ]);

        // Create member user
        $member = User::create([
            'name' => 'Test Member',
            'username' => 'member',
            'password' => bcrypt('member123'),
            'role' => 'member',
        ]);

        $member = User::create([
            'name' => 'Test Member',
            'username' => 'bayu',
            'password' => bcrypt('member123'),
            'role' => 'member',
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
