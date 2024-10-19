<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\prodect;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
// Public routes
Route::prefix('page')->group(function() {
    Route::get('registerpage', function () {
        return view('auth.register');
    })->name("registerpage");

    Route::get('loginpage', function () {
        return view('auth.login');
    })->name("loginpage");


});

// User page route

Route::middleware('auth:api')->get('userpage', function (Request $request) {
    return view('userswebpage')->name('users');
});

// Admin routes

Route::get('admin/{user}', [AdminController::class, 'index'])
    ->middleware(\App\Http\Middleware\Admin::class,)
    ->name('admin');

// Home route
Route::get('/', function () {
    return view('welcome');
})->name("welcome");




Route::get('prodect',function(){
    return view('auth.prodect');
})->name('prodect');
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



 Route::post('/post',function(){
    return "hello";   
 });

 Route::post('prodect',[prodect::class,'prodect']);
 Route::get('payment/{id}',[prodect::class,'payment']);
 Route::get('paymented',[prodect::class,'notification']);


 Route::get('prodect/{id}',[Homecontroller::class,'prodect'])->name('product');
Route::get('listproduct/',[HomeController::class,'listproduct'])->name('listproduct');

Route::post('/admin/settings/update', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

Route::get('paymentdetail/{id}',[HomeController::class,'paymentdetail'])->name("paymentdetail");

Route::get('setting/',[HomeController::class,'setting'])->name('setting');

Route::get('productpayment/{id}',[HomeController::class,'productpayment'])->name('productpayment');

 Route::get('content',function(){
    return view('content');
 })->name('content');
 
 Route::get('report',[HomeController::class,'report'])->name('report');
 Route::get('order',[HomeController::class,'order'])->name('order');

 Route::get('resource',[HomeController::class,'resource']);     

 Route::get('search',[HomeController::class,'search'])->name('search');

 Route::get('categroy',[HomeController::class,'categroy'])->name('categroy');

Route::get('google',function(){
    $apikey=config('google.googleapikey');
    return "hello".$apikey;
});

