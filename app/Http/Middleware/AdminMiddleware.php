<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Determine if the user has an admin role; if not, check if they have a user role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Not logged in, redirect to login page
            return redirect('login')->with('error', 'You must be logged in to access this page.');
        }

        if (Auth::user()->role === 'admin') {
            // User is an admin, proceed with the request
            return $next($request);
        }

        if (Auth::user()->role === 'user') {
            // User is a regular user, redirect to a specific user page or dashboard
            return redirect('dashboard')->with('success', 'Accessing user dashboard.');
        }

        // If the user doesn't have a recognized role, redirect to a default page or show an error
        return redirect('home')->with('error', "You don't have access to this section.");
    }
}
