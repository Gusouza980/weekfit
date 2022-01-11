<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Academia;
use App\Models\Usuario;
use App\Models\Atividade;
use App\Models\AtividadeAcademia;
use App\Models\Lead;
use App\Models\GetreeElemento;
use App\Models\DashboardLancamento;
use App\Models\DashboardResultadoAdministrativo;
use App\Models\DashboardResultadoTecnico;
use App\Models\DashboardResultadoComercial;
use App\Models\DashboardResultadoMarketing;

class AcademiaController extends Controller
{
    //

    public function index(){
        $academias = Academia::where("ativo", true)->get();
        return view("painel.academia.consultar", ["academias" => $academias, "filtro" => "ativas"]);
    }

    public function index_inativas(){
        $academias = Academia::where("ativo", false)->get();
        return view("painel.academia.consultar", ["academias" => $academias, "filtro" => "inativas"]);
    }

    public function visualizar(Academia $academia){
        return view("painel.academia.visualizar", ["academia" => $academia]);
    }

    public function edicao(Academia $academia){
        return view("painel.academia.edicao", ["academia" => $academia]);
    }

    public function cadastro(){
        return view("painel.academia.cadastro");
    }

    public function selecionar(Request $request){
        if($request->academia == 0){
            session()->forget("academia");
        }else{
            session()->put(["academia" => $request->academia]);
            toastr()->success("Academia selecionada");
        }
        
        return redirect()->back();
    }

    public function cadastrar(Request $request){

        $request->validate([
            'usuario_proprietario' => 'unique:usuarios,usuario',
        ]);

        $academia = new Academia;

        $academia->nome = $request->nome;
        $academia->email = $request->email;
        $academia->telefone = $request->telefone;
        $academia->rua = $request->rua;
        $academia->numero = $request->numero;
        $academia->bairro = $request->bairro;
        $academia->cidade = $request->cidade;
        $academia->estado = $request->estado;
        $academia->cep = $request->cep;
        $academia->url = $request->url;
        $academia->cpf = $request->cpf;
        $academia->cnpj = $request->cnpj;

        $academia->codigo = $request->codigo;
        $academia->ativo = $request->ativo;

        $academia->aplicativo = $request->aplicativo;
        $academia->whatsapp = $request->whatsapp;
        $academia->painel = $request->painel;

        $academia->login_sistema = $request->login_sistema;
        $academia->senha_sistema = $request->senha_sistema;

        $academia->login_google = $request->login_google;
        $academia->senha_google = $request->senha_google;

        $academia->facebook = $request->facebook;
        $academia->login_facebook = $request->login_facebook;
        $academia->senha_facebook = $request->senha_facebook;

        $academia->linkedin = $request->linkedin;
        $academia->login_linkedin = $request->login_linkedin;
        $academia->senha_linkedin = $request->senha_linkedin;

        $academia->instagram = $request->instagram;
        $academia->login_instagram = $request->login_instagram;
        $academia->senha_instagram = $request->senha_instagram;

        $academia->pinterest = $request->pinterest;
        $academia->login_pinterest = $request->login_pinterest;
        $academia->senha_pinterest = $request->senha_pinterest;

        $academia->youtube = $request->youtube;
        $academia->login_youtube = $request->login_youtube;
        $academia->senha_youtube = $request->senha_youtube;

        $academia->twitter = $request->twitter;
        $academia->login_twitter = $request->login_twitter;
        $academia->senha_twitter = $request->senha_twitter;

        $academia->google_negocio = $request->google_negocio;
        $academia->login_google_negocio = $request->login_google_negocio;
        $academia->senha_google_negocio = $request->senha_google_negocio;

        $academia->tiktok = $request->tiktok;
        $academia->login_tiktok = $request->login_tiktok;
        $academia->senha_tiktok = $request->senha_tiktok;

        $academia->inicio_contrato = $request->inicio_contrato;
        $academia->fim_contrato = $request->fim_contrato;
        $academia->valor_contrato = $request->valor_contrato;

        if($request->file("logo")){
            $academia->logo = $request->file('logo')->store(
                'admin/images/logos/'.Str::slug($academia->nome), 'local'
            );
        }

        $academia->save();

        Log::channel('cadastros')->info('<b>CADASTRANDO ACADEMIA #'.$academia->id.'</b>: O usuario <b>' . session()->get("usuario")["usuario"] . '</b> cadastrou a academia <b>' . $academia->nome . '</b>.');

        $atividades = Atividade::all();

        foreach($atividades as $atividade){
            $atividade_academia = new AtividadeAcademia;
            $atividade_academia->academia_id = $academia->id;
            $atividade_academia->atividade_id = $atividade->id;
            $atividade_academia->subgrupo_id = $atividade->subgrupo_id;
            $atividade_academia->save();
        }

        $usuario = new Usuario;

        $usuario->nome = $request->nome_proprietario;
        $usuario->email = $request->email_proprietario;
        $usuario->telefone = $request->telefone_proprietario;
        $usuario->usuario = $request->usuario_proprietario;
        $usuario->senha = Hash::make($request->senha_proprietario);
        $usuario->academia_id = $academia->id;
        $usuario->departamento = 100;
        $usuario->lider = true;
        $usuario->acesso = 0;
        $usuario->save();

        toastr()->success("Academia cadastrada com sucesso!");
        return redirect()->back();
    }

