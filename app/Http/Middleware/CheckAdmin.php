<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('CheckAdmin middleware triggered.');

        $user = auth()->user();
        log::info($user->id);
        Log::info("User found: " . ($user ? $user->toJson() : 'null'));

        $userRole = $user->getRoleNames();

        if (Auth::check()) {
              Log::info("Accessed by authenticated user ID: " . Auth::user()->id);
            if ($user->hasRole('Admin')) {
                Log::info("Access granted to admin user: " . $user->role);
                return $next($request);
            }

        }

        

        return $next($request);
    }
}
