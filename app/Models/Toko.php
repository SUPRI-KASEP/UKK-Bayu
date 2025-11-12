<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    protected $fillable = ['nama', 'alamat', 'user_id'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
