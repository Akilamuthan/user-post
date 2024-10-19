<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use app\Http\Middleware\Admin;
use App\Http\Controllers\CommentController;
use app\Http\Middleware\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ViewController;

Route::post('register', [AuthController::class, 'register'])->middleware('web');
Route::post('login', [AuthController::class, 'login'])->middleware('web');


Route::group(['middleware' => ['auth:api']], function () {
//user routes

Route::delete('users/delete/{id}',[UserController::class,'userDelete']);

Route::put('users/update/{id}', [UserController::class, 'userUpdate']);
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('posts', [PostController::class, 'showAll']);
    Route::get('posts/{id}', [PostController::class, 'showPost']);
    Route::post('posts/create', [PostController::class, 'createPost']);
    Route::post('posts/update/{id}', [PostController::class, 'updatePost']);
    Route::delete('posts/delete/{id}', [PostController::class, 'deletePost']); 


});


Route::group(['middleware' => ['auth:api', 'admin']], function () {
    // Categories  routes
    Route::get('categories', [CategoryController::class, 'showAll'])->middleware(Admin::class);
    Route::get('categories/{id}', [CategoryController::class, 'showCategory']);
    Route::post('categories/create', [CategoryController::class, 'createCategory']);
    Route::put('categories/update/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('categories/delete/{id}', [CategoryController ::class, 'deleteCategory']); 

    // Tags  routes
    Route::get('tags', [TagController::class, 'showAll']);
    Route::get('tags/{id}', [TagController::class, 'showTag']);
    Route::post('tags/create', [TagController::class, 'createTag']);
    Route::put('tags/update/{id}', [TagController::class, 'updateTag']);
    Route::delete('tags/delete/{id}', [TagController::class, 'deleteTag']); 
});

Route::group(['middleware' => ['auth:api']], function () {


    // Commend routes

    Route::get('posts/{id}/comments', [CommentController::class, 'showAll']);

    Route::get('comment/{commentId}', [CommentController::class, 'showComment']);

    Route::post('posts/{id}/comment', [CommentController::class, 'createComment']);

    Route::put('posts/{id}/comment/{commentId}', [CommentController::class, 'updateComment']);

    Route::delete('posts/{id}/comment/{commentId}', [CommentController ::class, 'deleteComment']); 


});


//Likes and dislikes route 
Route::group(['middleware' => ['auth:api']], function () {

    //Likes  route 
    Route::post('posts/{id}/like', [LikeController::class, 'createLike']);

    Route::delete('posts/{id}/like/{likeId}', [LikeController ::class, 'unLike']); 

    //dislikes route 
    Route::post('posts/{id}/dislike', [LikeController::class, 'createDislike']);

    Route::delete('posts/{id}/dislike/{dislikeId}', [LikeController ::class, 'unDislike']); 

    //like and dislike counts
    Route::get('posts/{id}/like',[LikeController::class,'countLike']);
    Route::get('posts/{id}/dislike',[LikeController::class,'countDislike']);
});
     //follow the user

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('follow/{id}',[FollowController::class,'follow']);

    Route::delete('unfollow/{id}',[FollowController::class,'unfollow']);

    Route::get('followers',[FollowController::class,'followersCount']);

    Route::get('following',[FollowController::class,'followingCount']);


    //views for the post

    Route::post('posts/{id}/view',[ViewController::class,'createView']);
    Route::get('posts/{id}/views',[ViewController::class,'viewsCount']);
    
});