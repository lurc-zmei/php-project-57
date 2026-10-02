<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('task_statuses', TaskStatusController::class)->except(['index', 'show']);
    Route::resource('tasks', TaskController::class)->except(['index', 'show']);
    Route::resource('labels', LabelController::class)->except(['index', 'show']);
});

Route::get('/task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/labels', [LabelController::class, 'index'])->name('labels');

require __DIR__.'/auth.php';
