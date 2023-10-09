<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
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



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', [UserController::class,'register']);
    Route::post('login', [UserController::class,'login']);
    Route::post('logout', [UserController::class,'logout']);
    Route::post('refresh', [UserController::class,'refresh']);
    Route::post('me', [UserController::class,'me']);

});


Route::middleware(['jwt.auth'])->group(function(){
    Route::get('users/index', [UserController::class,'index']);
    Route::get('users/show/{user}', [UserController::class,'show']);
    Route::get('users/show/{user}', [UserController::class,'show']);
    Route::delete('users/destroy/{user}', [UserController::class,'destroy']);
});
