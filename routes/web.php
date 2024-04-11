<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

/**
 * rotas admin.*
 * estas rotas estão agrupadas para proteção do middleware auth_admin
 */
Route::middleware(['auth_admin'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.index');

    // relacionadas a produtos
    Route::get('/categorias', [AdminController::class, 'categorias'])->name('admin.categorias');
    Route::get('/cadastrar/categoria', [AdminController::class, 'cadastrar_categoria'])->name('admin.cadastrar_categoria');
    Route::post('/cadastrar/categoria/store', [AdminController::class, 'categoria_store'])->name('admin.cadastrar_categoria_store');
    Route::get('/alterar/categoria/{id}', [AdminController::class, 'alterar_categoria'])->name('admin.alterar_categoria');
    Route::match(['put', 'post'], '/alterar/categoria/{id}/store', [AdminController::class, 'categoria_store'])->name('admin.alterar_categoria_store');
    Route::delete('/excluir/categoria/{id}', [AdminController::class, 'excluir_categoria'])->name('admin.excluir_categoria');
    Route::get('/estoque', [AdminController::class, 'estoque'])->name('admin.estoque');
    Route::get('/produtos', [AdminController::class, 'produtos'])->name('admin.produtos');
    Route::get('/alterar/produto/{id}', [AdminController::class, 'alterar_produto'])->name('admin.alterar_produto');
    Route::post('/alterar/produto/{id}/decrement', [AdminController::class, 'decrement_produto'])->name('admin.decrement_produto');
    Route::post('/alterar/produto/{id}/increment', [AdminController::class, 'increment_produto'])->name('admin.increment_produto');
    Route::match(['put', 'post'], '/alterar/produto/{id}/store', [AdminController::class, 'produto_store'])->name('admin.alterar_produto.store');
    Route::get('/cadastrar/produto', [AdminController::class, 'cadastrar_produto'])->name('admin.cadastrar_produto');
    Route::post('/cadastrar/produto/store', [AdminController::class, 'produto_store'])->name('admin.cadastrar_produto_store');
    Route::delete('/excluir/produto/{id}', [AdminController::class, 'excluir_produto'])->name('admin.excluir_produto');
});


/**
 * rotas admin.*
 * estas rotas estão agrupadas para proteção do middleware auth_prop
 * para funções que só o priprietário pode ter acesso
 */
Route::middleware(['auth_prop'])->prefix('admin')->group(function () {

    // relacionadas a usuários
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/alterar/usuario/{id}', [AdminController::class, 'alterar_usuario'])->name('admin.alterar_usuario');
    Route::put('/alterar/usuario/{id}/store', [UserController::class, 'store'])->name('admin.alterar_usuario.store');
    Route::delete('/excluir/usuario/{id}', [AdminController::class, 'excluir_usuario'])->name('admin.excluir_usuario');
});
/**
 * outras rotas
 */
// Route::get('/', function () {
//     return view('index');
// });
Route::view('/', 'index')->name('site.index');
/** 
 * login system
 */
Route::view('/entrar', 'login.form')->name('login');
Route::post('/entrar/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/sair', [LoginController::class, 'logout'])->name('logout.auth');

/**
 * cadastro de usuário
 */
Route::get('/cadastro', [UserController::class, 'create'])->name('user.create');
Route::post('/cadastrar', [UserController::class, 'store'])->name('users.store');

/**
 * produtos
 */
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
