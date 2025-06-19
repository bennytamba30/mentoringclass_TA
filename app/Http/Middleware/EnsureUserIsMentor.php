<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsMentor
{
    /**
     * Handle an incoming request.
     */
     public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'mentor') {
            return redirect()->to(match (auth()->user()->role ?? '') {
                'admin' => '/admin',
                'mentee' => '/mentee',
                default => '/',
            });
        }

        return $next($request);
    }
}
