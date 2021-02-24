<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GruposController extends Controller
{
    //
    public function index(){
        $grupos = Grupo::all();
        return view("painel.configuracoes.atividades.grupos", ['grupos' => $grupos]);
    }

    public function salvar(Request $request, Grupo $grupo){
        $grupo->nome = $request->nome;
        $grupo->departamento = $request->departamento;
        $grupo->save();
        toastr()->success("Alterações salvas com sucesso!");
        return redirect()->back();
    }
}
