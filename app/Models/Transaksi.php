<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * Pakai tabel yang SUDAH ADA
     */
    protected $table = 'event_orders';

    /**
     * Kolom yang boleh diisi
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'order_id',
        'quantity',
        'total_price',
        'status',
        'payload',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'payload' => 'array',
    ];

    /**
     * ======================
     * RELATIONSHIP
     * ======================
     */

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ======================
     * HELPER
     * ======================
     */

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}
