<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user's role_id is 3 (admin)
            if (Auth::user()->role_id == 3) {
                // User has admin role, allow access
                return $next($request);
            }
        }

        // If not authenticated or not an admin, redirect to login page
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}
