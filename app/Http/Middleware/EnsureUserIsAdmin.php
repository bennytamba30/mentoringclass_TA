<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            $role = Auth::user()->role ?? null;

            return redirect()->to(match ($role) {
                'mentor' => '/mentor',
                'mentee' => '/mentee/dashboard',
                default => '/login',
            });
        }

        return $next($request);
    }
}
