<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/category/create',[ApiCategoryController::class ,'create']);
Route::post('/category',[ApiCategoryController::class ,'store']);
Route::get('/category/{id}',[ApiCategoryController::class ,'show']);
Route::put('/category/{id}',[ApiCategoryController::class ,'update']);
Route::delete('/category/{id}',[ApiCategoryController::class ,'destroy']);
