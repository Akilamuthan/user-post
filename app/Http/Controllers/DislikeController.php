<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use App\Models\Dislike;
use App\Models\Like;

class DislikeController extends Controller
{
    public function showAll(Request $request,$id){
          $post=Post::find($id);
          if(!$post){
            return response()->json("Post Id not found");
          }
          log::info($post);
          $dislike=$post->dislikes;
          log::info($dislike);
          return response()->json($post);
    }

    public function showDislike(Request $request,$id){
          $dislike=Like::find($id);
          if(!$dislike){
            log::info("dislikes id not found");
            return response()->json("dislikes id not found");
          }
          log::info($dislike);
          return response()->json($dislike);
    }

    public function createDislike(Request $request,$id){
        $user=auth()->user();   
        log::info($user);
        $post=Post::find($id);
        if(!$post){
            log::info($post);
           return response()->json("post id not found");
        }
        log::info($post);

        $existingLike = Like::where('user_id', $user->id)->where('post_id', $id)->first();
    

        if ($existingLike) {
            log::info("You have already liked this post");
            return response()->json(['message' => 'You have already liked this post.'], 409); 
        }

        $dislike=Like::updateOrCreate([
            "user_id"=>$user->id,
            "post_id"=>$post->id,
            "value"=>true
        ]);
        log::info($dislike);
        return response()->json($dislike);
    }
    public function deleteDislike(Request $request,$id,$dislikeId){
        $post=Post::find($id);
        if(!$post){
            Log::info("post id not found");
            return response()->json("post id not found");
        }
        log::info($post);
        $dislike=$post->dislikes()->find($dislikeId);
        if(!$dislike){
            Log::info("dislike id not found");
            return response()->json("dislike id not found");
        }
        log::info($dislike);

        $dislike->delete();
        log::info("undislike successfully");
        return response()->json("undislike successfully");
    }

    public function count(Request $request,$id){
        log::info("start");
        $like=like::where("post_id",$id)->where("value",1)->count();
        $dislike=Dislike::where("post_id",$id)->where("value",1)->count();
          return response()->json([
          "Like"=>$like,
          "dislike"=>$dislike
        ]);
    }
}
