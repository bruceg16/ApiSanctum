<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('logout', [AuthController::class,'logout']);
    Route::get('products',[ProductController::class, 'index']);
    Route::get('product/{id}',[ProductController::class, 'show']);
    Route::post('product/create',[ProductController::class, 'store']);
    Route::put('product/{id}/update',[ProductController::class, 'update']);
    Route::delete('product/{id}/destroy',[ProductController::class, 'destroy']);
});