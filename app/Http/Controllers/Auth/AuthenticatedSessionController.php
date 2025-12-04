<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // SUPER ADMIN LOGIN
        $superAdmin = SuperAdmin::where('email', $request->email)->first();
        if ($superAdmin && Hash::check($request->password, $superAdmin->password)) {
            Auth::guard('super_admin')->login($superAdmin);
            $request->session()->regenerate();
            return redirect()->route('superAdmin.index');
        }

        // ADMIN LOGIN
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    /**
     * Destroy an authenticated session.
     */

    public function destroy(Request $request): RedirectResponse
    {
        // Logout all guards
        if (Auth::guard('super_admin')->check()) {
            Auth::guard('super_admin')->logout();
        }

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        // Invalidate and flush session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear remember-me cookies if any
        Cookie::queue(Cookie::forget('remember_web'));
        Cookie::queue(Cookie::forget('remember_admin'));
        Cookie::queue(Cookie::forget('remember_super_admin'));

        // Redirect back to login
        return redirect()->route('admin.create')->with('status', 'You have been logged out.');

    }
}
