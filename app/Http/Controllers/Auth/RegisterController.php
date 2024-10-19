<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        Log::info("Registration process started");
    }

    protected function validator(array $data)
    {
        Log::info("Validating registration data:", $data);

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:8',
            'roll_no' => 'required|string|max:255', 
            'department' => 'required|string|max:255',
        ]);
    }

    protected function create(array $data)
    {
        Log::info("Creating user: {$data['email']}, Roll No: {$data['roll_no']}");
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roll_no' => $data['roll_no'],
            'department' => $data['department'],
        ]);
    }

    public function register(Request $request)
    {
        Log::info("Registration request received", $request->all());

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            Log::info("Validation failed", $validator->errors()->all());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $this->create($request->all());
        $user->assignRole('user');

        auth()->login($user);
        $token = $user->createToken('Ecommerce')->accessToken;
        Log::info("User successfully registered and logged in", ['token' => $token]);

        return response()->json(['user' => $user], 201);
    }
}
