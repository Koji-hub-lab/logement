<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BailleurMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->estBailleur()) {
            abort(403, 'Accès réservé aux bailleurs');
        }

        return $next($request);
    }
}