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
        $intervencoes = Intervencao::all();
        return view("painel.calendario.intervencoes.index", ["intervencoes" => $intervencoes]);
    }

    public function todas_intervencoes(){
        $intervencoes = Intervencao::all();
        return response()->json($intervencoes->toJson());
    }

    public function nova_intervencao(Request $request){
        $intervencao = new Intervencao;
        $intervencao->assunto = $request->assunto;
        $intervencao->identificador = $request->identificador;
        $intervencao->observacao = $request->observacao;
        $intervencao->inicio = $request->inicio;
        $intervencao->fim = $request->fim;
        $intervencao->situacao = $request->situacao;
        $intervencao->save();
        return response()->json("sucesso");
    }

    public function atualizar_intervencao(Request $request, $identificador){
        $intervencao = Intervencao::where("identificador", $identificador)->first();
        if($request->assunto){
            $intervencao->assunto = $request->assunto;
        }
        if($request->inicio){
            $intervencao->inicio = $request->inicio;
        }
        if($request->fim){
            $intervencao->fim = $request->fim;
        }
        if($request->situacao){
            $intervencao->situacao = $request->situacao;
        }
        $intervencao->save();
        return response()->json("sucesso");
    }

    public function remover_intervencao($identificador){
        $intervencao = Intervencao::where("identificador", $identificador)->first();
        $intervencao->delete();
        return response()->json("sucesso");
    }
}
