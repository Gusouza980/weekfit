<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospeccao;
use App\Models\ProspeccaoNota;

class ProspeccoesController extends Controller
{
    //

    public function consultar(){
        $prospeccoes = Prospeccao::all();
        return view("painel.prospeccoes.consultar", ["prospeccoes" => $prospeccoes]);
    }

    public function cadastro(){
        return view("painel.prospeccoes.cadastro");
    }

    public function cadastrar(Request $request){
        $prospeccao = new Prospeccao;
        $prospeccao->nome = $request->nome;
        $prospeccao->gestor = $request->gestor;
        $prospeccao->contato = $request->contato;
        $prospeccao->email = $request->email;
        $prospeccao->cidade = $request->cidade;
        $prospeccao->estado = $request->estado;
        $prospeccao->save();
        toastr()->success("Prospecção criada com sucesso!");
        return redirect()->route("painel.prospeccao.editar", ["prospeccao" => $prospeccao]);
    }

    public function editar(Prospeccao $prospeccao){
        return view("painel.prospeccoes.edicao", ["prospeccao" => $prospeccao]);
    }

    public function salvar(Request $request, Prospeccao $prospeccao){
        $prospeccao->nome = $request->nome;
        $prospeccao->gestor = $request->gestor;
        $prospeccao->contato = $request->contato;
        $prospeccao->email = $request->email;
        $prospeccao->cidade = $request->cidade;
        $prospeccao->estado = $request->estado;
        $prospeccao->status = $request->status;
        $prospeccao->save();
        toastr()->success("Prospecção criada com sucesso!");
        return redirect()->back();
    }

    public function adicionar_nota(Request $request, Prospeccao $prospeccao){
        $nota = new ProspeccaoNota;
        $nota->prospeccao_id = $prospeccao->id;
        $nota->texto = $request->texto;
        $nota->save();
        toastr()->success("Nota adicionada com sucesso!");
        session()->flash("nota_adicionada", true);
        return redirect()->back();
    }
}
