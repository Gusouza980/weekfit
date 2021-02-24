<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Atividade;
use App\Models\Academia;
use App\Models\AtividadeAcademia;

class AtividadesController extends Controller
{
    //
    public function index(Grupo $grupo){
        return view("painel.configuracoes.atividades.listagem", ["grupo" => $grupo]);
    }

    public function adicionar(Request $request){
        $atividade = new Atividade;
        $atividade->nome = $request->nome;
        $atividade->link = $request->link;
        $atividade->texto_link = $request->texto_link;
        $atividade->subgrupo_id = $request->subgrupo_id;
        $atividade->importancia = $request->importancia;
        $atividade->save();

        foreach(Academia::all() as $academia){
            $nova_atividade = new AtividadeAcademia;
            $nova_atividade->academia_id = $academia->id;
            $nova_atividade->atividade_id = $atividade->id;
            $nova_atividade->save();
        }

        toastr()->success("Atividade Cadastrada.");
        return redirect()->back();
    }

    public function salvar(Request $request, Atividade $atividade){
        $atividade->nome = $request->nome;
        $atividade->link = $request->link;
        $atividade->texto_link = $request->texto_link;
        $atividade->subgrupo_id = $request->subgrupo_id;
        $atividade->importancia = $request->importancia;
        $atividade->save();
        toastr()->success("Alterações salvas.");
        return redirect()->back();
    }

    public function deletar(Atividade $atividade){
        $atividade->delete();
        toastr()->success("Atividade removida.");
        return redirect()->back();
    }
}
