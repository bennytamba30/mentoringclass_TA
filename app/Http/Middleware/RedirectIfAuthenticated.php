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
            $role = Auth::user()->role;

            return match ($role) {
                'admin' => !$request->is('admin*') ? redirect('/admin') : $next($request),
                'mentor' => !$request->is('mentor*') ? redirect('/mentor') : $next($request),
                'mentee' => !$request->is('mentee*') ? redirect('/mentee') : $next($request),
                default => abort(403, 'Role tidak dikenali'),
            };
        }

        return $next($request);
    }
}


