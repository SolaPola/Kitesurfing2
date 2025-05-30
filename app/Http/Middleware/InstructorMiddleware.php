<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // First check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page');
        }

        // Check if user has instructor role (role_id = 2 typically for instructor)
        if (Auth::user()->role_id != 2) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access the instructor area');
        }

        return $next($request);
    }
}
