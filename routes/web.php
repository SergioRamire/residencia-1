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
    Route::get('calificaciones', \App\Http\Livewire\Admin\GradeController::class)->name('grades');
    Route::get('areas', \App\Http\Livewire\Admin\AreaController::class)->name('area');
    Route::get('grupos', \App\Http\Livewire\Admin\GroupController::class)->name('group');
    Route::get('inscripciones', \App\Http\Livewire\Admin\InscriptionController::class)->name('inscriptions');
});
