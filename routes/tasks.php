<?php

use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;

// Task Routes
Route::prefix('tasks')->group(function () {
    // Get all tasks
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

    // Create a new task
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');

    // Get a specific task by ID
    Route::get('{id}', [TaskController::class, 'show'])->name('tasks.show');

    // Update a specific task by ID
    Route::put('{id}', [TaskController::class, 'update'])->name('tasks.update');

    // Delete a specific task by ID
    Route::delete('{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
