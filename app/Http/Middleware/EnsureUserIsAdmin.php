<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
      public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->to(match (auth()->user()->role ?? '') {
                'mentor' => '/mentor',
                'mentee' => '/mentee',
                default => '/',
            });
        }
        
        return $next($request);
    }
}
