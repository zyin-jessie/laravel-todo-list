<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);
Route::resource('/tasks', TaskController::class)->except(['index']);

Route::post('/tasks/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
Route::delete('/tasks/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');
