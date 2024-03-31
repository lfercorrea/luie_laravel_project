<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;

/*
* rotas criadas por mim
*/
Route::get('/', function () {
    return view('index');
});
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::view('/teste', 'teste');
// Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos', [SiteController::class, 'index'])->name('site.index');

/*
* rotas padrão do laravel
*/
Route::view('/welcome', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
