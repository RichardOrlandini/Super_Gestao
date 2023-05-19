<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\fornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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
    Route::get('/cliente', [ClienteController::class,  'index'])->name('app.cliente');
    Route::get('/fornecedor', [fornecedorController::class,  'index'])->name('app.fornecedor');
    Route::get('/produto', [ProdutoController::class,  'index'])->name('app.produto');
});


Route::get('/teste/{p1}/{p2}', [TesteController::class,  'teste'])->name('site.teste');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href=" '.route('site.index').'">clique aqui </a> ';
});


  
