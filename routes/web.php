<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassementController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\MatcheController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    // sports
    Route::resource('sports', SportController::class);
    // equipes
    Route::resource('equipes', EquipeController::class);
    // joueurs
    Route::resource('joueurs', JoueurController::class);
    // matches
    Route::resource('matches', MatcheController::class);
    // classement
    Route::resource('classements', ClassementController::class);
    

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
