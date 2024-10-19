<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
      

       log::info("start");
       log::info(auth()->user());
        $user = auth()->user();
        log::info($user->id);
        Log::info("User found: " . ($user ? $user->toJson() : 'null'));

        $userRole = $user->getRoleNames();

       log::info($userRole);
       log::info($user);
        if (Auth::check()) {
            Log::info("Accessed by authenticated user ID: " . Auth::user()->id);

            if ($user->hasRole('Admin')) {
                Log::info("Access granted to admin user: " . $user->role);
              
                return $next($request);
            }

            Log::info("Access denied for user: " . Auth::user()->id);
            return response()->json("Access denied");
        }

        Log::info("User not authenticated, redirecting.");
        return response()->json("only allowed admin");
    }
}
