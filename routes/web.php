<?php

use App\Http\Livewire\Admin\AreaController;
use App\Http\Livewire\Admin\CourseDetailsController;
use App\Http\Livewire\Admin\GradeController;
use App\Http\Livewire\Admin\GroupController;
use App\Http\Livewire\Admin\PeriodCoursesController;
use App\Http\Livewire\Admin\CourseController;
use App\Http\Livewire\Admin\ParticipantController;
use App\Http\Livewire\Admin\RoleController;
use App\Http\Livewire\Admin\UserController;
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

    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('periodos-cursos', PeriodCoursesController::class)->name('periods-courses');

    Route::middleware('can:role.show')->prefix('admin')->name('admin.')
        ->get('detalles-cursos', CourseDetailsController::class)->name('coursedetail');

    Route::middleware('can:course.show')->prefix('admin')->name('admin.')
        ->get('cursos', CourseController::class)->name('cursos');

    Route::middleware('can:participant.show')->prefix('admin')->name('admin.')
        ->get('participante', ParticipantController::class)->name('participante');
});
