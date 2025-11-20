<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Relationship dengan Toko
     * User bisa memiliki satu toko (jika role user/member)
     */
    public function toko()
    {
        return $this->hasOne(Toko::class, 'user_id');
    }

    /**
     * Cek jika user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek jika user adalah member
     */
    public function isMember()
    {
        return $this->role === 'member';
    }
}
