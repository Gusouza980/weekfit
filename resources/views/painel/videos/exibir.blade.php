@extends('painel.template.main')

@section('titulo')
@endsection

@section('conteudo')

@include('painel.includes.errors')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach($videos as $video)
                        <div class="col-xl-6 mb-3">
                            <h4 class="card-title">{{$video->titulo}}</h4>
                            <p class="card-title-desc">{{$video->subtitulo}}</p>

                            <!-- 16:9 aspect ratio -->
                            <div class="ratio ratio-16x9">
                                {!! \App\Classes\Util::convertYoutube($video->link) !!}
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="arquivos{{ $video->id }}">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#arquivosCollapse{{ $video->id }}" aria-expanded="true" aria-controls="collapseOne">
                                        Arquivos
                                        </button>
                                    </h2>
                                    <div id="arquivosCollapse{{ $video->id }}" class="accordion-collapse collapse" aria-labelledby="arquivos{{ $video->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="container-fluid">
                                                <div class="d-inline-flex flex-wrap">
                                                    @foreach($video->arquivos as $arquivo)
                                                        <div class="d-flex justify-content-center align-items-center ms-3"><span class="me-2" style="font-size: 18px;">{!! config('documentos.icones')[$arquivo->tipo] !!}</span> <a href="{{ asset($arquivo->caminho) }}" target="_blank">{{ $arquivo->nome }}</a></div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    @endforeach
                    @if($videos->count() == 0)
                        <div class="alert alert-warning text-center mt-3" role="alert">
                            <strong>Ainda não temos vídeos nessa categoria. Fique atento para mais novidades !</strong>
                        </div>
                    @endif
                </div>
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