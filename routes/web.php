<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('mon-historique', [\App\Http\Controllers\HomeController::class, 'history'])->name('history.get');
    Route::resource('/game', \App\Http\Controllers\GameController::class)->only(['index', 'show']);
    Route::post('/check', [\App\Http\Controllers\GameController::class, 'check'])->name('game.check');
//TODO    Route::get('/game/{id}/play', [\App\Http\Controllers\GameController::class, 'play'])->name('game.play');
});

require __DIR__ . '/auth.php';
