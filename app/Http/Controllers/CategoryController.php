<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
       // show all category
       public function showAll(){
        $categories=Category::all();
        return response()->json($categories);
        }
       
         // show category
        public function showCategory(Request $request,$id){
            log::info($id);
            $category=Category::find($id);
            if($category){
            log::info($category);
            return response()->json($category);
            }
            return response()->json("Id not found");
        }
    //create category
        public function createCategory(Request $request){
            log::info($request->name);
            $validator=validator::make($request->all(),[
                'name'=>'required|max:255|string|unique:categories,name,NULL,id,deleted_at,NULL'
            ]);
            if ($validator->fails()) {
                Log::info("Validation failed", $validator->errors()->all());
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $validatorData=$validator->validated();
            $slug=Str::slug($request->name);
            log::info($slug);
            $category=Category::create([
                "name"=>$validatorData['name'],
                "slug"=>$slug
            ]);
            return response()->json($category);
        }
    //update category
        public function updateCategory(Request $request,$id){
            log::info($id);
            log::info($request);
            $validator=validator::make($request->all(),[
                'name'=>'required|max:255|string|unique:categories,name,NULL,id,deleted_at,NULL'
            ]);
           
    
            if ($validator->fails()) {
                Log::info("Validation failed", $validator->errors()->all());
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $validatorData=$validator->validated();
            $category=Category::find($id);
            if($category){
            log::info($category);
            $slug=Str::slug($request->name);
            $category->update([
                "name"=>$validatorData['name'],
                "slug"=>$slug
            ]);
            log::info($category);
            return response()->json($category);
        }
        return response()->json("Id not found");
    
         
        }
    // delete category 
        public function deleteCategory(Request $request,$id){
            log::info($id);
            $category=Category::find($id);
            if($category){
            log::info($category);
            $category->delete();
            log::info("successfully deleted");
            return response()->json("Successfully deleted");
            }
            return response()->json("Id not found");
        }
}
