<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users');
    }

    public function login(Request $request)
    {     
        Log::info("0");
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        Log::info("1");
        if ($validator->fails()) {
            return back();
        }
        Log::info("3");
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            Log::info("4");
            $user = auth()->user();
            $token = $user->createToken('MyApp')->accessToken;
            if($user->role=="Admin"){
                Log::info("5");
                return redirect()->route('admin');
            }

            return redirect()->route('users');
        }

        return back();
    }
    public function admin(){
        return view("adminwebpage");
    }
}
