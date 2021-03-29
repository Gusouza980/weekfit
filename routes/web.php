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

Route::get('/dashboard/login', [\App\Http\Controllers\PainelController::class, 'login'])->name("painel.login");
Route::post('/dashboard/logar', [\App\Http\Controllers\PainelController::class, 'logar'])->name("painel.logar");

Route::middleware(['painel'])->group(function () {
    
    Route::get('/dashboard', [\App\Http\Controllers\PainelController::class, 'index'])->name("painel.index");
    Route::get('/dashboard/sair', [\App\Http\Controllers\PainelController::class, 'sair'])->name("painel.sair");
    
    Route::middleware(['admin'])->group(function () {
        // ROTAS REFERENTES A ACADEMIA
        Route::post("/dashboard/academia/selecionar", [\App\Http\Controllers\AcademiaController::class, 'selecionar'])->name("painel.academia.selecionar");
        Route::get('/dashboard/academias/cadastro', [\App\Http\Controllers\AcademiaController::class, 'cadastro'])->name("painel.academia.cadastro");
        Route::post('/dashboard/academias/cadastrar', [\App\Http\Controllers\AcademiaController::class, 'cadastrar'])->name("painel.academia.cadastrar");
        Route::get('/dashboard/academias', [\App\Http\Controllers\AcademiaController::class, 'index'])->name("painel.academias");
        Route::post('/dashboard/academia/nivel/alterar/{academia}', [\App\Http\Controllers\AcademiaController::class, 'nivel_alterar'])->name("painel.academia.nivel.alterar");
        Route::get('/dashboard/academia/edicao/{academia}', [\App\Http\Controllers\AcademiaController::class, 'edicao'])->name("painel.academia.edicao");
        Route::post('/dashboard/academia/salvar/{academia}', [\App\Http\Controllers\AcademiaController::class, 'salvar'])->name("painel.academia.salvar");
        Route::get('/dashboard/academia/detalhes/{academia}', [\App\Http\Controllers\AcademiaController::class, 'visualizar'])->name("painel.academia.visualizar");
        Route::post('/dashboard/academia/usuario/salvar/', [\App\Http\Controllers\AcademiaController::class, 'usuario_salvar'])->name("painel.academia.usuario.salvar");
        Route::post('/dashboard/academia/usuario/editar/{usuario}', [\App\Http\Controllers\AcademiaController::class, 'usuario_editar'])->name("painel.academia.usuario.editar");
        Route::get('/dashboard/academia/atividade/ativo/troca/{atividade}', [\App\Http\Controllers\AcademiaController::class, 'atividade_ativo'])->name("painel.academia.atividade.ativo");
        Route::get('/dashboard/academias/totais/atualizar', [\App\Http\Controllers\AcademiaController::class, 'atualizar_totais'])->name("painel.academia.totais.atualizar");


        //ROTAS REFERENTES AOS GRUPOS
        Route::get('/dashboard/configuracoes/grupos', [\App\Http\Controllers\GruposController::class, 'index'])->name("painel.configuracoes.grupos");
        Route::post('/dashboard/configuracoes/grupo/salvar/{grupo}', [\App\Http\Controllers\GruposController::class, 'salvar'])->name("painel.configuracoes.grupo.salvar");

        //ROTAS REFERENTES AOS SUBGRUPOS
        Route::post('/dashboard/configuracoes/subgrupo/salvar/{subgrupo}', [\App\Http\Controllers\SubgruposController::class, 'salvar'])->name("painel.configuracoes.subgrupo.salvar");
        Route::get('/dashboard/configuracoes/subgrupo/deletar/{subgrupo}', [\App\Http\Controllers\SubgruposController::class, 'deletar'])->name("painel.configuracoes.subgrupo.deletar");
        Route::post('/dashboard/configuracoes/subgrupo/adicionar', [\App\Http\Controllers\SubgruposController::class, 'adicionar'])->name("painel.configuracoes.subgrupo.adicionar");

        //ROTAS REFERENTES AS ATIVIDADES
        Route::get('/dashboard/configuracoes/grupo/{grupo}/atividades', [\App\Http\Controllers\AtividadesController::class, 'index'])->name("painel.configuracoes.grupo.atividades");
        Route::post('/dashboard/configuracoes/atividade/salvar/{atividade}', [\App\Http\Controllers\AtividadesController::class, 'salvar'])->name("painel.configuracoes.atividade.salvar");
        Route::get('/dashboard/configuracoes/atividade/deletar/{atividade}', [\App\Http\Controllers\AtividadesController::class, 'deletar'])->name("painel.configuracoes.atividade.deletar");
        Route::post('/dashboard/configuracoes/atividade/adicionar', [\App\Http\Controllers\AtividadesController::class, 'adicionar'])->name("painel.configuracoes.atividade.adicionar");

        Route::get('/dashboard/usuarios/cadastro', [\App\Http\Controllers\UsuarioController::class, 'cadastro'])->name("painel.usuario.cadastro");
        Route::post('/dashboard/usuarios/cadastrar', [\App\Http\Controllers\UsuarioController::class, 'cadastrar'])->name("painel.usuario.cadastrar");
        Route::get('/dashboard/usuarios', [\App\Http\Controllers\UsuarioController::class, 'consultar'])->name("painel.usuarios");
        Route::get('/dashboard/usuarios/editar/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'editar'])->name("painel.usuario.editar");
        Route::post('/dashboard/usuarios/salvar/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'salvar'])->name("painel.usuario.salvar");

        //ROTAS REFERENTES A CALENDÁRIOS 
        Route::get('/dashboard/calendario/intervencoes/todas', [\App\Http\Controllers\CalendarioController::class, 'todas_intervencoes'])->name("calendario.intervencoes.todas");
        Route::post('/dashboard/calendario/intervencao/salvar', [\App\Http\Controllers\CalendarioController::class, 'salvar_intervencao'])->name("calendario.intervencao.salvar");
        Route::get('/dashboard/calendario/intervencao/remover/{intervencao}', [\App\Http\Controllers\CalendarioController::class, 'remover_intervencao'])->name("calendario.intervencao.remover");
        Route::get('/teste', [\App\Http\Controllers\CalendarioController::class, 'teste']);

    });

    Route::get('/dashboard/calendario/intervencoes', [\App\Http\Controllers\CalendarioController::class, 'intervencoes'])->name("calendario.intervencoes");

    Route::middleware(['academia'])->group(function () {
        // ROTAS PARA O DONO DE ACADEMIA
        Route::get('/dashboard/administracao/lancamento', [\App\Http\Controllers\AcademiaController::class, 'lancamento'])->name("painel.administracao.lancamento");
        Route::post('/dashboard/administracao/atividade/status/trocar/{atividade}', [\App\Http\Controllers\AcademiaController::class, 'atividade_status'])->name("painel.administracao.atividade.status");
        // ROTAS REFERENTES AS DASHBOARDS
        Route::get('/dashboard/checklist', [\App\Http\Controllers\DashboardController::class, 'checklist'])->name("dashboard.checklist");

    });
    
});