    public function salvar(Request $request, Academia $academia){
        
        if(count($academia->proprietario) > 0){
            $request->validate([
                'usuario_proprietario' => 'unique:usuarios,usuario,'.$academia->proprietario[0]->id,
            ]);
        }

        $old = $academia->getOriginal();

        $academia->nome = $request->nome;
        $academia->email = $request->email;
        $academia->telefone = $request->telefone;
        $academia->rua = $request->rua;
        $academia->numero = $request->numero;
        $academia->bairro = $request->bairro;
        $academia->cidade = $request->cidade;
        $academia->estado = $request->estado;
        $academia->cep = $request->cep;
        $academia->url = $request->url;
        $academia->cpf = $request->cpf;
        $academia->cnpj = $request->cnpj;
        
        $academia->observacoes = $request->observacoes;

        $academia->titulo_getree = $request->titulo_getree;
        $academia->cor_titulo_getree = $request->cor_titulo_getree;
        $academia->subtitulo_getree = $request->subtitulo_getree;
        $academia->cor_subtitulo_getree = $request->cor_subtitulo_getree;
        $academia->slug_getree = $request->slug_getree;
        $academia->cor_fundo_cartao_getree = $request->cor_fundo_cartao_getree;
        $academia->cor_fundo_cartao_hover_getree = $request->cor_fundo_cartao_hover_getree;
        $academia->cor_letra_cartao_getree = $request->cor_letra_cartao_getree;
        $academia->cor_letra_cartao_hover_getree = $request->cor_letra_cartao_hover_getree;

        $academia->codigo = $request->codigo;
        $academia->ativo = $request->ativo;

        $academia->aplicativo = $request->aplicativo;
        $academia->whatsapp = $request->whatsapp;
        $academia->painel = $request->painel;

        $academia->login_sistema = $request->login_sistema;
        $academia->senha_sistema = $request->senha_sistema;

        $academia->login_google = $request->login_google;
        $academia->senha_google = $request->senha_google;
        
        $academia->facebook = $request->facebook;
        $academia->login_facebook = $request->login_facebook;
        $academia->senha_facebook = $request->senha_facebook;

        $academia->linkedin = $request->linkedin;
        $academia->login_linkedin = $request->login_linkedin;
        $academia->senha_linkedin = $request->senha_linkedin;

        $academia->instagram = $request->instagram;
        $academia->login_instagram = $request->login_instagram;
        $academia->senha_instagram = $request->senha_instagram;

        $academia->pinterest = $request->pinterest;
        $academia->login_pinterest = $request->login_pinterest;
        $academia->senha_pinterest = $request->senha_pinterest;

        $academia->youtube = $request->youtube;
        $academia->login_youtube = $request->login_youtube;
        $academia->senha_youtube = $request->senha_youtube;

        $academia->twitter = $request->twitter;
        $academia->login_twitter = $request->login_twitter;
        $academia->senha_twitter = $request->senha_twitter;

        $academia->google_negocio = $request->google_negocio;
        $academia->login_google_negocio = $request->login_google_negocio;
        $academia->senha_google_negocio = $request->senha_google_negocio;

        $academia->tiktok = $request->tiktok;
        $academia->login_tiktok = $request->login_tiktok;
        $academia->senha_tiktok = $request->senha_tiktok;

        $academia->inicio_contrato = $request->inicio_contrato;
        $academia->fim_contrato = $request->fim_contrato;
        $academia->valor_contrato = $request->valor_contrato;

        if($request->file("logo")){
            Storage::delete($academia->logo);
            $academia->logo = $request->file('logo')->store(
                'admin/images/logos/'.Str::slug($academia->nome), 'local'
            );
        }

        if($request->file("fundo_getree")){
            Storage::delete($academia->fundo_getree);
            $academia->fundo_getree = $request->file('fundo_getree')->store(
                'admin/images/getree/'.Str::slug($academia->nome), 'local'
            );
        }

        $academia->save();

        foreach($academia->getChanges() as $campo => $valor){
            if(!in_array($campo, ["updated_at", "slug"])){
                Log::channel('cadastros')->info('<b>EDITANDO ACADEMIA #' . $academia->id . '</b>: O usuario <b>' . session()->get("usuario")["usuario"] . '</b> alterou o valor do campo <b>' . $campo . '</b> de <b>' . $old[$campo] . '</b> para <b>' . $valor . '</b>');
            }
        }

        if(count($academia->proprietario) > 0){
            $usuario = $academia->proprietario[0];
            $usuario->nome = $request->nome_proprietario;
            $usuario->email = $request->email_proprietario;
            $usuario->telefone = $request->telefone_proprietario;
            $usuario->usuario = $request->usuario_proprietario;
            if($request->senha_proprietario){
                $usuario->senha = Hash::make($request->senha_proprietario);
            }
            $usuario->save();
        }else{
            $usuario = new Usuario;
            $usuario->academia_id = $academia->id;
            $usuario->nome = $request->nome_proprietario;
            $usuario->email = $request->email_proprietario;
            $usuario->telefone = $request->telefone_proprietario;
            $usuario->usuario = $request->usuario_proprietario;
            $usuario->departamento = 100;
            $usuario->acesso = 0;
            if($request->senha_proprietario){
                $usuario->senha = Hash::make($request->senha_proprietario);
            }
            $usuario->save();
        }

        toastr()->success("Dados salvos com sucesso!");
        return redirect()->back();
    }

