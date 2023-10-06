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


Route::middleware('checkRoleUser')->group(function () {

    Route::get('/dashboard/user',[UsersController::class, 'index'])->name('userDashboard');
    Route::get('/dashboard/admin/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/dashboard/admin/users/{id}/delete', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::post('/dashboard/admin/users', [UsersController::class, 'store'])->name('users.store');
    Route::put('/dashboard/admin/users/{id}', [UsersController::class, 'update'])->name('users.update');

    Route::get('/dashboard/admin/users/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/dashboard/admin/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');


    Route::get('/dashboard/admin/rols/create', [RolsController::class, 'create'])->name('rols.create');
    Route::get('/dashboard/admin/rols/{id}', [RolsController::class, 'destroy'])->name('rols.destroy');
    Route::post('/dashboard/admin/rols', [RolsController::class, 'store'])->name('rols.store');
    Route::get('/dashboard/admin/rols{id}', [RolsController::class, 'show'])->name('rols.show');
    Route::get('/dashboard/admin/rols/{id}/edit', [RolsController::class, 'edit'])->name('rols.edit');
    Route::put('/dashboard/admin/rols/{id}', [RolsController::class, 'update'])->name('rols.update');


});

Route::middleware('auth')->group(function () {



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
