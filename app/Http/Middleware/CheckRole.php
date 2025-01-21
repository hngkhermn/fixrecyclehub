<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the correct role
        if (Auth::check()) {
            $user = Auth::user();
            if ($role == 'admin' && $user->role != 'admin') {
                // If not admin, deny access
                return redirect()->route('home')->with('error', 'You do not have admin access.');
            }

            if ($role == 'user' && $user->role != 'user') {
                // If not user, deny access
                return redirect()->route('home')->with('error', 'You do not have user access.');
            }
        } else {
            // If not authenticated, redirect to login page
            return redirect()->route('login');
        }

        return $next($request);
    }
}
