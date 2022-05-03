<?php

namespace App\Http\Livewire\Videos\Editar\Arquivos;

use Livewire\Component;
use App\Models\Video;
use App\Models\VideoArquivo;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Classes\Util;

class ModalCadastro extends Component
{
    use WithFileUploads;

    public $arquivo_id;
    public $caminho;
    public $nome;
    public $tipo;
    public $video;

    protected $listeners = ["carregaModalCadastroArquivos", "carregaModalEdicaoArquivos"];

    public function carregaModalCadastroArquivos(){
        $this->resetar();
        $this->dispatchBrowserEvent("abreModalCadastroArquivos");
    }

    public function carregaModalEdicaoArquivos(VideoArquivo $arquivo){
        $this->arquivo_id = $arquivo->id;
        $this->nome = $arquivo->nome;
        $this->tipo = $arquivo->tipo;
        $this->dispatchBrowserEvent("abreModalCadastroArquivos");
    }

    public function salvar(){
        if($this->arquivo_id){
            $arquivo = VideoArquivo::find($this->arquivo_id);
        }else{
            $arquivo = new VideoArquivo;
            $arquivo->video_id = $this->video->id;
        }

        $arquivo->nome = $this->nome;
        $arquivo->tipo = $this->tipo;
        
        if($this->caminho){
            Storage::delete($arquivo->caminho);
            $arquivo->caminho = $this->caminho->store("admin/documentos/", 'local');
            Util::limparLivewireTemp();
        }

        $arquivo->save();
        $this->dispatchBrowserEvent("fechaModalCadastroArquivos");
        $this->emit("atualizaDatatableArquivos");
    }

    public function mount(Video $video){
        $this->video = $video;
    }

    public function resetar(){
        $this->arquivo_id = null;
        $this->caminho = null;
        $this->nome = null;
        $this->tipo = 0;
    }

    public function render()
    {
        return view('livewire.videos.editar.arquivos.modal-cadastro');
    }
}
