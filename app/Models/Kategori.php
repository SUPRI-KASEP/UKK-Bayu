<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'kategori';

    protected $fillable = ['nama'];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    public function tokos()
    {
        return $this->belongsToMany(
            Toko::class,
            'toko_kategori',
            'kategori_id',
            'toko_id'
        );
    }
}