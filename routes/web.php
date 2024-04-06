<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

/**
 * rotas admin.*
 * estas rotas estão agrupadas para proteção do middleware auth_admin
 */
Route::middleware(['auth_admin'])->prefix('admin')->group(function () {

    // diversas
    Route::get('/', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.index');
    Route::get('/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
    Route::get('/permissoes', [AdminController::class, 'permissoes'])->name('admin.permissoes');

    // relacionadas a produtos
    Route::get('/categorias', [AdminController::class, 'categorias'])->name('admin.categorias');
    Route::get('/estoque', [AdminController::class, 'estoque'])->name('admin.estoque');
    Route::get('/produtos', [AdminController::class, 'produtos'])->name('admin.produtos');
    Route::get('/alterar/produto/{id}', [AdminController::class, 'alterar_produto'])->name('admin.alterar_produto');
    Route::get('/cadastrar/produto', [AdminController::class, 'cadastrar_produto'])->name('admin.cadastrar_produto');
    Route::post('/cadastrar/produto/store', [AdminController::class, 'store'])->name('admin.cadastrar_produto_store');
    Route::get('/excluir/produto', [AdminController::class, 'excluir_produto'])->name('admin.excluir_produto');
});

/**
 * outras rotas
 */
// Route::get('/', function () {
//     return view('index');
// });
Route::view('/', 'index')->name('site.index');
/** login system */
Route::view('/entrar', 'login.form')->name('login');
Route::post('/entrar/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/sair', [LoginController::class, 'logout'])->name('logout.auth');


Route::get('/categorias', [SiteController::class, 'categorias'])->name('site.categorias');
Route::get('/categorias/ver/{id}', [SiteController::class, 'ver_categoria'])->name('site.ver.categoria');
Route::get('/produtos', [SiteController::class, 'produtos'])->name('site.produtos');
Route::get('/produtos/ver/{slug}', [SiteController::class, 'ver_produto'])->name('site.ver.produto');

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