    public function usuario_salvar(Request $request){
        if($request->lider == 1){
            $lider = Usuario::where([["academia_id", $request->academia_id], ["departamento", $request->departamento], ["lider", true]])->count();
            if($lider){
                toastr()->error("Já existe um líder para este departamento");
                return redirect()->back();
            }
        }
        $usuario = new Usuario;

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        $usuario->usuario = $request->usuario;
        $usuario->senha = Hash::make($request->senha);
        $usuario->academia_id = $request->academia_id;
        $usuario->departamento = $request->departamento;
        $usuario->lider = $request->lider;
        $usuario->acesso = 0;
        $usuario->save();

        toastr()->success("Usuário salvo com sucesso");
        return redirect()->back();
    }

    public function usuario_editar(Request $request, Usuario $usuario){
        if($request->lider == 1 && !$usuario->lider){
            $lider = Usuario::where([["academia_id", $usuario->academia_id], ["departamento", $request->departamento], ["lider", true]])->count();
            if($lider){
                toastr()->error("Já existe um líder para este departamento");
                return redirect()->back();
            }
        }

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        $usuario->usuario = $request->usuario;
        if($request->senha){
            $usuario->senha = Hash::make($request->senha);
        }
        $usuario->departamento = $request->departamento;
        $usuario->lider = $request->lider;
        $usuario->save();

        toastr()->success("Usuário salvo com sucesso");
        return redirect()->back();
    }

    public function atividade_ativo(AtividadeAcademia $atividade){
        if($atividade->ativo){
            $atividade->ativo = false;
            $atividade->save();
            return response()->json("desativado", 200);
        }else{
            $atividade->ativo = true;
            $atividade->save();
            return response()->json("ativado", 200);
        }
        
    }

    public function atividade_status(Request $request, AtividadeAcademia $atividade){
        $atividade->status = $request->status;
        $atividade->save();
        return response()->json("sucesso");
    }

    public function atualizar_totais(){
        $academias = Academia::where("ativo", true)->get();
        foreach($academias as $academia){
            $departamentos = [];
            $departamentos["total_atividades"] = 0;
            $departamentos["total_atividades_completas"] = 0;
            for($i = 0; $i < 4; $i++){
                $departamentos[$i]["total_atividades"] = 0;
                $departamentos[$i]["total_atividades_completas"] = 0;
                $grupos = \App\Models\Grupo::where("departamento", $i)->get();
                foreach($grupos as $grupo){
                    $subgrupos = $grupo->subgrupos;
                    foreach($subgrupos as $subgrupo){
                        foreach($academia->atividades->where("ativo", 1)->where("subgrupo_id", $subgrupo->id) as $atividade){
                            $departamentos[$i]["total_atividades"] += 1;
                            if($atividade->status == 2){
                                $departamentos[$i]["total_atividades_completas"] += 1;
                            }
                        }
                    }
                }
                $departamentos["total_atividades"] += $departamentos[$i]["total_atividades"];
                $departamentos["total_atividades_completas"] += $departamentos[$i]["total_atividades_completas"];
            }

            $academia->total_geral = ($departamentos["total_atividades_completas"] * 100) / $departamentos["total_atividades"];
            $academia->total_administrativo = ($departamentos[0]["total_atividades_completas"] * 100) / $departamentos[0]["total_atividades"];
            $academia->total_tecnico = ($departamentos[1]["total_atividades_completas"] * 100) / $departamentos[1]["total_atividades"];
            $academia->total_comercial = ($departamentos[2]["total_atividades_completas"] * 100) / $departamentos[2]["total_atividades"];
            $academia->total_marketing = ($departamentos[3]["total_atividades_completas"] * 100) / $departamentos[3]["total_atividades"];
            $academia->save();
        }
        return redirect()->back();
    }

    public function nivel_alterar(Request $request, Academia $academia){
        $academia->nivel = $request->nivel;
        $academia->save();
        return response()->json("sucesso");
    }

