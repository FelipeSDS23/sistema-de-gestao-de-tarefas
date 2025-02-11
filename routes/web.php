<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Private App routes
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function() {
    // App routes
    Route::get('/', [AppController::class, 'index'])->name('dashboard');
    Route::get('/config', [AppController::class, 'config'])->name('dashboard.config');
    
    // Tasks routes
    Route::resource('tasks', TaskController::class);
});

// Authentication routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
