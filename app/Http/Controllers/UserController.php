<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        Log::info($user);

        if (!$user) {
            return response()->json("User ID $id not found", 404);
        }

        Log::info("Validation started");
        log::info($user->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            
            'password' => 'required|string|min:8',
            'roll_no' => 'required|string|max:255', 
            'department' => 'required|string|max:255', 
        ]);


        if ($validator->fails()) {
            Log::info($validator->errors());
            return response()->json($validator->errors(), 422);
        }

        Log::info("Validation successful");


        $validatedData = $validator->validated();

        
        $user->update($validatedData);
        Log::info("Updated User ID: " . $user->id);
        
        return response()->json($user);
    }

    public function userDelete(Request $request,$id){
        log::info('successfully deleted');
        $user=User::find($id); 
        log::info($user);
        $user->delete();
        return response()->json("successfully deleted");
    }


}
