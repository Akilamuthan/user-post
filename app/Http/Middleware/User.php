<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class User
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('User authentication check:', ['user' => auth()->user()]);
        return $next($request);
        if (auth()->check()) {
            Log::info('Authenticated user:', ['user' => auth()->user()]);
            
        }


        return response()->json(["message" => "Unauthorized user"], 401);
    }
}
