<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'kategori';

    protected $fillable = [
        'nama',
    ];

    /**
     * Relationship dengan Produk
     */
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    /**
     * Relationship many-to-many dengan Toko
     */
    public function tokos()
    {
        return $this->belongsToMany(Toko::class, 'toko_kategori', 'kategori_id', 'toko_id');
    }
}
