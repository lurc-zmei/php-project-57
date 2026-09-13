<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses');
Route::get('/task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
Route::post('/task_statuses/store', [TaskStatusController::class, 'store'])->name('task_statuses.store');
Route::get('/task_statuses/{id}/edit', [TaskStatusController::class, 'edit'])->name('task_statuses.edit');
Route::patch('/task_statuses/{id}/update', [TaskStatusController::class, 'update'])->name('task_statuses.update');
Route::delete('/task_statuses/{id}', [TaskStatusController::class, 'destroy'])->name('task_statuses.destroy');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

Route::get('/labels', [LabelController::class, 'index'])->name('labels');
Route::get('/labels/create', [LabelController::class, 'create'])->name('labels.create');
Route::post('/labels/store', [LabelController::class, 'store'])->name('labels.store');
Route::get('/labels/{id}/edit', [LabelController::class, 'edit'])->name('labels.edit');
Route::patch('/labels/{id}/update', [LabelController::class, 'update'])->name('labels.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
