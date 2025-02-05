<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Private App routes
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tasks', function() {
        return view('tasks');
    })->name('dashboard.tasks');
});

// Authentication routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
