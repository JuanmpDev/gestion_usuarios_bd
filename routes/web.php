<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolsController;
use App\Http\Middleware\CheckUserRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Rol;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

 Route::get('/test', function () {

});

Route::get('/dashboard', [UsersController::class, 'index'])->name('dashboard');

Route::get('/updates', function(){

    return view ('layouts/update');

})->name('updates');


Route::Resource('/admin/users', UsersController::class)->middleware('checkRoleUser');

    // Route::get('index',[UsersController::class, 'index'])->name('userDashboard');
    // Route::get('create', [UsersController::class, 'create'])->name('users.create');
    // Route::get('destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    // Route::post('store', [UsersController::class, 'store'])->name('users.store');
    // Route::get('show/{id}', [UsersController::class, 'show'])->name('users.show');
    // Route::get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    // Route::put('update/{id}', [UsersController::class, 'update'])->name('users.update');



Route::Resource("/admin/rols",RolsController::class)->except(["show"]);

       /*
        Route::get('create', [RolsController::class, 'create'])->name('rols.create');
        Route::get('destroy/{id}', [RolsController::class, 'destroy'])->name('rols.destroy');
        Route::post('store', [RolsController::class, 'store'])->name('rols.store');
        Route::get('show{id}', [RolsController::class, 'show'])->name('rols.show');
        Route::get('{id}/edit', [RolsController::class, 'edit'])->name('rols.edit');
        Route::put('update/{id}', [RolsController::class, 'update'])->name('rols.update');*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
