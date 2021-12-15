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
        Route::get('/dashboard/academias/inativas', [\App\Http\Controllers\AcademiaController::class, 'index_inativas'])->name("painel.academias.inativas");
        Route::get('/dashboard/academia/jornada/ativar/{academia}', [\App\Http\Controllers\JornadaController::class, 'ativar'])->name("painel.academia.jornada.ativar");
        Route::get('/dashboard/academia/jornada/desativar/{academia}', [\App\Http\Controllers\JornadaController::class, 'desativar'])->name("painel.academia.jornada.desativar");
        Route::get('/dashboard/academia/jornada/promover/{academia}', [\App\Http\Controllers\JornadaController::class, 'promover'])->name("painel.academia.jornada.promover");
        Route::get('/dashboard/academia/jornada/rebaixar/{academia}', [\App\Http\Controllers\JornadaController::class, 'rebaixar'])->name("painel.academia.jornada.rebaixar");
        Route::post('/dashboard/academia/nivel/alterar/{academia}', [\App\Http\Controllers\AcademiaController::class, 'nivel_alterar'])->name("painel.academia.nivel.alterar");
        Route::get('/dashboard/academia/edicao/{academia}', [\App\Http\Controllers\AcademiaController::class, 'edicao'])->name("painel.academia.edicao");
        Route::post('/dashboard/academia/salvar/{academia}', [\App\Http\Controllers\AcademiaController::class, 'salvar'])->name("painel.academia.salvar");
        Route::get('/dashboard/academia/detalhes/{academia}', [\App\Http\Controllers\AcademiaController::class, 'visualizar'])->name("painel.academia.visualizar");
        Route::post('/dashboard/academia/usuario/salvar/', [\App\Http\Controllers\AcademiaController::class, 'usuario_salvar'])->name("painel.academia.usuario.salvar");
        Route::post('/dashboard/academia/usuario/editar/{usuario}', [\App\Http\Controllers\AcademiaController::class, 'usuario_editar'])->name("painel.academia.usuario.editar");
        Route::get('/dashboard/academia/atividade/ativo/troca/{atividade}', [\App\Http\Controllers\AcademiaController::class, 'atividade_ativo'])->name("painel.academia.atividade.ativo");
        Route::get('/dashboard/academias/totais/atualizar', [\App\Http\Controllers\AcademiaController::class, 'atualizar_totais'])->name("painel.academia.totais.atualizar");
        Route::post('/dashboard/academias/getree/rede/{academia}', [\App\Http\Controllers\AcademiaController::class, 'rede_getree'])->name("painel.academia.getree.rede");
        Route::post('/dashboard/academias/getree/adicionar/{academia}', [\App\Http\Controllers\AcademiaController::class, 'adicionar_getree'])->name("painel.academia.getree.adicionar");
        Route::post('/dashboard/academias/getree/salvar/{getree}', [\App\Http\Controllers\AcademiaController::class, 'salvar_getree'])->name("painel.academia.getree.salvar");
        Route::get('/dashboard/academias/getree/remover/{getree}', [\App\Http\Controllers\AcademiaController::class, 'remover_getree'])->name("painel.academia.getree.remover");

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

        //ROTAS REFERENTES A JORNADA
        Route::get('/dashboard/configuracoes/jornada/atividades', [\App\Http\Controllers\JornadaController::class, 'atividades'])->name("painel.configuracoes.jornada.atividades");
        Route::post('/dashboard/configuracoes/jornada/atividade/adicionar', [\App\Http\Controllers\JornadaController::class, 'cadastrar'])->name("painel.configuracoes.jornada.atividade.cadastrar");
        Route::post('/dashboard/configuracoes/jornada/atividade/salvar/{atividade}', [\App\Http\Controllers\JornadaController::class, 'salvar'])->name("painel.configuracoes.jornada.atividade.salvar");
        Route::get('/dashboard/configuracoes/jornada/atividade/deletar/{atividade}', [\App\Http\Controllers\JornadaController::class, 'deletar'])->name("painel.configuracoes.jornada.atividade.deletar");
        
        
        
        
        Route::get('/dashboard/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name("painel.logs");
    });

    Route::get('/dashboard/calendario/intervencoes', [\App\Http\Controllers\CalendarioController::class, 'intervencoes'])->name("calendario.intervencoes");

    Route::middleware(['academia'])->group(function () {
        // ROTAS PARA O DONO DE ACADEMIA
        Route::get('/dashboard/administracao/lancamento', [\App\Http\Controllers\AcademiaController::class, 'lancamento'])->name("painel.administracao.lancamento");
        Route::post('/dashboard/administracao/atividade/status/trocar/{atividade}', [\App\Http\Controllers\AcademiaController::class, 'atividade_status'])->name("painel.administracao.atividade.status");
        
        Route::get('/dashboard/administracao/jornada', [\App\Http\Controllers\JornadaController::class, 'lancamento'])->name("painel.administracao.jornada");
        Route::get('/dashboard/administracao/jornada/status/trocar/{atividade}', [\App\Http\Controllers\JornadaController::class, 'completar'])->name("painel.administracao.jornada.status");
        
        // ROTAS REFERENTES AS DASHBOARDS
        Route::get('/dashboard/checklist', [\App\Http\Controllers\DashboardController::class, 'checklist'])->name("dashboard.checklist");
        Route::get('/dashboard/jornada', [\App\Http\Controllers\DashboardController::class, 'jornada'])->name("dashboard.jornada");
        Route::get('/dashboard/leads', [\App\Http\Controllers\AcademiaController::class, 'leads'])->name("dashboard.leads");
        Route::post('/dashboard/lead/status/alterar', [\App\Http\Controllers\AcademiaController::class, 'lead_status_alterar'])->name("dashboard.lead.status.alterar");
    
        Route::get('/dashboard/academia/getree/relatorio/{academia}', [\App\Http\Controllers\AcademiaController::class, 'relatorio_getree'])->name("painel.academiaa.getree.relatorio");
        
    });
    
});
