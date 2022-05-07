<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:web', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::middleware(['can:user.show', 'can:role.show'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('usuarios', \App\Http\Livewire\Admin\UserController::class)->name('usuarios');
            Route::get('roles', \App\Http\Livewire\Admin\RoleController::class)->name('roles');
        });
    });
});
