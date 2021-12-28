@extends('painel.template.main')

@section('titulo')
    Cadastro de Vídeo
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
                <form action="{{route('painel.video.cadastrar')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-lg-6">
                            <label for="titulo">Título *</label>
                            <input type="text" class="form-control" name="titulo"
                                id="titulo" maxlength="250" required>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="subtitulo">Subtitulo</label>
                            <input type="text" class="form-control" name="subtitulo"
                                id="subtitulo">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-6">
                            <label for="link">Link do Vídeo</label>
                            <input type="text" class="form-control" name="link"
                                id="link" maxlength="250">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="categoria"
                                class="form-label">Categoria *</label>
                            <select id="categoria" name="categoria"
                                class="form-select">
                                @foreach(config("videos.categorias") as $key => $categoria)
                                    <option value="{{$key}}">{{$categoria}}</option>
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
<!-- end row -->
@endsection

@section('scripts')
@endsection