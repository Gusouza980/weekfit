<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UsuarioAcademia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->get("usuario")["admin"] || session()->get("academia")){
            return $next($request);
        }else{
            toastr()->error("Você não pode acessar essa página");
            return redirect()->route("painel.index");
        }
        
    }
}
