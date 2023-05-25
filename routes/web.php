<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\fornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;
use Illuminate\Support\Facades\Route;


Route::middleware('log.acesso')->get('/', [PrincipalController::class,  'index'])->name('site.index');
Route::get('/contato', [ContatoController::class,  'index'])->name('site.contato');
Route::post('/contato', [ContatoController::class,  'create'])->name('site.create');
Route::get('/sobre-nos', [SobreNosController::class,  'index'])->name('site.sobrenos');
Route::get('/login/{erro?}', [LoginController::class,  'index'])->name('site.login');
Route::post('/login', [LoginController::class,  'autenticar'])->name('site.login');


Route::middleware('autenticacao:padrao')->prefix('/app')->group(function() {
    Route::get('/home', [HomeController::class,  'index'])->name('app.home');
    Route::get('/sair', [LoginController::class,  'sair'])->name('app.sair');

    Route::resource('produto', ProdutoController::class);
    Route::resource('produto-detalhe', ProdutoDetalheController::class);
    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    //Route::resource('pedido-produto', PedidoProdutoController::class);

    Route::get('/pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('/pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    
    Route::get('/fornecedor', [fornecedorController::class,  'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [fornecedorController::class,  'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [fornecedorController::class,  'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [fornecedorController::class,  'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [fornecedorController::class,  'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [fornecedorController::class,  'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [fornecedorController::class,  'delete'])->name('app.fornecedor.delete');
//11 95342-82-98 11 4324-5908
});


Route::get('/teste/{p1}/{p2}', [TesteController::class,  'teste'])->name('site.teste');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href=" '.route('site.index').'">clique aqui </a> ';
});


  
