<?php

use App\Http\Livewire\Admin\RoleController;
use App\Http\Livewire\Admin\UserController;
use App\Http\Livewire\Admin\ConstanciasController;
use App\Http\Livewire\Admin\InstructorCurseController;
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

    Route::middleware('can:user.show')->prefix('admin')->name('admin.')
        ->get('constancias', ConstanciasController::class)->name('constancias');

    Route::middleware('can:user.show')->prefix('admin')->name('admin.')
        ->get('instructores', InstructorCurseController::class)->name('instructores');


    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('roles', RoleController::class)->name('roles');
});
