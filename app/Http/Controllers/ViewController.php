<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\View;

class ViewController extends Controller
{
    public function createView(Request $request, $id) {

        $user = auth()->user();
        Log::info($user);
    
       

        $request->merge([
            "user_id" => $user->id,
            "post_id" => $id
        ]);
        
        Log::info($request->all());

        $validator = Validator::make($request->all(), [
            "user_id" => "required|numeric|exists:users,id",
            "post_id" => "required|numeric|exists:posts,id"
        ]);

        $alreadyView=View::where("user_id",$user->id)->where("post_id",$id)->exists();

        if($alreadyView){

            log::info("This post has already been viewed");
            return  response()->json("This post has already been viewed");
        }

        if ($validator->fails()) {
            Log::info($validator->errors());
            return response()->json(["error" => $validator->errors()], 422);
        }
    
        $view = View::create([
            "user_id" => $user->id,
            "post_id" => $id,
            "value" => true
        ]);
    
        Log::info($view);
        return response()->json($view, 201);
    }
    

    public function viewsCount(Request $request,$id){

        $views=View::where('post_id',$id)->where('value',1)->count();

        log::info($views);

        return response()->json([
            "views"=>$views]);
    }
}