    public function lancamento(){
        if(session()->get("usuario")["admin"]){
            if(session()->get("academia")){
                $academia = Academia::find(session()->get("academia"));
            }else{
                toastr()->error("Selecione uma academia antes de utilizar essa página");
                return redirect()->route("painel.index");
            }
        }else{
            $academia = Academia::find(session()->get("usuario")["academia_id"]);
        }
        return view("painel.academia.lancamento", ['academia' => $academia]);
    }

    public function leads(Request $request){
        if($request->isMethod("GET")){
            $anomes = date('Y-m');
            $mesano = date('m-Y');
            $inicio = $anomes . "-1 00:00:00";
            $fim = date('Y-m-t', strtotime($anomes)) . " 23:59:59";
        }else{
            $inicio = $request->inicio . " 00:00:00";
            $fim = $request->fim . " 23:59:59";
        }
        if(session()->get("usuario")["admin"]){
            $leads = Lead::where([["academia_id", session()->get("academia")], ["created_at", ">=", $inicio], ["created_at", "<=", $fim]])->get();
        }else{
            $leads = Lead::where([["academia_id", session()->get("usuario")["academia_id"]], ["created_at", ">=", $inicio], ["created_at", "<=", $fim]])->get();
        }
       
        return view("painel.leads.consultar", ["leads" => $leads, "inicio" => $inicio, "fim" => $fim]);
    }

    public function lead_status_alterar(Request $request){
        $lead = Lead::find($request->lead);
        $lead->status = $request->status;
        $lead->save();
        return response()->json(200);
    }

    public function rede_getree(Request $request, Academia $academia){
        switch ($request->name) {
            case "facebook_getree":
                if($academia->facebook_getree){
                    $academia->facebook_getree = false;
                    $msg = "O Facebook foi removido do Getree";
                }else{
                    $academia->facebook_getree = true;
                    $msg = "O Facebook foi adicionado ao Getree";
                }
                
                break;
            case "linkedin_getree":
                if($academia->linkedin_getree){
                    $academia->linkedin_getree = false;
                    $msg = "O Linkedin foi removido do Getree";
                }else{
                    $academia->linkedin_getree = true;
                    $msg = "O Linkedin foi adicionado ao Getree";
                }
                break;
            case "instagram_getree":
                if($academia->instagram_getree){
                    $academia->instagram_getree = false;
                    $msg = "O Instagram foi removido do Getree";
                }else{
                    $academia->instagram_getree = true;
                    $msg = "O Instagram foi adicionado ao Getree";
                }
                break;
            case "pinterest_getree":
                if($academia->pinterest_getree){
                    $academia->pinterest_getree = false;
                    $msg = "O Pinterest foi removido do Getree";
                }else{
                    $academia->pinterest_getree = true;
                    $msg = "O Pinterest foi adicionado ao Getree";
                }
                break;
            case "twitter_getree":
                if($academia->twitter_getree){
                    $academia->twitter_getree = false;
                    $msg = "O Twitter foi removido do Getree";
                }else{
                    $academia->twitter_getree = true;
                    $msg = "O Twitter foi adicionado ao Getree";
                }
                break;
            case "youtube_getree":
                if($academia->youtube_getree){
                    $academia->youtube_getree = false;
                    $msg = "O Youtube foi removido do Getree";
                }else{
                    $academia->youtube_getree = true;
                    $msg = "O Youtube foi adicionado ao Getree";
                }
                break;
            case "google_negocio_getree":
                if($academia->google_negocio_getree){
                    $academia->google_negocio_getree = false;
                    $msg = "O Google Meu Negócio foi removido do Getree";
                }else{
                    $academia->google_negocio_getree = true;
                    $msg = "O Google Meu Negócio foi adicionado ao Getree";
                }
                break;
            case "tiktok_getree":
                if($academia->tiktok_getree){
                    $academia->tiktok_getree = false;
                    $msg = "O Tiktok foi removido do Getree";
                }else{
                    $academia->tiktok_getree = true;
                    $msg = "O Tiktok foi adicionado ao Getree";
                }
                break;
        }

        $academia->save();

        // switch($request->name)
        return response()->json($msg, 200);
    }

    public function adicionar_getree(Request $request, Academia $academia){
        $getree = new GetreeElemento;
        $getree->academia_id = $academia->id;
        if($request->file("imagem")){
            $getree->imagem = $request->file('imagem')->store(
                'admin/images/getree/'.Str::slug($academia->nome), 'local'
            );
        }

        $getree->titulo = $request->titulo;
        $getree->link = $request->link;
        $getree->posicao = $request->posicao;
        $getree->save();

        toastr()->success("Elemento adicionado ao Getree da " . $academia->nome);
        return redirect()->back()->with("getree", "getree");
    }

    public function salvar_getree(Request $request, GetreeElemento $getree){
        $academia = Academia::find($getree->academia_id);
	    if($request->file("imagem")){
            Storage::delete($getree->imagem);
            $getree->imagem = $request->file('imagem')->store(
                'admin/images/getree/'.Str::slug($academia->nome), 'local'
            );
        }

        $getree->titulo = $request->titulo;
        $getree->link = $request->link;
        $getree->posicao = $request->posicao;
        $getree->save();

        toastr()->success("Elemento salvo com sucesso");
        return redirect()->back()->with("getree", "getree");
    }

