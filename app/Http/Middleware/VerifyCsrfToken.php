<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs yang dikecualikan dari CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'midtrans/callback', // tambahkan ini
    ];
}
