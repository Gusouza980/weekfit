<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospeccao;
use App\Models\ProspeccaoNota;
use Illuminate\Support\Facades\DB;

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

    public function dashboard(){
        return view("painel.prospeccoes.dashboard");
    }

    public function quantidade_prospeccoes_status(){
        $quantidade_prospeccoes = Prospeccao::select(DB::raw('count(id) as value'), "status as name")->orderBy("status", "ASC")->groupBy('status')->get();
        foreach($quantidade_prospeccoes as $prospeccao){
            $prospeccao->name = config("prospeccoes.status")[$prospeccao->name];
        }
        return response()->json($quantidade_prospeccoes);
    }

    public function quantidade_prospeccoes_diarias(){
        $quantidade_prospeccoes = Prospeccao::select(DB::raw('count(id) as quantidade'), DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') data"))->where("created_at", ">=", date("Y-m-d", strtotime("- 30 days")))->orderBy("data", "ASC")->groupBy('data')->limit(9)->get();
        foreach($quantidade_prospeccoes as $prospeccao){
            $prospeccao->data = date("d/m", strtotime($prospeccao->data));
        }
        return response()->json($quantidade_prospeccoes);
    }

    public function quantidade_prospeccoes_mensais(){
        $quantidade_prospeccoes = Prospeccao::select(DB::raw('count(id) as quantidade'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') data"))->orderBy("data", "ASC")->groupBy('data')->get();
        foreach($quantidade_prospeccoes as $prospeccao){
            $prospeccao->data = date("m/Y", strtotime($prospeccao->data . "-01"));
        }
        return response()->json($quantidade_prospeccoes);
    }

    public function quantidade_prospeccoes_interacoes_diarias(){
        $quantidade_prospeccoes = ProspeccaoNota::select(DB::raw('count(id) as quantidade'), DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') data"))->orderBy("data", "ASC")->groupBy('data')->get();
        foreach($quantidade_prospeccoes as $prospeccao){
            $prospeccao->data = date("d/m", strtotime($prospeccao->data));
        }
        return response()->json($quantidade_prospeccoes);
    }

    public function quantidade_prospeccoes_interacoes_mensais(){
        $quantidade_prospeccoes = ProspeccaoNota::select(DB::raw('count(id) as quantidade'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') data"))->orderBy("data", "ASC")->groupBy('data')->get();
        foreach($quantidade_prospeccoes as $prospeccao){
            $prospeccao->data = date("m/Y", strtotime($prospeccao->data . "-01"));
        }
        return response()->json($quantidade_prospeccoes);
    }
}
