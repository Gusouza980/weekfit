<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academia;
use App\Models\Grupo;

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
}
