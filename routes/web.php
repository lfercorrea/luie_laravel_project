<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;

/*
* rotas /admin
*/
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/produtos', [AdminController::class, 'produtos'])->name('admin.produtos');
Route::get('/admin/estoque', [AdminController::class, 'estoque'])->name('admin.estoque');
// CRUD
Route::get('/admin/alterar/produto/{id}', [AdminController::class, 'alterar_produto'])->name('admin.alterar_produto');
Route::get('/admin/cadastrar/produto', [AdminController::class, 'cadastrar_produto'])->name('admin.cadastrar_produto');
Route::get('/admin/excluir/produto', [AdminController::class, 'excluir_produto'])->name('admin.excluir_produto');

/*
* rotas /
*/
Route::get('/', function () {
    return view('index');
});
Route::view('/teste', 'teste');
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
