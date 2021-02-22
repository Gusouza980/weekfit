<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $academia->facebook = $request->facebook;
        $academia->linkedin = $request->linkedin;
        $academia->instagram = $request->instagram;
        $academia->pinterest = $request->pinterest;
        $academia->youtube = $request->youtube;
        $academia->google_negocio = $request->google_negocio;

        $academia->save();

        $atividades = Atividade::all();

        foreach($atividades as $atividade){
            $atividade_academia = new AtividadeAcademia;
            $atividade_academia->academia_id = $academia->id;
            $atividade_academia->atividade_id = $atividade->id;
            $atividade_academia->save();
        }

        $usuario = new Usuario;

        $usuario->nome = $request->nome_proprietario;
        $usuario->email = $request->email_proprietario;
        $usuario->telefone = $request->telefone_proprietario;
        $usuario->usuario = $request->usuario_proprietario;
        $usuario->senha = Hash::make('12345');
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
        $academia->facebook = $request->facebook;
        $academia->linkedin = $request->linkedin;
        $academia->instagram = $request->instagram;
        $academia->pinterest = $request->pinterest;
        $academia->youtube = $request->youtube;
        $academia->google_negocio = $request->google_negocio;

        $academia->save();


        $usuario = $academia->proprietario[0];

        $usuario->nome = $request->nome_proprietario;
        $usuario->email = $request->email_proprietario;
        $usuario->telefone = $request->telefone_proprietario;
        $usuario->usuario = $request->usuario_proprietario;
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
        $usuario->senha = Hash::make('12345');
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
}
