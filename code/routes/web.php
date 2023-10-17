<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[WebsiteController::class ,'home'])->name('website');
Route::get('/post//{slug}',[WebsiteController::class ,'post'])->name('website.post');
Route::get('/category//{slug}',[WebsiteController::class ,'category'])->name('website.category');
Route::get('/about',[WebsiteController::class ,'about'])->name('website.about');

//Login routes
Route::get('/login',[LoginController::class ,'index'])->name('login');
Route::post('/login',[LoginController::class ,'checklogin']);
Route::get('/logout',[LoginController::class ,'logout'])->name('logout');

//Register routes
Route::get('/register',[RegisterController::class ,'index']);
Route::post('/register',[RegisterController::class ,'store']);


Route::group(['middleware' => ['auth']], function() {

    //dashboard routes
    Route::get('/dashboard',[DashboardController::class ,'index'])->name('dashboard');

    //post routes
    Route::get('/post',[PostController::class ,'index'])->name('post');
    Route::post('/post',[PostController::class ,'store']);
    Route::get('/post/create',[PostController::class ,'create']);
    Route::get('/post/{id}',[PostController::class ,'show']);
    Route::post('/post/{id}',[PostController::class ,'update']);

    //post routes
    Route::get('/category',[CategoryController::class ,'index'])->name('category');
    Route::get('/category/create',[CategoryController::class ,'create']);
    Route::post('/category',[CategoryController::class ,'store']);
    Route::get('/category/{id}',[CategoryController::class ,'show']);
    Route::put('/category/{id}',[CategoryController::class ,'update']);
    Route::delete('/category/{id}',[CategoryController::class ,'destroy']);

    //User routes
    Route::get('/user',[UserController::class ,'index'])->name('user');
    Route::get('/user/create',[UserController::class ,'create']);
    Route::get('/user/{id}',[UserController::class ,'show']);
    Route::put('/user/{id}',[UserController::class ,'update']);
    Route::delete('/user/{id}',[UserController::class ,'destroy']);
});