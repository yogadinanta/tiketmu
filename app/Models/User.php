<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{


    use HasFactory, Notifiable;

    /**
     * Atribut yang bisa diisi mass assignment.
     *
     * @var array<int, string>
     */
    
protected $fillable = [
    'saldo',
    'name', 
    'email',
     'password', 
     'role', 
     'is_active',
];

public function penarikans()
{
    return $this->hasMany(Penarikan::class);
}



    

    /**
     * Atribut yang disembunyikan saat serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang perlu dikonversi otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // aktifkan jika mau hashing otomatis
    ];

    /**
     * Relasi ke tabel saldo vendor.
     */
    public function vendorBalance()
    {
        return $this->hasOne(VendorBalance::class, 'user_id');
    }
    public function balance()
{
    return $this->hasOne(Balance::class, 'user_id');
}

}
