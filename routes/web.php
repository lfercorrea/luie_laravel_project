<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteconfigController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlterarSenhaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\TamanhoController;
use App\Http\Controllers\UserController;

/**
 * rotas admin.*
 * estas rotas estão agrupadas para proteção do middleware auth_admin
 */
Route::middleware(['auth', 'auth_admin'])->prefix('admin')->group(function () {
    /**
     * ACP index
     */
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    /**
     * tamanhos
     */
    Route::get('/tamanhos', [TamanhoController::class, 'index'])->name('admin.tamanhos');
    Route::get('/cadastrar/tamanho', [TamanhoController::class, 'create'])->name('admin.tamanho_create');
    Route::post('/cadastrar/tamanho/store', [TamanhoController::class, 'store'])->name('admin.tamanho_store');
    Route::get('/alterar/tamanho/{id}', [TamanhoController::class, 'edit'])->name('admin.tamanho_edit');
    Route::match(['put', 'post'], '/alterar/tamanho/{id}/store', [TamanhoController::class, 'store'])->name('admin.tamanho_update');
    Route::delete('/excluir/tamanho/{id}', [TamanhoController::class, 'destroy'])->name('admin.tamanho_destroy');
    /**
     * categorias
     */
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('admin.categorias');
    Route::get('/cadastrar/categoria', [CategoriaController::class, 'create'])->name('admin.cadastrar_categoria');
    Route::post('/cadastrar/categoria/store', [CategoriaController::class, 'store'])->name('admin.cadastrar_categoria_store');
    Route::get('/alterar/categoria/{id}', [CategoriaController::class, 'edit'])->name('admin.alterar_categoria');
    Route::match(['put', 'post'], '/alterar/categoria/{id}/store', [CategoriaController::class, 'store'])->name('admin.alterar_categoria_store');
    Route::delete('/excluir/categoria/{id}', [CategoriaController::class, 'destroy'])->name('admin.excluir_categoria');
    /**
     * produtos
     */
    Route::get('/estoque', [ProdutoController::class, 'index'])->name('admin.estoque');
    Route::get('/estoque/imprimir', [ProdutoController::class, 'index'])->name('admin.estoque.imprimir');
    Route::get('/alterar/produto/{id}', [ProdutoController::class, 'edit'])->name('admin.alterar_produto');
    Route::post('/alterar/produto/{id}/decrement', [ProdutoController::class, 'decrement'])->name('admin.decrement_produto');
    Route::post('/alterar/produto/{id}/increment', [ProdutoController::class, 'increment'])->name('admin.increment_produto');
    Route::match(['put', 'post'], '/alterar/produto/{id}/store', [ProdutoController::class, 'store'])->name('admin.alterar_produto.store');
    Route::get('/cadastrar/produto', [ProdutoController::class, 'create'])->name('admin.cadastrar_produto');
    Route::post('/cadastrar/produto/store', [ProdutoController::class, 'store'])->name('admin.cadastrar_produto_store');
    Route::delete('/excluir/produto/{id}', [ProdutoController::class, 'destroy'])->name('admin.excluir_produto');
});
/**
 * rotas admin.*
 * estas rotas estão agrupadas para proteção do middleware auth_prop
 * para funções que só o priprietário pode ter acesso
 */
Route::middleware(['auth', 'auth_prop'])->prefix('admin')->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('admin.usuarios');
    Route::get('/alterar/usuario/{id}', [UserController::class, 'edit'])->name('admin.alterar_usuario');
    Route::put('/alterar/usuario/{id}/store', [UserController::class, 'store'])->name('admin.alterar_usuario.store');
    Route::delete('/excluir/usuario/{id}', [UserController::class, 'destroy'])->name('admin.excluir_usuario');
    
    Route::get('/siteconfig', [SiteconfigController::class, 'index'])->name('admin.siteconfig');
    Route::put('/siteconfig/store', [SiteconfigController::class, 'store'])->name('admin.siteconfig_store');
});
/**
 * site index
 */
Route::get('/', [SiteController::class, 'index'])->name('site.index');
/** 
 * login system
 */
Route::get('/entrar', [LoginController::class, 'index'])->name('login');
Route::post('/entrar/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/sair', [LoginController::class, 'logout'])->name('logout.auth');
/**
 * cadastro de usuário
 */
Route::get('/cadastro', [UserController::class, 'create'])->name('user.create');
Route::post('/cadastrar', [UserController::class, 'store'])->name('users.store');
Route::get('/alterar_senha/{id}', [AlterarSenhaController::class, 'alterar_senha'])->name('users.alterar_senha');
Route::post('/alterar_senha/{id}/store', [AlterarSenhaController::class, 'store'])->name('users.alterar_senha.store');
/**
 * produtos
 */
Route::get('/categorias', [SiteController::class, 'categorias'])->name('site.categorias');
Route::get('/categorias/ver/{id}', [SiteController::class, 'ver_categoria'])->name('site.ver.categoria');
Route::get('/produtos', [SiteController::class, 'produtos'])->name('site.produtos');
Route::get('/produtos/ver/{slug}', [SiteController::class, 'ver_produto'])->name('site.ver.produto');

require __DIR__.'/auth.php';
