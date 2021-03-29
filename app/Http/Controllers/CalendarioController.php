<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Intervencao;

class CalendarioController extends Controller
{
    //
    public function teste(){
        $time = "1616783100919";
        $time = strtotime("Fri Mar 26 2021 21:31:11 GMT+0300 (GMT+03:00)".' UTC');
        $dateInLocal = date("Y-m-d H:i:s", $time);
        // $date = new DateTime("Fri Mar 26 2021 21:31:11 GMT+0300 (GMT+03:00)");
        dd($dateInLocal);
        echo date("Y-m-d H:i", $time);
    }
    public function intervencoes(){
        if(session()->get("usuario")["admin"]){
            if(session()->get("academia")){
                $intervencoes = Intervencao::where("academia_id", session()->get("academia"))->get();
                return view("painel.calendario.intervencoes.academia", ["intervencoes" => $intervencoes]);
            }else{
                $intervencoes = Intervencao::all();
                return view("painel.calendario.intervencoes.index", ["intervencoes" => $intervencoes]);
            }
        }else{
            $intervencoes = Intervencao::where("academia_id", session()->get("usuario")["academia_id"])->get();
            return view("painel.calendario.intervencoes.academia", ["intervencoes" => $intervencoes]);
        }
        
    }

    public function todas_intervencoes(){
        $intervencoes = Intervencao::all();
        return response()->json($intervencoes->toJson());
    }

    public function salvar_intervencao(Request $request){
        if($request->identificador){
            $intervencao = Intervencao::find($request->identificador);
        }else{
            $intervencao = new Intervencao;
        }
        $intervencao->assunto = $request->assunto;
        $intervencao->identificador = "0";
        $intervencao->academia_id = $request->academia;
        $intervencao->observacao = $request->observacao;
        $data_inicio = explode(" ", $request->inicio)[0];
        $hora_inicio = explode(" ", $request->inicio)[1];
        $data_inicio = explode("/", $data_inicio);
        $data_inicio = $data_inicio[2] . "/" . $data_inicio[1] . "/" . $data_inicio[0];
        $data_fim = explode(" ", $request->fim)[0];
        $hora_fim = explode(" ", $request->fim)[1];
        $data_fim = explode("/", $data_fim);
        $data_fim = $data_fim[2] . "/" . $data_fim[1] . "/" . $data_fim[0];
        $intervencao->inicio = $data_inicio . " " . $hora_inicio;
        $intervencao->fim = $data_fim . " " . $hora_fim;
        $intervencao->situacao = $request->situacao;
        $intervencao->usuario = session()->get("usuario")["nome"];
        $intervencao->save();
        return redirect()->back();
    }

    public function remover_intervencao(Intervencao $intervencao){
        $intervencao->delete();
        return redirect()->back();
    }
}
