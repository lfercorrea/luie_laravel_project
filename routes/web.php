<?php

use Illuminate\Support\Facades\Route;
// rotas criadas por mim
Route::view('/teste', 'teste');

// rotas padrão do laravel
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
