<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{

//create like
public function createLike(Request $request, $id)
{
    $user = auth()->user();
    Log::info($user);

    $request->merge([
        "user_id"=>$user->id,
        "post_id"=>$id
    ]);
    $validator=validator::make($request->all(),[
       "user_id"=>"required|numeric|exists:users,id",
       "post_id"=>"required|numeric|exists:posts,id"
    ]);
    if($validator->fails()){
       return response()->json($validator->errors());
    }

    $alreadyLike = Like::where('user_id', $user->id)->where('post_id', $id)->exists();
    
    if ($alreadyLike) {
        return response()->json(['message' => 'You cannot like this item again'], 400); 
    }


    $like = Like::create([
        'user_id' => $user->id,
        'post_id' => $id,
        'status' => 'like',  
    ]);
    Log::info($like);

    return response()->json(['message' => 'Successfully liked the post.', 'like' => $like]); 
}


//create dislike
public function createDislike(Request $request, $id)
{
    $user = auth()->user();
    Log::info($user);
    $request->merge([
        "user_id"=>$user->id,
        "post_id"=>$id
    ]);
    $validator=validator::make($request->all(),[
       "user_id"=>"required|numeric|exists:users,id",
       "post_id"=>"required|numeric|exists:posts,id"
    ]);
    if($validator->fails()){
       return response()->json($validator->errors());
    }

    $alreadyDislike = Like::where('user_id', $user->id)->where('post_id', $id)->exists();

    if ($alreadyDislike) {
        return response()->json(['message' => 'You cannot dislike this item again'], 400); 
    }

    $dislike = Like::create([
        'user_id' => $user->id,
        'post_id' => $id,
        'status' => 'dislike',
    ]);
    Log::info($dislike);

    return response()->json(['message' => 'Successfully disliked the post.', 'like' => $dislike]); 
}



// like delete 

public function unLike(Request $request, $id,$likeId){
    $user=auth()->user();

    $post=Post::find($id);
    log::info($post);

    $request->merge([
        "user_id"=>$user->id,
        "post_id"=>$id,
        "likes"=>$likeId
    ]);

    $validator=validator::make($request->all(),[
        "user_id"=>"required|numeric|exists:users,id",
        "post_id"=>"required|numeric|exists:posts,id",
        "likes"=>"required|numeric|exists:likes,id"
     ]);

     if($validator->fails()){
        return response()->json($validator->errors());
     }

    if(!$post){
        log::info("Post id not found");
        return response()->json("Post id not found");
    }
    $like=$post->likes()->find($likeId);
    
    if(!$like){
        log::info("id not found");
        return response()->json("id not found");
    }
    

    log::info($like);
    $like->delete();
    log::info("successfully deleted");
    return response()->json("successfully unlike");}


//dislike delete
public function unDislike(Request $request, $id,$dislikeId){

    $user=auth()->user();

    $post=Post::find($id);
    log::info($post);

    $request->merge([
        "user_id"=>$user->id,
        "post_id"=>$id,
        "likes"=>$dislikeId
    ]);

    $validator=validator::make($request->all(),[
        "user_id"=>"required|numeric|exists:users,id",
        "post_id"=>"required|numeric|exists:posts,id",
        "likes"=>"required|numeric|exists:likes,id"
     ]);

     if($validator->fails()){
        return response()->json($validator->errors());
     }

    if(!$post){
        log::info("Post id not found");
        return response()->json("Post id not found");
    }
    
    $dislike=$post->likes()->find($dislikeId);

    if(!$dislike){
    log::info("id not found");
    return response()->json("id not found");
    }

    log::info($dislike);
    $dislike->delete();
    log::info("successfully deleted");
    return response()->json("successfully undislike");
}

public function countLike(Request $request,$id){
    log::info("start");

    $like=like::where("post_id",$id)->where("status","like")->count();

      return response()->json([
      "like"=>$like
    ]);
}


public function countDislike(Request $request,$id){
    log::info("start");


    $dislike=like::where("post_id",$id)->where("status","dislike")->count();

    return response()->json([
      "dislike"=>$dislike
    ]);
}

}
