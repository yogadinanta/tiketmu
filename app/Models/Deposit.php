<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    // Nama tabel kustom
    protected $table = 'deposit';

    // Mass assignable
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'status',
        'payload',
    ];

    // Hubungan ke user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