    public function remover_getree(GetreeElemento $getree){
        Storage::delete($getree->imagem);
        $getree->delete();
        toastr()->success("Elemento removido com sucesso");
        return redirect()->back()->with("getree", "getree");
    }

    public function relatorio_getree(Academia $academia){
        if(!session()->get("usuario")["admin"] && session()->get("usuario")["academia_id"] != $academia->id){
            toastr()->error("Você não tem permissão para acessar essa página");
            return redirect()->back();
        }
        $dados = array();
        $dados["elementos"] = array();
        $dados["total_visitantes"] = 0;
        $dados["total_acessos"] = 0;
        $dados["total_clicks"] = 0;
        $dados["acessos_com_click"] = 0;
        $dados["clicks_elementos"] = 0;
        $dados["clicks_redes"] = 0;


        foreach($academia->getree as $elemento){
            $dados["elementos"][$elemento->id]["total_clicks"] = 0;
            $dados["elementos"][$elemento->id]["text"] = $elemento->titulo;
        }

        foreach(config("globals.redes") as $codigo => $texto){
            $dados["redes"][$codigo]["total_clicks"] = 0;
            $dados["redes"][$codigo]["text"] = $texto;
        }

        if($academia->acessos){
            $visitantes = $academia->acessos->groupBy("visitante_id");
            foreach($visitantes as $visitante => $acessos){
                $dados["visitantes"][$visitante]["total_acessos"] = 0;
                $dados["total_visitantes"] += 1;
                foreach($acessos as $acesso){
                    $dados["total_acessos"] += 1;
                    $dados["visitantes"][$visitante]["acessos"][] = $acesso; 
                    $dados["visitantes"][$visitante]["total_acessos"] += 1;
                    if($acesso->clicks->count() > 0){
                        $dados["acessos_com_click"] += 1;
                        foreach($acesso->clicks as $click){
                            if($click->elemento){
                                $dados["elementos"][$click->element->id]["total_clicks"] += 1;
                                $dados["clicks_elementos"] += 1;
                            }else{
                                $dados["redes"][$click->tipo_rede]["total_clicks"] += 1;
                                $dados["clicks_redes"] += 1;
                            }
                            $dados["total_clicks"] += 1;
                        }
                    }
                }
            }
        }
        // dd($dados);

        return view("painel.academia.relatorio", [
            "dados" => $dados,
            "academia" => $academia,
        ]);
    }

    public function dashboard_lancamentos(Academia $academia){
        return view("painel.academia.dashboard_anual", ["academia" => $academia]);   
    }

    public function dashboard_lancamentos_calcular(Request $request, Academia $academia){
        $lancamento = DashboardLancamento::where([["data", $request->data . "-01"], ["academia_id", $academia->id]])->first();
        if(!$lancamento){
            $lancamento = new DashboardLancamento;
            $lancamento->data = $request->data . "-01";
            $lancamento->academia_id = $academia->id;
        }

        $lancamento->contrato = $request->contrato;

        $total = 0;
        
        $resultados_administrativo = DashboardResultadoAdministrativo::where([["data", $lancamento->data], ["academia_id", $academia->id]])->first();
        if($resultados_administrativo) $total = $resultados_administrativo->total;

        
        $resultados_tecnico = DashboardResultadoTecnico::where([["data", $lancamento->data], ["academia_id", $academia->id]])->first();
        if($resultados_tecnico) $total += $resultados_tecnico->total;

        $resultados_comercial = DashboardResultadoComercial::where([["data", $lancamento->data], ["academia_id", $academia->id]])->first();
        if($resultados_comercial) $total += $resultados_comercial->total;

        $resultados_marketing = DashboardResultadoMarketing::where([["data", $lancamento->data], ["academia_id", $academia->id]])->first();
        if($resultados_marketing) $total += $resultados_marketing->total;

        $lancamento->mercado = $total;
        $lancamento->save();

        toastr()->success("Lançamento realizado !");
        return redirect()->back();
    }

    // RESULTADOS ADMINISTRATIVOS

