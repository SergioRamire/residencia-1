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

Route::middleware([
    'auth:web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:web', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware('role:super-admin')->group(function () {
        Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
        Route::get('/usuarios', \App\Http\Livewire\Admin\UserController::class)->name('usuarios');
    });

    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
            Route::get('/usuarios', \App\Http\Livewire\Admin\UserController::class)->name('usuarios');
        });
    });

    Route::middleware('role:instructor')->group(function () {
        Route::prefix('instructor')->name('instructor.')->group(function () {
            Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
        });
    });

    Route::middleware('role:participant')->group(function () {
        Route::prefix('participante')->name('participant.')->group(function () {
            Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
        });
    });
});
