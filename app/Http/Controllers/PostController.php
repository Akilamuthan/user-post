<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Post; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\Category; 
use App\Models\Tag;
use App\Http\Requests\ValidationRequest;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;

class PostController extends Controller
{
   // Create the post
   public function createPost(CreateRequest $request)
   {
       $categoryId = $request->category_id;
       Log::info("Category ID: " . $categoryId);
       $file=$request->file_path;
       $title = $request->title;
       $tag_id=$request->tag_id;
       $user = auth()->user();
       if (!$user) {
           return response()->json(['error' => 'Unauthorized'], 403);
       }
   
       Log::info('User Info:', ['user' => $user]);
   
       $validatedData = $request->validated();
       Log::info('Validated Data:', $validatedData);

      

       if ($request->hasFile('file_path')) {
        try {
            $filePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('download'), $filePath);
            log::info($filePath);
        } catch (\Exception $e) {
            Log::error("File upload error: " . $e->getMessage());
            return response()->json(['error' => 'File upload failed: ' . $e->getMessage()], 500);
        }
        
       } else {
           return response()->json(['error' => 'File is required'], 422);
       }
         
       $slug = Str::slug($title);
       Log::info("Generated Slug:", ['slug' => $slug]);
       Log::info($user->id);

       $postData = array_merge([
        'post_type' => $validatedData['post_type'], 
        'title' => $validatedData['title'], 
        'content' => $validatedData['content'], 
        'description' => $validatedData['description'], 
        'file_type' => $validatedData['file_type'], 
        'status' => $validatedData['status'], 
        'file_path' => $filePath,
        'user_id' => $user->id,
        'slug' => $slug,
        'category_id' => $categoryId,
    ]);
    
       $post = Post::create($postData);
       
       if ($tag_id&& is_array($tag_id)) {

           Log::info('Syncing Tag IDs:', $tag_id);
           $post->tags()->sync($tag_id);
           Log::info($tag_id);

       }
       log::info($post);
       return response()->json($post, 201);
   }
   
   
//Upadte the post
public function updatePost(UpdateRequest $request, $id)
{
    Log::info('Incoming request data:', $request->all());

    $categoryId = $request->category_id;
    Log::info("Category ID: " . $categoryId);
    $file=$request->file_path;
    $title = $request->title;
    $tag_id=$request->tag_id;

    $user = auth()->user();


    $post = Post::find($id);

    if (!$post) {
        return response()->json(['error' => "Post with ID $id not found"], 404);
    }

    Log::info('Validation started');

    $validatedData = $request->validated();
      

    Log::info('Validation successful');

    $filePath = $post->file_path;
    if ($request->hasFile('file_path')) {
        try {
            Log::info('File upload initiated');
            $file = $request->file('file_path');
            $filePath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('download'), $filePath);
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return response()->json(['error' => 'File upload failed: ' . $e->getMessage()], 500);
        }
    }

    $validatedData = array_merge([
        'post_type' => $request->post_type, 
        'title' => $request->title, 
        'content' => $request->content, 
        'description' =>$request->description, 
        'file_type' => $request->file_type, 
        'status' => $request->status, 
        'file_path' => $filePath,
        'user_id' => $user->id,
        'slug' => Str::slug($request->title),
        'category_id' => $request->category_id,
    ]);

    Log::info('Data prepared for update:', $validatedData);

    $post->update($validatedData);

    Log::info($post);

    
    $tagIds = $tag_id;
    if (is_array($tagIds)) {
        Log::info('Syncing Tag IDs:', $tagIds);
        $post->tags()->sync($tagIds);
    }

    return response()->json([$post]);
}


  //Delete the post  
public function deletePost(Request $request,$id)
    {
        $user = auth()->user();
        Log::info($user);
        $post = Post::find($id);
        if($post){
        Log::info("Successfully deleting post ID: " . $post->id);
        $post->delete();
        log::info($request);
        return response()->json("Successfully deleted $id post");
        }
        return response()->json("post id $id not found");
         
        
        
        
    }
    //Show the post
    public function showAll()
    {
        $user = auth()->user();
        $posts= Post::with('category','tags')->get(); 
        Log::info($posts);
        return response()->json([$posts]);
        
    }

    public function showPost(Request $request,$id)
    {    
        $post = Post::find($id); 
        Log::info($post);
        if($post){
        log::info($post);
        return response()->json($post
);
        }
        return response()->json("emty post");
    }

    

 
}
