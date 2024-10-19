<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TagController extends Controller
{
    //show the tag datas
    public function showAll(){
        $tags=Tag::all();
        return response()->json($tags);
        }
    
        //Show the particular tag data
        public function showTag(Request $request,$id){
            log::info($id);
            $tag=Tag::find($id);
            if($tag){
            log::info($tag);
            return response()->json($tag);
            }
            return response()->json("Id not found");
        }
    

        //create tag data
        public function createTag(Request $request){

            log::info($request->name);

            $validator=validator::make($request->all(),[
                'name'=>'required|max:255|string|unique:tags,name,NULL,id,deleted_at,NULL'
            ]);

            if ($validator->fails()) {
                Log::info("Validation failed", $validator->errors()->all());
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $validatorData=$validator->validated();
            $slug=Str::slug($request->name);
            log::info($slug);
            $tag=Tag::create([
                "name"=>$validatorData['name'],
                "slug"=>$slug
            ]);
            return response()->json($tag);
        }
    

        //update tag data 
        public function updateTag(Request $request,$id){
            log::info($id);
            log::info($request);
            
            $tag=Tag::find($id);
            if($tag){
            log::info($tag);

            $validator=validator::make($request->all(),[
                'name'=>'required|max:255|string|unique:tags,name,NULL,id,deleted_at,NULL'
            ]);
           
    
            if ($validator->fails()) {
                Log::info("Validation failed", $validator->errors()->all());
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $validatorData=$validator->validated();

            $slug=Str::slug($request->name);
            $tag->update([
                "name"=>$validatorData['name'],
                "slug"=>$slug
            ]);
            log::info($tag);
            return response()->json($tag);
        }
        return response()->json("Id not found");
    
         
        }
    

        //delete tag data
        public function deleteTag(Request $request,$id){
            log::info($id);
            $tag=Tag::find($id);

            if($tag){
            log::info($tag);
            $tag->delete();
            log::info("successfully deleted");
            return response()->json("Successfully deleted");
            }
            return response()->json("Id not found");
        }
}
