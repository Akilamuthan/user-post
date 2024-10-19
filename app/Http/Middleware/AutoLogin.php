<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Ensure the User model is imported
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AutoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is not already authenticated
        if (Auth::check()) {
            // Check for the remember_me cookie
            if ($request->hasCookie('remember_me')) {
                // Retrieve the user based on the token stored in the cookie
                $user = User::where('remember_token', $request->cookie('remember_me'))->first();

                if ($user) {
                    // Automatically log in the user
                    Auth::login($user);
                    Log::info("User auto-logged in: " . $user->email);
                }
            }
        }
        log::info('ok');
        return $next($request);
    }
}
