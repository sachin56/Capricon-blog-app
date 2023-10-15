<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class ,'index']);

Route::get('/dashboard',[HomeController::class ,'index'])->name('dashboard');

//Login routes
Route::get('/login',[LoginController::class ,'index']);
Route::post('/login',[LoginController::class ,'checklogin']);

//Register routes
Route::get('/register',[RegisterController::class ,'index']);
Route::post('/register',[RegisterController::class ,'store']);
