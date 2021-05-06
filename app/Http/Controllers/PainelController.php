<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class PainelController extends Controller
{
    //

    public function index(){
        return view("painel.index");
    }

    public function login(){
        if(session()->get("usuario")){
            return redirect()->route("painel.index");
        }
        return view("painel.login");
    }

    public function logar(Request $request){
        $usuario = Usuario::where("usuario", $request->usuario)->first();
        
        if($usuario){
            if($usuario->academia && $usuario->academia->ativo == false){
                toastr()->error("Sua academia não está ativa no sistema. Por favor, entre em contato com os administradres!");
                return redirect()->back();
            }
            if(Hash::check($request->senha, $usuario->senha)){
                session()->put(["usuario" => $usuario->toArray()]);
                Log::channel('acessos')->info('<b>LOGIN</b>: O usuario <b>' . $usuario->usuario . '</b> logou no sistema.');
                return redirect()->route("painel.index");
            }else{
                toastr()->error("Informações de usuário incorretas!");
            }
        }else{
            toastr()->error("Informações de usuário incorretas!");
        }

        return redirect()->back();
    }

    public function dados(){
        return view("painel.dados");
    }

    public function sair(){
        Log::channel('acessos')->info('<b>SAIDA</b>: O usuario <b>' . session()->get("usuario")["usuario"] . '</b> saiu do sistema.');
        session()->forget("usuario");
        return redirect()->route("painel.login");
    }
    
}
