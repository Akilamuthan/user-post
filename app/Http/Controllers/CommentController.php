<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class CommentController extends Controller
{
    public function showAll(Request $request,$id)
    {
        $post=Post::find($id);
        log::info($post);
        $comment=$post->comments;
        log::info($comment);
        if($comment){
        log::info($comment);
        return response()->json([
            "post"=>$post,
            "comment"=>$comment]);
        
        }
        return response()->json("comment id not found");
    }



    public function showComment(Request $request, $commentId)
{
    $comment = Comment::find($commentId);
    
    if (!$comment) {
        return response()->json("Comment not found", 404);
    }

    Log::info($comment);

   
    $post = $comment->posts; 
    Log::info($post);

    return response()->json([
        "comment" => $comment,
        "post" => $post
    ]);
}


    public function createComment(CommentRequest $request,$postid)
    {
        $user_id = auth()->id();
        log::info($user_id);
        $post=Post::find($postid);
        log::info($post);
        if(!$post){
            return response()->json("Post It not found");
        }
        $validatedData = $request->validated();
         $comment=Comment::create([
              "user_id"=>$user_id,
              "post_id"=>$post->id,
              "content"=>$validatedData["content"]
         ]);
         return response()->json([
            "post"=>$post,
            "comment"=>$comment]);
        
    }

    public function updateComment(CommentRequest $request,$id,$commentId)
    {
        $user_id = auth()->id();
        log::info($user_id);
        log::info($commentId);

        $post=Post::find($id);

        $comment=Post::find($id)->comments()->find($commentId);
        log::info($comment);
        if($comment){

        $validatedData = $request->validated();

        $comment->update([
            "user_id"=>$user_id,
            "post_id"=>$id,
            "content"=>$validatedData["content"]
        ]);

        return response()->json([
            "post"=>$post,
            "comment"=>$comment]);
        }
        return response()->json("comment and post id not found");
    }
 
    public function deleteComment(Request $request,$id,$commentId)
    {
        $post=Post::find($id);

        if(!$post){
            return response()->json('Post it not found');
        }

        log::info($post);
        $comment=Post::find($id)->comments()->find($commentId);
        if($comment){
        $comment->delete();
        return Response()->json("successfully deleted");
        }
        return response()->json("comment and post id not found");
    }

}
