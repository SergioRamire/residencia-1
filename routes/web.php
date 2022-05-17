<?php

use App\Http\Livewire\Admin\AreaController;
use App\Http\Livewire\Admin\GroupController;
<<<<<<< HEAD
use App\Http\Livewire\Admin\GradeController;
=======
use App\Http\Livewire\Admin\RoleController;
use App\Http\Livewire\Admin\UserController;
>>>>>>> 4e6f3902fa7a93297b28ad0ef0ef15ddf300268c
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

    Route::middleware('can:user.show')->prefix('admin')->name('admin.')
        ->get('usuarios', UserController::class)->name('usuarios');

    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('roles', RoleController::class)->name('roles');

    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('areas', AreaController::class)->name('area');

    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('grupos', GroupController::class)->name('group');

    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('Asignar-calificacion', GradeController::class)->name('grades');

});
