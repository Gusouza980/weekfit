<?php

namespace App\Http\Livewire\Videos\Editar;

use Livewire\Component;
use App\Models\Video;
use App\Models\VideoArquivo;
use Illuminate\Support\Facades\Storage;

class Arquivos extends Component
{

    public $video;

    protected $listeners = ["atualizaDatatableArquivos" => '$refresh'];

    public function mount(Video $video){
        $this->video = $video;
    }

    public function removerArquivo(VideoArquivo $arquivo){
        Storage::delete($arquivo->caminho);
        $arquivo->delete();
        $this->emit('$refresh');
    }

    public function render()
    {
        $this->video->refresh();
        $arquivos = $this->video->arquivos;
        return view('livewire.videos.editar.arquivos', ["arquivos" => $arquivos]);
    }
}
