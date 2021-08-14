<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JornadaAtividade;
use App\Models\JornadaCheck;
use App\Models\Academia;
use Illuminate\Support\Facades\DB;

class JornadaController extends Controller
{
    //

    public function atividades(){
        $atividades = JornadaAtividade::all();
        return view("painel.jornada.listagem", ["atividades" => $atividades]);
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

        $atividades = DB::table("jornada_checks")->join("jornada_atividades", 'jornada_atividades.id', '=', 'jornada_checks.atividade_id')->select("jornada_checks.*", "jornada_atividades.descricao as descricao","jornada_atividades.mes as mes", "jornada_atividades.semana as semana")->get();
        $cont = $atividades->where("mes", "=", 2)->count();
        // dd($cont);
        
        return view("painel.jornada.lancamento", ["atividades" => $atividades]);
    }

    public function ativar(Academia $academia){
        $academia->jornada = true;
        $academia->save();
        foreach(JornadaAtividade::all() as $atividade){
            $check = new JornadaCheck;
            $check->academia_id = $academia->id;
            $check->atividade_id = $atividade->id;
            $check->save();
        }
        toastr()->success("Jornada ativada para a academia " . $academia->nome);
        return redirect()->back();
    }

    public function desativar(Academia $academia){
        $academia->jornada = false;
        $academia->save();
        $academia->jornadas()->delete();
        toastr()->success("Jornada desativada para a academia " . $academia->nome);
        return redirect()->back();
    }

    public function completar(JornadaCheck $atividade){
        if($atividade->completo){
            $atividade->completo = false;
            $msg = 'Status alterado para pendente';
        }else{
            $atividade->completo = true;
            $msg = 'Status alterado para completo';
        }

        $atividade->save();
        return response()->json($msg, 200);
    }

    public function cadastrar(Request $request){
        $atividade = new JornadaAtividade;
        $atividade->descricao = $request->descricao;
        $atividade->mes = $request->mes;
        $atividade->semana = $request->semana;
        $atividade->save();
        toastr()->success("Atividade criada com sucesso!");
        return redirect()->back();
    }

    public function salvar(Request $request, JornadaAtividade $atividade){
        $atividade->descricao = $request->descricao;
        $atividade->mes = $request->mes;
        $atividade->semana = $request->semana;
        $atividade->save();
        toastr()->success("Atividade salva com sucesso!");
        return redirect()->back();
    }

    public function deletar(JornadaAtividade $atividade){
        $atividade->delete();
        toastr()->success("Atividade removida com sucesso!");
        return redirect()->back();
    }
}
