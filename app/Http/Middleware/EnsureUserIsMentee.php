<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsMentee
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'mentee') {
            $role = Auth::user()->role ?? null;

            return redirect()->to(match ($role) {
                'admin' => '/admin',
                'mentor' => '/mentor',
                default => '/login',
            });
        }

        return $next($request);
    }
}
