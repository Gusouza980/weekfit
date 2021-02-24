<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subgrupo;

class SubgruposController extends Controller
{
    //
    public function adicionar(Request $request){
        $subgrupo = new Subgrupo;
        $subgrupo->nome = $request->nome;
        $subgrupo->grupo_id = $request->grupo_id;
        $subgrupo->save();

        toastr()->success("Subgrupo Cadastrado.");
        return redirect()->back();
    }

    public function salvar(Request $request, Subgrupo $subgrupo){
        $subgrupo->nome = $request->nome;
        $subgrupo->grupo_id = $request->grupo_id;
        $subgrupo->save();
        toastr()->success("Alterações salvas.");
        return redirect()->back();
    }

    public function deletar(Subgrupo $subgrupo){
        $subgrupo->delete();
        toastr()->success("Subgrupo removido.");
        return redirect()->back();
    }
}
