<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoHistory extends Model
{
    use HasFactory;

    protected $table = 'saldo_histories';

    protected $fillable = [
        'user_id',
        'amount',
        'type',          // tambah | kurang
        'source',        // deposit | event | admin
        'reference_id',  // id deposit / event
        'description',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke deposit (jika source = deposit)
     */
    public function deposit()
    {
        return $this->belongsTo(Deposit::class, 'reference_id');
    }
}
