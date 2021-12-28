<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideosController extends Controller
{
    //
    public function consultar(){
        $videos = Video::all();
        return view("painel.videos.consultar", ["videos" => $videos]);
    }

    public function cadastro(){
        return view("painel.videos.cadastro");
    }

    public function cadastrar(Request $request){
        $video = new Video;
        $video->titulo = $request->titulo;
        $video->subtitulo = $request->subtitulo;
        $video->categoria = $request->categoria;
        $video->link = $request->link;
        $video->save();
        toastr()->success("Vídeo salvo com sucesso!");
        return redirect()->route("painel.videos");
    }

    public function editar(Video $video){
        return view("painel.videos.edicao", ["video" => $video]);
    }

    public function salvar(Request $request, Video $video){
        $video->titulo = $request->titulo;
        $video->subtitulo = $request->subtitulo;
        $video->categoria = $request->categoria;
        $video->link = $request->link;
        $video->save();
        toastr()->success("Vídeo salvo com sucesso!");
        return redirect()->route("painel.videos");
    }

    public function deletar(Video $video){
        $video->delete();
        toastr()->success("Vídeo removido com sucesso!");
        return redirect()->back();
    }

    public function exibir($slug){
        $codigo = config("videos.slug_codigo")[$slug];
        $videos = Video::where("categoria", $codigo)->get();
        return view("painel.videos.exibir", ["videos" => $videos]);
    }
}
