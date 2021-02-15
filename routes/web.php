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


Route::get('/painel/login', [\App\Http\Controllers\PainelController::class, 'login'])->name("painel.login");
Route::post('/painel/logar', [\App\Http\Controllers\PainelController::class, 'logar'])->name("painel.logar");

Route::middleware(['painel'])->group(function () {
    Route::get('/painel', [\App\Http\Controllers\PainelController::class, 'index'])->name("painel.index");
    Route::get('/painel/sair', [\App\Http\Controllers\PainelController::class, 'sair'])->name("painel.sair");

    Route::get('/painel/dados', [\App\Http\Controllers\PainelController::class, 'dados'])->name("painel.dados");
});
