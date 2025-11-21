<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda
    protected $table = 'toko';

    protected $fillable = [
        'nama',
        'alamat',
        'user_id',
        'gambar',
    ];

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship dengan Produk
     */
    public function produks()
    {
        return $this->hasMany(Produk::class, 'toko_id');
    }

    /**
     * Relationship many-to-many dengan Kategori
     */
    public function kategoris()
    {
        return $this->belongsToMany(
            Kategori::class,
            'toko_kategori',
            'toko_id',
            'kategori_id'
        );
    }
}
