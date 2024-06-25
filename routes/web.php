<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;

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
});


Route::middleware('auth')
    ->prefix('admin') // Prefisso nell'url delle rotte di questo gruppo
    ->name('admin.') // inizio di ogni nome delle rotte del gruppo
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        //i pass the slug parameter to the controller instead of passing the id
        Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);

        Route::get('/trash', [ProjectController::class, 'trash'])->name('projects.trash');
        Route::delete('/projects/{id}/forceDelete', [ProjectController::class, 'forceDelete'])->name('projects.forceDelete');
        Route::put('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::post('/projects/restoreall', [ProjectController::class, 'restoreall'])->name('projects.restoreall');

        Route::resource('types', TypeController::class);
    });
require __DIR__ . '/auth.php';
