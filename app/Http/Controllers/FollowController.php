<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\Follower;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(Request $request, $id)
    {
        $user = auth()->user();
        Log::info($user);
    
        if ($user->id == $id) {
            return response()->json(['error' => 'You cannot follow yourself'], 400);
        }
    

        $existingFollow = Follower::where('followers', $id)
            ->where('user_id', $user->id)
            ->first();
    
        if ($existingFollow) {
            Log::info($existingFollow);
            Log::info("User has already followed this user");
            return response()->json(['message' => 'You have already followed this user'], 409);
        }
    
        $follow = Follower::create([
            'followers' => $id,
            'user_id' => $user->id,
        ]);
        
        Log::info($follow);
    
        return response()->json(['message' => 'Successfully followed user'], 200);
    }
    

    public function unfollow(Request $request,$id){

        $user=auth()->user();

        log::info($user);

        if($user->id==$id){
           return response()->json("You cannot unfollow yourself");
           
        }
         

       $follower = Follower::where('user_id', auth()->id())
           ->where('followers', $id)->first();

       if ($follower) {
           $follower->delete();
           return response()->json(['message' => 'Unfollowed successfully.']);
        }

        return response()->json(['message' => 'Not following this user.'], 404);
    }



    public function followersCount(Request $request){
        $user=auth()->user();
        
        log::info("start");
        log::info($user);

        $followers = Follower::where('user_id', $user->id)->get();

        return response()->json([
            "followwers"=>$followers
        ]);
    }

    public function followingCount(Request $request){
        $user=auth()->user();
        
        
        log::info("start");

        log::info($user);

        $following = Follower::where('followers',$user->id)->get();


        return response()->json([
            "following"=>$following
        ]);
    }
}
