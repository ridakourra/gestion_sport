<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    // sports
    Route::resource('sports', SportController::class);
    // equipes
    Route::resource('equipes', EquipeController::class);
    // joueurs
    Route::resource('joueurs', AdminController::class);
    // matches
    Route::resource('matches', AdminController::class);
    // classements
    Route::resource('classements', AdminController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