    public function dashboard_lancamento_administrativo(Request $request, Academia $academia){
        $lancamento = DashboardResultadoAdministrativo::where([["data", $request->data . "-01"], ["academia_id", $academia->id]])->first();
        if($lancamento){
            toastr()->error("Já existe lançamento para esse período.");
            session()->flash("aba", "administrativo");
            return redirect()->back();
        }
        $lancamento = new DashboardResultadoAdministrativo;
        $lancamento->data = $request->data . "-01";
        $lancamento->academia_id = $academia->id;
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;
        $lancamento->checklist_preco = $request->checklist_preco;
        $lancamento->checklist_quantidade = $request->checklist_quantidade;
        $lancamento->juros = $request->juros;
        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->checklist_preco * $lancamento->checklist_quantidade;
        $total = $total + ($total * $lancamento->juros) / 100;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "administrativo");
        toastr()->success("Lançamento realizado !");
        return redirect()->back();
    }

    public function dashboard_lancamento_administrativo_salvar(Request $request, DashboardResultadoAdministrativo $lancamento){
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;
        $lancamento->checklist_preco = $request->checklist_preco;
        $lancamento->checklist_quantidade = $request->checklist_quantidade;
        $lancamento->juros = $request->juros;
        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->checklist_preco * $lancamento->checklist_quantidade;
        $total = $total + ($total * $lancamento->juros) / 100;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "administrativo");
        toastr()->success("Lançamento salvo !");
        return redirect()->back();
    }

    public function dashboard_lancamento_administrativo_remover(DashboardResultadoAdministrativo $lancamento){
        $lancamento->delete();
        session()->flash("aba", "administrativo");
        toastr()->success("Lançamento removido !");
        return redirect()->back();
    }

    // RESULTADOS TÉCNICOS

    public function dashboard_lancamento_tecnico(Request $request, Academia $academia){
        $lancamento = DashboardResultadoTecnico::where([["data", $request->data . "-01"], ["academia_id", $academia->id]])->first();
        if($lancamento){
            toastr()->error("Já existe lançamento para esse período.");
            session()->flash("aba", "tecnico");
            return redirect()->back();
        }
        $lancamento = new DashboardResultadoTecnico;
        $lancamento->data = $request->data . "-01";
        $lancamento->academia_id = $academia->id;
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;
        $lancamento->programa_resultados_preco = $request->programa_resultados_preco;
        $lancamento->programa_resultados_quantidade = $request->programa_resultados_quantidade;
        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->programa_resultados_preco * $lancamento->programa_resultados_quantidade;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "tecnico");
        toastr()->success("Lançamento realizado !");
        return redirect()->back();
    }

    public function dashboard_lancamento_tecnico_salvar(Request $request, DashboardResultadoTecnico $lancamento){
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;
        $lancamento->programa_resultados_preco = $request->programa_resultados_preco;
        $lancamento->programa_resultados_quantidade = $request->programa_resultados_quantidade;
        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->programa_resultados_preco * $lancamento->programa_resultados_quantidade;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "tecnico");
        toastr()->success("Lançamento salvo !");
        return redirect()->back();
    }

    public function dashboard_lancamento_tecnico_remover(DashboardResultadoTecnico $lancamento){
        $lancamento->delete();
        session()->flash("aba", "tecnico");
        toastr()->success("Lançamento removido !");
        return redirect()->back();
    }

    // RESULTADOS COMERCIAIS

    public function dashboard_lancamento_comercial(Request $request, Academia $academia){
        $lancamento = DashboardResultadoComercial::where([["data", $request->data . "-01"], ["academia_id", $academia->id]])->first();
        if($lancamento){
            toastr()->error("Já existe lançamento para esse período.");
            session()->flash("aba", "comercial");
            return redirect()->back();
        }
        $lancamento = new DashboardResultadoComercial;
        $lancamento->data = $request->data . "-01";
        $lancamento->academia_id = $academia->id;
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;
        $lancamento->precificacao_preco = $request->precificacao_preco;
        $lancamento->precificacao_quantidade = $request->precificacao_quantidade;
        $lancamento->scripts_ligacao_preco = $request->scripts_ligacao_preco;
        $lancamento->scripts_ligacao_quantidade = $request->scripts_ligacao_quantidade;
        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->precificacao_preco * $lancamento->precificacao_quantidade;
        $total += $lancamento->scripts_ligacao_preco * $lancamento->scripts_ligacao_quantidade;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "comercial");
        toastr()->success("Lançamento realizado !");
        return redirect()->back();
    }

    public function dashboard_lancamento_comercial_salvar(Request $request, DashboardResultadoComercial $lancamento){
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;
        $lancamento->precificacao_preco = $request->precificacao_preco;
        $lancamento->precificacao_quantidade = $request->precificacao_quantidade;
        $lancamento->scripts_ligacao_preco = $request->scripts_ligacao_preco;
        $lancamento->scripts_ligacao_quantidade = $request->scripts_ligacao_quantidade;
        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->precificacao_preco * $lancamento->precificacao_quantidade;
        $total += $lancamento->scripts_ligacao_preco * $lancamento->scripts_ligacao_quantidade;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "comercial");
        toastr()->success("Lançamento salvo !");
        return redirect()->back();
    }

    public function dashboard_lancamento_comercial_remover(DashboardResultadoComercial $lancamento){
        $lancamento->delete();
        session()->flash("aba", "comercial");
        toastr()->success("Lançamento removido !");
        return redirect()->back();
    }

    // RESULTADOS MARKETING

    public function dashboard_lancamento_marketing(Request $request, Academia $academia){
        $lancamento = DashboardResultadoMarketing::where([["data", $request->data . "-01"], ["academia_id", $academia->id]])->first();
        if($lancamento){
            toastr()->error("Já existe lançamento para esse período.");
            session()->flash("aba", "marketing");
            return redirect()->back();
        }
        $lancamento = new DashboardResultadoMarketing;
        $lancamento->data = $request->data . "-01";
        $lancamento->academia_id = $academia->id;

        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;

        $lancamento->editorial_preco = $request->editorial_preco;
        $lancamento->editorial_quantidade = $request->editorial_quantidade;

        $lancamento->post_imagem_padrao_preco = $request->post_imagem_padrao_preco;
        $lancamento->post_imagem_padrao_quantidade = $request->post_imagem_padrao_quantidade;

        $lancamento->post_video_padrao_preco = $request->post_video_padrao_preco;
        $lancamento->post_video_padrao_quantidade = $request->post_video_padrao_quantidade;

        $lancamento->post_metodologia_preco = $request->post_metodologia_preco;
        $lancamento->post_metodologia_quantidade = $request->post_metodologia_quantidade;

        $lancamento->post_imagem_personalizado_preco = $request->post_imagem_personalizado_preco;
        $lancamento->post_imagem_personalizado_quantidade = $request->post_imagem_personalizado_quantidade;

        $lancamento->post_video_personalizado_preco = $request->post_video_personalizado_preco;
        $lancamento->post_video_personalizado_quantidade = $request->post_video_personalizado_quantidade;

        $lancamento->artigo_tecnico_preco = $request->artigo_tecnico_preco;
        $lancamento->artigo_tecnico_quantidade = $request->artigo_tecnico_quantidade;

        $lancamento->agendamento_publicacoes_monitoramento_preco = $request->agendamento_publicacoes_monitoramento_preco;
        $lancamento->agendamento_publicacoes_monitoramento_quantidade = $request->agendamento_publicacoes_monitoramento_quantidade;

        $lancamento->campanha_online_preco = $request->campanha_online_preco;
        $lancamento->campanha_online_quantidade = $request->campanha_online_quantidade;

        $lancamento->campanha_offline_preco = $request->campanha_offline_preco;
        $lancamento->campanha_offline_quantidade = $request->campanha_offline_quantidade;

        $lancamento->proposta_ativacao_parceria_preco = $request->proposta_ativacao_parceria_preco;
        $lancamento->proposta_ativacao_parceria_quantidade = $request->proposta_ativacao_parceria_quantidade;

        $lancamento->getree_preco = $request->getree_preco;
        $lancamento->getree_quantidade = $request->getree_quantidade;

        $lancamento->site_institucional_preco = $request->site_institucional_preco;
        $lancamento->site_institucional_quantidade = $request->site_institucional_quantidade;

        $lancamento->pagina_captura_preco = $request->pagina_captura_preco;
        $lancamento->pagina_captura_quantidade = $request->pagina_captura_quantidade;

        $lancamento->email_personalizado_preco = $request->email_personalizado_preco;
        $lancamento->email_personalizado_quantidade = $request->email_personalizado_quantidade;

        $lancamento->guias_manuais_preco = $request->guias_manuais_preco;
        $lancamento->guias_manuais_quantidade = $request->guias_manuais_quantidade;

        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->editorial_preco * $lancamento->editorial_quantidade;
        $total += $lancamento->post_imagem_padrao_preco * $lancamento->post_imagem_padrao_quantidade;
        $total += $lancamento->post_video_padrao_preco * $lancamento->post_video_padrao_quantidade;
        $total += $lancamento->post_metodologia_preco * $lancamento->post_metodologia_quantidade;
        $total += $lancamento->post_imagem_personalizado_preco * $lancamento->post_imagem_personalizado_quantidade;
        $total += $lancamento->post_video_personalizado_preco * $lancamento->post_imagem_padrao_quantidade;
        $total += $lancamento->artigo_tecnico_preco * $lancamento->artigo_tecnico_quantidade;
        $total += $lancamento->campanha_online_preco * $lancamento->campanha_online_quantidade;
        $total += $lancamento->campanha_offline_preco * $lancamento->campanha_offline_quantidade;
        $total += $lancamento->proposta_ativacao_parceria_preco * $lancamento->proposta_ativacao_parceria_quantidade;
        $total += $lancamento->getree_preco * $lancamento->getree_quantidade;
        $total += $lancamento->site_institucional_preco * $lancamento->site_institucional_quantidade;
        $total += $lancamento->pagina_captura_preco * $lancamento->pagina_captura_quantidade;
        $total += $lancamento->email_personalizado_preco * $lancamento->email_personalizado_quantidade;
        $total += $lancamento->guias_manuais_preco * $lancamento->guias_manuais_quantidade;

        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "marketing");
        toastr()->success("Lançamento realizado !");
        return redirect()->back();
    }

    public function dashboard_lancamento_marketing_salvar(Request $request, DashboardResultadoMarketing $lancamento){
        $lancamento->jornada_mentoria_preco = $request->jornada_mentoria_preco;
        $lancamento->jornada_mentoria_quantidade = $request->jornada_mentoria_quantidade;

        $lancamento->editorial_preco = $request->editorial_preco;
        $lancamento->editorial_quantidade = $request->editorial_quantidade;

        $lancamento->post_imagem_padrao_preco = $request->post_imagem_padrao_preco;
        $lancamento->post_imagem_padrao_quantidade = $request->post_imagem_padrao_quantidade;

        $lancamento->post_video_padrao_preco = $request->post_video_padrao_preco;
        $lancamento->post_video_padrao_quantidade = $request->post_video_padrao_quantidade;

        $lancamento->post_metodologia_preco = $request->post_metodologia_preco;
        $lancamento->post_metodologia_quantidade = $request->post_metodologia_quantidade;

        $lancamento->post_imagem_personalizado_preco = $request->post_imagem_personalizado_preco;
        $lancamento->post_imagem_personalizado_quantidade = $request->post_imagem_personalizado_quantidade;

        $lancamento->post_video_personalizado_preco = $request->post_video_personalizado_preco;
        $lancamento->post_video_personalizado_quantidade = $request->post_video_personalizado_quantidade;

        $lancamento->artigo_tecnico_preco = $request->artigo_tecnico_preco;
        $lancamento->artigo_tecnico_quantidade = $request->artigo_tecnico_quantidade;
        
        $lancamento->agendamento_publicacoes_monitoramento_preco = $request->agendamento_publicacoes_monitoramento_preco;
        $lancamento->agendamento_publicacoes_monitoramento_quantidade = $request->agendamento_publicacoes_monitoramento_quantidade;

        $lancamento->campanha_online_preco = $request->campanha_online_preco;
        $lancamento->campanha_online_quantidade = $request->campanha_online_quantidade;

        $lancamento->campanha_offline_preco = $request->campanha_offline_preco;
        $lancamento->campanha_offline_quantidade = $request->campanha_offline_quantidade;

        $lancamento->proposta_ativacao_parceria_preco = $request->proposta_ativacao_parceria_preco;
        $lancamento->proposta_ativacao_parceria_quantidade = $request->proposta_ativacao_parceria_quantidade;

        $lancamento->getree_preco = $request->getree_preco;
        $lancamento->getree_quantidade = $request->getree_quantidade;

        $lancamento->site_institucional_preco = $request->site_institucional_preco;
        $lancamento->site_institucional_quantidade = $request->site_institucional_quantidade;

        $lancamento->pagina_captura_preco = $request->pagina_captura_preco;
        $lancamento->pagina_captura_quantidade = $request->pagina_captura_quantidade;

        $lancamento->email_personalizado_preco = $request->email_personalizado_preco;
        $lancamento->email_personalizado_quantidade = $request->email_personalizado_quantidade;

        $lancamento->guias_manuais_preco = $request->guias_manuais_preco;
        $lancamento->guias_manuais_quantidade = $request->guias_manuais_quantidade;

        $total = $lancamento->jornada_mentoria_preco * $lancamento->jornada_mentoria_quantidade;
        $total += $lancamento->editorial_preco * $lancamento->editorial_quantidade;
        $total += $lancamento->post_imagem_padrao_preco * $lancamento->post_imagem_padrao_quantidade;
        $total += $lancamento->post_video_padrao_preco * $lancamento->post_video_padrao_quantidade;
        $total += $lancamento->post_metodologia_preco * $lancamento->post_metodologia_quantidade;
        $total += $lancamento->post_imagem_personalizado_preco * $lancamento->post_imagem_personalizado_quantidade;
        $total += $lancamento->post_video_personalizado_preco * $lancamento->post_imagem_padrao_quantidade;
        $total += $lancamento->artigo_tecnico_preco * $lancamento->artigo_tecnico_quantidade;
        $total += $lancamento->campanha_online_preco * $lancamento->campanha_online_quantidade;
        $total += $lancamento->campanha_offline_preco * $lancamento->campanha_offline_quantidade;
        $total += $lancamento->proposta_ativacao_parceria_preco * $lancamento->proposta_ativacao_parceria_quantidade;
        $total += $lancamento->getree_preco * $lancamento->getree_quantidade;
        $total += $lancamento->site_institucional_preco * $lancamento->site_institucional_quantidade;
        $total += $lancamento->pagina_captura_preco * $lancamento->pagina_captura_quantidade;
        $total += $lancamento->email_personalizado_preco * $lancamento->email_personalizado_quantidade;
        $total += $lancamento->guias_manuais_preco * $lancamento->guias_manuais_quantidade;
        $lancamento->total = $total;
        $lancamento->save();
        session()->flash("aba", "marketing");
        toastr()->success("Lançamento salvo !");
        return redirect()->back();
    }

    public function dashboard_lancamento_marketing_remover(DashboardResultadoMarketing $lancamento){
        $lancamento->delete();
        session()->flash("aba", "marketing");
        toastr()->success("Lançamento removido !");
        return redirect()->back();
    }
}
