<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOrder extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'order_id',
        'quantity',
        'total_price',
        'status',
        'payload',
        'scanned_at', // ✅ TAMBAHKAN INI
    ];

    protected $casts = [
        'payload'    => 'array',
        'scanned_at' => 'datetime', // ✅ CAST
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
