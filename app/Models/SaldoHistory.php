<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoHistory extends Model
{
    use HasFactory;

    protected $table = 'saldo_histories'; // pastikan nama tabel sesuai di database

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'description',
        'created_at',
    ];

    // Relasi ke user (optional tapi disarankan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
