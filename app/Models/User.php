<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi user memiliki satu toko.
     */
    public function toko()
    {
        return $this->hasOne(Toko::class, 'user_id');
    }

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah member.
     */
    public function isMember()
    {
        return $this->role === 'member';
    }
}
