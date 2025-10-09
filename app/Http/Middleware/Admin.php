<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        if (Auth::guard('super_admin')->check()) {
            return $next($request);
        }

        return redirect()->route('login')->withErrors([
            'email' => 'You are not authorized to access this page.',
        ]);
    }
}
