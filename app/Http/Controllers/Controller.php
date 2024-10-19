<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\makeprodect;
use App\Models\user;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function productmake(Request $request){
        $users=auth()->user();
        $user=user::find($users->id);
        
        $product= $user->makeprodect()->create([
           "user_id"=>$user->id,
           "post_type"=>$request->post_type,
           "title"=>$request->title,
           "content"=>$request->content,
           "description"=>$request->description,
           "file_path"=>$request->file_path,
           "file_type"=>$request->file_type,
           "status"=>$request->status
        ]);
        $product= $user->makeprodect;
        return $product;
    }
}
