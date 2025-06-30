<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (Auth::check()) {
    $user = Auth::user();
    return match ($user->role) {
        'admin' => redirect('/admin'),
        'mentor' => redirect('/mentor'),
        'mentee' => redirect()->route('mentee.dashboard'),
        default => redirect('/'),
    };
}

        return $next($request);
    }
}


