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
                        <div class="col-xl-6">
                            <h4 class="card-title">{{$video->titulo}}</h4>
                            <p class="card-title-desc">{{$video->subtitulo}}</p>

                            <!-- 16:9 aspect ratio -->
                            <div class="ratio ratio-16x9">
                                {!! \App\Classes\Util::convertYoutube($video->link) !!}
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