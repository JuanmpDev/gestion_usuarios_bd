<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RolsController;
use App\Http\Controllers\Api\UserController;
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

], function () {
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout']);
    Route::post('refresh', [LoginController::class,'refresh']);
    Route::post('me', [LoginController::class,'me']);

});

Route::post('register', [LoginController::class,'register']);




Route::middleware(['jwt.auth'])->group(function(){

    Route::resource('users', UserController::class)->except(['create', 'edit']);

       // Route::get('index',[UsersController::class, 'index'])->name('userDashboard');
        // Route::get('destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        // Route::post('store', [UsersController::class, 'store'])->name('users.store');
        // Route::get('show/{id}', [UsersController::class, 'show'])->name('users.show');
        // Route::put('update/{id}', [UsersController::class, 'update'])->name('users.update');

    Route::resource ('rols', RolsController ::class);

         /*
        Route::get('index', [RolsController::class, 'index'])->name('index');
        Route::get('destroy/{id}', [RolsController::class, 'destroy'])->name('rols.destroy');
        Route::post('store', [RolsController::class, 'store'])->name('rols.store');
        Route::get('show{id}', [RolsController::class, 'show'])->name('rols.show');
        Route::put('update/{id}', [RolsController::class, 'update'])->name('rols.update');*/

});
