<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and has the correct role
        $user = auth()->guard('super_admin')->user();

        if (!$user || $user->role !== 'super-admin') {
            if ($user && $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('superAdmin.index');
        }

        return $next($request);
    }
}
