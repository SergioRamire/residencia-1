<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\UserController;

// use App\Http\Livewire\Admin\UserController;

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

// Route::middleware([
//     'auth:web',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('participantes', \App\Http\Livewire\Admin\ParticipanteController::class);
    Route::get('cons', \App\Http\Livewire\Admin\ConstanciasController::class);
    // Route::resource('users', \App\Http\Livewire\Admin\UserController::class);
    // Route::resource('roles', RolController::class)->names('admin.roles');
});
