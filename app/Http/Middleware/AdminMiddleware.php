<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to access admin panel.');
        }

        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Unauthorized access. Only admins can access this area.');
        }

        // Check if user is active
        if (!Auth::user()->isActive()) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Your account is inactive. Please contact support.');
        }

        return $next($request);
    }
}
