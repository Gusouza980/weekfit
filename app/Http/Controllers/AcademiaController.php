<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Academia;
use App\Models\Usuario;
use App\Models\Atividade;
use App\Models\AtividadeAcademia;

class AcademiaController extends Controller
{
    //

    public function index(){
        $academias = Academia::all();
        return view("painel.academia.consultar", ["academias" => $academias]);
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
            'email_proprietario' => 'unique:usuarios,email',
            'usuario_proprietario' => 'unique:usuarios,usuario',
            'email' => 'unique:academias,email',
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

        if($request->file("logo")){
            $academia->logo = $request->file('logo')->store(
                'admin/images/logos/'.Str::slug($academia->nome), 'local'
            );
        }

        $academia->save();

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
        $usuario->senha = Hash::make($request->senha);
        $usuario->academia_id = $academia->id;
        $usuario->departamento = 100;
        $usuario->lider = true;
        $usuario->acesso = 0;
        $usuario->save();

        toastr()->success("Academia cadastrada com sucesso!");
        return redirect()->back();
    }

    public function salvar(Request $request, Academia $academia){

        $request->validate([
            'email_proprietario' => 'unique:usuarios,email,'.$academia->proprietario[0]->id,
            'usuario_proprietario' => 'unique:usuarios,usuario,'.$academia->proprietario[0]->id,
            'email' => 'unique:academias,email,'.$academia->id,
        ]);

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

        if($request->file("logo")){
            Storage::delete($academia->logo);
            $academia->logo = $request->file('logo')->store(
                'admin/images/logos/'.Str::slug($academia->nome), 'local'
            );
        }

        $academia->save();


        $usuario = $academia->proprietario[0];

        $usuario->nome = $request->nome_proprietario;
        $usuario->email = $request->email_proprietario;
        $usuario->telefone = $request->telefone_proprietario;
        $usuario->usuario = $request->usuario_proprietario;
        if($request->senha){
            $usuario->senha = Hash::make($request->senha_proprietario);
        }
        $usuario->save();

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
        $academias = Academia::all();
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
}
