<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses');
Route::get('task_statuses/create', [TaskStatusController::class, 'create'])->name('task_statuses.create');
Route::post('task_statuses/store', [TaskStatusController::class, 'store'])->name('task_statuses.store');


//Route::resource('task_statuses', TaskStatusController::class)->parameters(['task_statuses' => 'id']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
