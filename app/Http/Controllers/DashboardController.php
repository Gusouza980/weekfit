<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academia;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function checklist(){
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
        $departamentos = [];
        $departamentos["total_atividades"] = 0;
        $departamentos["total_atividades_completas"] = 0;
        for($i = 0; $i < 4; $i++){
            $departamentos[$i]["total_atividades"] = 0;
            $departamentos[$i]["total_atividades_completas"] = 0;
            $grupos = Grupo::where("departamento", $i)->get();
            foreach($grupos as $grupo){
                $departamentos[$i][$grupo->nome]["total_atividades"] = 0;
                $departamentos[$i][$grupo->nome]["total_atividades_completas"] = 0;
                $subgrupos = $grupo->subgrupos;
                foreach($subgrupos as $subgrupo){
                    $departamentos[$i][$grupo->nome][$subgrupo->nome]["total_atividades"] = 0;
                    $departamentos[$i][$grupo->nome][$subgrupo->nome]["total_atividades_completas"] = 0;
                    foreach($academia->atividades->where("ativo", 1)->where("subgrupo_id", $subgrupo->id) as $atividade){
                        if($atividade->atividade->nivel <= $academia->nivel){
                            $departamentos[$i]["total_atividades"] += 1;
                            $departamentos[$i][$grupo->nome]["total_atividades"] += 1;
                            $departamentos[$i][$grupo->nome][$subgrupo->nome]["total_atividades"] += 1;
                            if($atividade->status == 2){
                                $departamentos[$i]["total_atividades_completas"] += 1;
                                $departamentos[$i][$grupo->nome]["total_atividades_completas"] += 1;
                                $departamentos[$i][$grupo->nome][$subgrupo->nome]["total_atividades_completas"] += 1;
                            }
                        }
                    }
                }
            }
            $departamentos["total_atividades"] += $departamentos[$i]["total_atividades"];
            $departamentos["total_atividades_completas"] += $departamentos[$i]["total_atividades_completas"];
        }
        return view("painel.dashboards.checklist", ["academia" => $academia, 'departamentos' => $departamentos]);
    }

    public function jornada(){
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

        $meses = [];
        $meses["total_atividades"] = 0;
        $meses["total_atividades_completas"] = 0;
        $atividades = DB::table("jornada_checks")->join("jornada_atividades", 'jornada_atividades.id', '=', 'jornada_checks.atividade_id')->select("jornada_checks.*", "jornada_atividades.descricao as descricao","jornada_atividades.mes as mes", "jornada_atividades.semana as semana")->where("jornada_checks.academia_id", $academia->id)->get();
        for($i = 0; $i < 7; $i++){
            $meses[$i]["total_atividades"] = 0;
            $meses[$i]["total_atividades_completas"] = 0;
            for($j = 0; $j < 4; $j++){
                $meses[$i][$j]["total_atividades"] = 0;
                $meses[$i][$j]["total_atividades_completas"] = 0;
                foreach($atividades->where("mes", $i + 1)->where("semana", $j + 1) as $atividade){
                    $meses[$i]["total_atividades"] += 1;
                    $meses[$i][$j]["total_atividades"] += 1;
                    if($atividade->completo){
                        $meses[$i]["total_atividades_completas"] += 1;
                        $meses[$i][$j]["total_atividades_completas"] += 1;
                    }
                }
            }
            $meses["total_atividades"] += $meses[$i]["total_atividades"];
            $meses["total_atividades_completas"] += $meses[$i]["total_atividades_completas"];
        }
        return view("painel.dashboards.jornada", ["academia" => $academia, 'meses' => $meses]);
    }
}
