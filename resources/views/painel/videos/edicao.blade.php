@extends('painel.template.main')

@section('titulo')
    Edição de Vídeo
@endsection

@section('conteudo')

@include('painel.includes.errors')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-left my-3" style="color:red;">
                        * Campos obrigatórios
                    </div>
                </div>
                <form action="{{route('painel.video.salvar', ['video' => $video])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-lg-6">
                            <label for="titulo">Título *</label>
                            <input type="text" class="form-control" name="titulo"
                                id="titulo" maxlength="250" value="{{$video->titulo}}" required>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="subtitulo">Subtitulo</label>
                            <input type="text" class="form-control" value="{{$video->subtitulo}}" name="subtitulo"
                                id="subtitulo">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-6">
                            <label for="link">Link do Vídeo</label>
                            <input type="text" class="form-control" name="link"
                                id="link" maxlength="250" value="{{$video->link}}">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="categoria"
                                class="form-label">Categoria *</label>
                            <select id="categoria" name="categoria"
                                class="form-select">
                                @foreach(config("videos.categorias") as $key => $categoria)
                                    <option value="{{$key}}" @if($video->categoria == $key) selected @endif>{{$categoria}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-primary px-5">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

@livewire('videos.editar.arquivos', ["video" => $video])
@livewire('videos.editar.arquivos.modal-cadastro', ["video" => $video])

@endsection

@section('scripts')
@endsection