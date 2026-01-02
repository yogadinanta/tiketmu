<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BypassCsrfForMidtrans
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika route midtrans/callback, skip CSRF
        if ($request->is('midtrans/callback')) {
            // Skip CSRF, lanjut request
            return $next($request);
        }

        // Default lanjutkan request (CSRF tetap berlaku di route lain)
        return $next($request);
    }
}
