<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah',
        'bank',
        'no_rekening',
        'status',
        'refunded',
    ];

    protected $casts = [
        'refunded' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
