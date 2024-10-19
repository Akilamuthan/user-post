<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;



class LoginController extends Controller
{
    use AuthenticatesUsers;

   

    public function __construct()
    {
        Log::info("LoginController Initialized");
    }

    public function login(Request $request)
{
    Log::info("Login attempt started");

    // Validate the request
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        Log::info("Validation failed", $validator->errors()->toArray());
        return response()->json($validator->errors()->toArray(), 422); 
    }

    $login = $request->only('email', 'password');

    if (auth()->attempt($login)) {
        Log::info("User authenticated: " . $request->email);
        $user = auth()->user();

        // Log user information (avoid logging sensitive data)
        Log::info("Authenticated user details: ", $user->toArray());

        // Create token
        $tokenResult = $user->createToken('Ecommerce');
        $token = $tokenResult->accessToken;

        Log::info("User token created: " . $token);
        Log::info($tokenResult);
        $roles = $user->getRoleNames();
        return response()->json([
            $token,
            $user 
        ]);


    }

    Log::info("Authentication failed for email: " . $request->email);
    return response()->json(['Invalid credentials email password'], 401); 
}




    public function logout(Request $request)
    {
        Log::info("User logging out");
        auth()->logout();

        return redirect('/')->with('status', 'Logged out successfully.');
    }

    
}
