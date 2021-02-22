<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function(){
    return view("index");
});

Route::get('/painel/login', [\App\Http\Controllers\PainelController::class, 'login'])->name("painel.login");
Route::post('/painel/logar', [\App\Http\Controllers\PainelController::class, 'logar'])->name("painel.logar");

Route::middleware(['painel'])->group(function () {
    Route::get('/painel', [\App\Http\Controllers\PainelController::class, 'index'])->name("painel.index");
    Route::get('/painel/sair', [\App\Http\Controllers\PainelController::class, 'sair'])->name("painel.sair");

    // ROTAS REFERENTES A ACADEMIA
    Route::get('/painel/academias/cadastro', [\App\Http\Controllers\AcademiaController::class, 'cadastro'])->name("painel.academia.cadastro");
    Route::post('/painel/academias/cadastrar', [\App\Http\Controllers\AcademiaController::class, 'cadastrar'])->name("painel.academia.cadastrar");
    Route::get('/painel/academias', [\App\Http\Controllers\AcademiaController::class, 'index'])->name("painel.academias");
    Route::get('/painel/academia/edicao/{academia}', [\App\Http\Controllers\AcademiaController::class, 'edicao'])->name("painel.academia.edicao");
    Route::post('/painel/academia/salvar/{academia}', [\App\Http\Controllers\AcademiaController::class, 'salvar'])->name("painel.academia.salvar");
    Route::get('/painel/academia/detalhes/{academia}', [\App\Http\Controllers\AcademiaController::class, 'visualizar'])->name("painel.academia.visualizar");
    Route::post('/painel/academia/usuario/salvar/', [\App\Http\Controllers\AcademiaController::class, 'usuario_salvar'])->name("painel.academia.usuario.salvar");
    Route::post('/painel/academia/usuario/editar/{usuario}', [\App\Http\Controllers\AcademiaController::class, 'usuario_editar'])->name("painel.academia.usuario.editar");
    Route::get('/painel/academia/atividade/ativo/troca/{atividade}', [\App\Http\Controllers\AcademiaController::class, 'atividade_ativo'])->name("painel.academia.atividade.ativo");

    Route::get('/painel/dados', [\App\Http\Controllers\PainelController::class, 'dados'])->name("painel.dados");
});
