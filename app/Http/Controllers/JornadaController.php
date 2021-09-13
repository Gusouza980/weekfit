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

        $atividades = DB::table("jornada_checks")->join("jornada_atividades", 'jornada_atividades.id', '=', 'jornada_checks.atividade_id')->select("jornada_checks.*", "jornada_atividades.importancia as importancia", "jornada_atividades.titulo as titulo" , "jornada_atividades.descricao as descricao", "jornada_atividades.departamento as departamento", "jornada_atividades.responsavel as responsavel", "jornada_atividades.mes as mes", "jornada_atividades.semana as semana", "jornada_atividades.link as link", "jornada_atividades.texto_link as texto_link", "jornada_atividades.link_material as link_material", "jornada_atividades.texto_link_material as texto_link_material")->get();
        
        return view("painel.jornada.lancamento", ["atividades" => $atividades, "academia" => $academia]);
    }

    public function ativar(Academia $academia){
        $academia->jornada = true;
        $academia->semana_jornada = 1;
        $academia->mes_jornada = 1;
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
        $checks = JornadaCheck::where("academia_id", $academia)->get();
        foreach($checks as $check){
            $check->delete();
        }
        $academia->jornada = false;
        $academia->semana_jornada = 1;
        $academia->mes_jornada = 1;
        $academia->save();
        $academia->jornadas()->delete();
        toastr()->success("Jornada desativada para a academia " . $academia->nome);
        return redirect()->back();
    }

    public function promover(Academia $academia){
        if($academia->semana_jornada < 4){
            $academia->semana_jornada++;
        }else{
            $academia->mes_jornada++;
            $academia->semana_jornada = 1;
        }

        $academia->save();
        toastr()->success("Jornada promovida !");
        return redirect()->back();
    }

    public function rebaixar(Academia $academia){
        if($academia->semana_jornada > 1){
            $academia->semana_jornada--;
        }else{
            $academia->mes_jornada--;
            $academia->semana_jornada = 4;
        }

        $academia->save();
        toastr()->success("Jornada promovida !");
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
        $atividade->titulo = $request->titulo;
        $atividade->descricao = $request->descricao;
        $atividade->texto_link = $request->texto_link;
        $atividade->link = $request->link;
        $atividade->texto_link_material = $request->texto_link_material;
        $atividade->link_material = $request->link_material;
        $atividade->mes = $request->mes;
        $atividade->semana = $request->semana;
        $atividade->departamento = $request->departamento;
        $atividade->responsavel = $request->responsavel;
        if($request->importancia)
            $atividade->importancia = 1;
        else
            $atividade->importancia = 0;
        $atividade->save();
        $academias = Academia::where("jornada", true)->get();
        foreach($academias as $academia){
            $check = new JornadaCheck;
            $check->academia_id = $academia->id;
            $check->atividade_id = $atividade->id;
            $check->save();
        }
        toastr()->success("Atividade criada com sucesso!");
        return redirect()->back();
    }

    public function salvar(Request $request, JornadaAtividade $atividade){
        $atividade->titulo = $request->titulo;
        $atividade->descricao = $request->descricao;
        $atividade->texto_link = $request->texto_link;
        $atividade->link = $request->link;
        $atividade->texto_link_material = $request->texto_link_material;
        $atividade->link_material = $request->link_material;
        $atividade->mes = $request->mes;
        $atividade->semana = $request->semana;
        $atividade->departamento = $request->departamento;
        $atividade->responsavel = $request->responsavel;
        if($request->importancia)
            $atividade->importancia = 1;
        else
            $atividade->importancia = 0;
        $atividade->save();
        toastr()->success("Atividade salva com sucesso!");
        return redirect()->back();
    }

    public function deletar(JornadaAtividade $atividade){
        $academias = Academia::where("jornada", true)->get();
        foreach($academias as $academia){
            $check = JornadaCheck::where([["academia_id", $academia->id], ["atividade_id", $atividade->id]])->first();
            $check->delete();
        }
        $atividade->delete();
        toastr()->success("Atividade removida com sucesso!");
        return redirect()->back();
    }
}
