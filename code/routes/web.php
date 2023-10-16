<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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


Route::get('/home',[HomeController::class ,'index']);

Route::get('/dashboard',[HomeController::class ,'index'])->name('dashboard');

//Login routes
Route::get('/login',[LoginController::class ,'index'])->name('login');
Route::post('/login',[LoginController::class ,'checklogin']);

//Register routes
Route::get('/register',[RegisterController::class ,'index']);
Route::post('/register',[RegisterController::class ,'store']);

//dashboard routes
Route::get('/dashboard',[DashboardController::class ,'index'])->name('dashboard');

//post routes
Route::get('/post',[PostController::class ,'index'])->name('post');

//post routes
Route::get('/category',[CategoryController::class ,'index'])->name('category');
Route::post('/category',[CategoryController::class ,'store']);
Route::get('/category/create',[CategoryController::class ,'create']);
Route::get('/category/{id}',[CategoryController::class ,'show']);
Route::put('/category/{id}',[CategoryController::class ,'update']);
Route::delete('/category/{id}',[CategoryController::class ,'destroy']);


