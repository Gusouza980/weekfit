@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('titulo')
    Lançamento de Atividades
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#atividades" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Aberta</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#finalizadas" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Finalizada</span>
                            </a>
                        </li>    
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content py-3 px-0 text-muted">
                        <div class="tab-pane active" id="atividades" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            @foreach (config('globals.departamentos') as $key => $departamento)
                                                @if($key != 100)
                                                    <a class="nav-link mb-2 @if ($key==0) active @endif"
                                                        id="v-pills-atividades-departamento-{{ $key }}-tab"
                                                        data-bs-toggle="pill"
                                                        href="#v-pills-atividades-departamento-{{ $key }}" role="tab"
                                                        aria-controls="v-pills-atividades-departamento-{{ $key }}"
                                                        aria-selected="true">{{ $departamento }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                            @foreach (config('globals.departamentos') as $key => $departamento)
                                                <div class="tab-pane fade show @if ($key==0) active @endif"
                                                    id="v-pills-atividades-departamento-{{ $key }}"
                                                    role="tabpanel"
                                                    aria-labelledby="v-pills-atividades-departamento-{{ $key }}-tab">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="accordion" id="accordion0">
                                                                @foreach (\App\Models\Grupo::where('departamento', $key)->get() as $grupo)
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button
                                                                                class="accordion-button fw-medium collapsed"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#{{ \Illuminate\Support\Str::slug($grupo->nome) }}"
                                                                                aria-expanded="true"
                                                                                aria-controls="{{ \Illuminate\Support\Str::slug($grupo->nome) }}">
                                                                                {{ $grupo->nome }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="{{ \Illuminate\Support\Str::slug($grupo->nome) }}"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#accordion0">
                                                                            <div class="accordion-body">
                                                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                                                    <h6 class="mt-4">
                                                                                        <b>{{ $subgrupo->nome }}</b></h6>
                                                                                    <div class="row my-3 div-subgrupos" subgrupo="{{$subgrupo->id}}">
                                                                                        @foreach ($academia->atividades->where("status", "<", 2)->where("subgrupo_id", $subgrupo->id) as $atividade)
                                                                                            <div class="col-12 mt-2 div-atividade" atividade="{{$atividade->id}}">
                                                                                                <div class="row">
                                                                                                    <div class="col-3 d-flex align-items-center">
                                                                                                        <select class="form-select form-select-sm select-atividade" atividade="{{$atividade->id}}" subgrupo="{{$subgrupo->id}}" tab="0">
                                                                                                            <option value="0" @if($atividade->status == 0) selected="true" @endif>Aberto</option>
                                                                                                            <option value="1" @if($atividade->status == 1) selected="true" @endif>Em Andamento</option>
                                                                                                            <option value="2" @if($atividade->status == 2) selected="true" @endif>Concluído</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-9 d-flex align-items-center">
                                                                                                        <div class="d-flex flex-row">
                                                                                                            <div>
                                                                                                                <span style="color: {{config('globals.importancia')[$atividade->atividade->importancia]}}">{!! $atividade->atividade->nome !!}</span>
                                                                                                            </div>
                                                                                                            <div class="px-2">
                                                                                                                <span class="input-atividade">
                                                                                                                    @if($atividade->atividade->link)
                                                                                                                        {!! " <a class='ml-2' target='_blank' href='" . $atividade->atividade->link . "'> " . $atividade_academia->atividade->texto_link . " </a>" !!}
                                                                                                                    @endif
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        
                                                                                                    </div>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="finalizadas" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            @foreach (config('globals.departamentos') as $key => $departamento)
                                                <a class="nav-link mb-2 @if ($key==0) active @endif"
                                                    id="v-pills-finalizadas-departamento-{{ $key }}-tab"
                                                    data-bs-toggle="pill"
                                                    href="#v-pills-finalizadas-departamento-{{ $key }}" role="tab"
                                                    aria-controls="v-pills-finalizadas-departamento-{{ $key }}"
                                                    aria-selected="true">{{ $departamento }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                            @foreach (config('globals.departamentos') as $key => $departamento)
                                                <div class="tab-pane fade show @if ($key==0) active @endif"
                                                    id="v-pills-finalizadas-departamento-{{ $key }}"
                                                    role="tabpanel"
                                                    aria-labelledby="v-pills-finalizadas-departamento-{{ $key }}-tab">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="accordion" id="accordion0">
                                                                @foreach (\App\Models\Grupo::where('departamento', $key)->get() as $grupo)
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button
                                                                                class="accordion-button fw-medium collapsed"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#{{ \Illuminate\Support\Str::slug($grupo->nome) }}"
                                                                                aria-expanded="true"
                                                                                aria-controls="{{ \Illuminate\Support\Str::slug($grupo->nome) }}">
                                                                                {{ $grupo->nome }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="{{ \Illuminate\Support\Str::slug($grupo->nome) }}"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#accordion0">
                                                                            <div class="accordion-body">
                                                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                                                    <h6 class="mt-4">
                                                                                        <b>{{ $subgrupo->nome }}</b></h6>
                                                                                    <div class="row my-3 div-subgrupos-finalizados" subgrupo="{{$subgrupo->id}}">
                                                                                        @foreach ($academia->atividades->where("status", "=", 2)->where("subgrupo_id", $subgrupo->id) as $atividade)
                                                                                            <div class="col-12 mt-2 div-atividade-finalizada" atividade="{{$atividade->id}}">
                                                                                                <div class="row">
                                                                                                    <div class="col-3 d-flex align-items-center">
                                                                                                        <select class="form-select form-select-sm select-atividade" atividade="{{$atividade->id}}" subgrupo="{{$subgrupo->id}}" tab="1">
                                                                                                            <option value="0" @if($atividade->status == 0) selected="true" @endif>Aberto</option>
                                                                                                            <option value="1" @if($atividade->status == 1) selected="true" @endif>Em Andamento</option>
                                                                                                            <option value="2" @if($atividade->status == 2) selected="true" @endif>Concluído</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-9 d-flex align-items-center">
                                                                                                        <div class="d-flex flex-row">
                                                                                                            <div>
                                                                                                                <span style="color: {{config('globals.importancia')[$atividade->atividade->importancia]}}">{!! $atividade->atividade->nome !!}</span>
                                                                                                            </div>
                                                                                                            <div class="px-2">
                                                                                                                <span class="input-atividade">
                                                                                                                    @if($atividade->atividade->link)
                                                                                                                        {!! " <a class='ml-2' target='_blank' href='" . $atividade->atividade->link . "'> " . $atividade_academia->atividade->texto_link . " </a>" !!}
                                                                                                                    @endif
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        
                                                                                                    </div>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".select-atividade").change(function(){
                var status = $(this).val();
                var atividade = $(this).attr("atividade");
                var subgrupo = $(this).attr("subgrupo");
                var tab = $(this).attr("tab");
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                var id = $(this).val();
                $.ajax({
                    url: '/dashboard/administracao/atividade/status/trocar/' + atividade,
                    type: 'POST',
                    data: {
                        status: status
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data == "sucesso") {
                            console.log(status);
                            if(status == 2){
                                $(".select-atividade[atividade='"+atividade+"']").attr("tab", 1);
                                $(".div-atividade[atividade='"+atividade+"'").addClass("div-atividade-finalizada");
                                $(".div-atividade[atividade='"+atividade+"'").removeClass("div-atividade");
                                $(".div-atividade-finalizada[atividade='"+atividade+"'").appendTo($(".div-subgrupos-finalizados[subgrupo='"+subgrupo+"']"));
                            }else{
                                if(tab == 1){
                                    $(".select-atividade[atividade='"+atividade+"']").attr("tab", 0);
                                    $(".div-atividade-finalizada[atividade='"+atividade+"'").addClass("div-atividade");
                                    $(".div-atividade-finalizada[atividade='"+atividade+"'").removeClass("div-atividade-finalizada");
                                    $(".div-atividade[atividade='"+atividade+"'").appendTo($(".div-subgrupos[subgrupo='"+subgrupo+"']"));
                                }
                            }
                            toastr.success('Status alterado com sucesso', 'Sucesso', {
                                timeOut: 1000
                            })
                        } else {
                            toastr.success('Erro ao alterar o status da atividade', 'Erro', {
                                timeOut: 3000
                            })
                        }
                    },
                });
            })
        });
    </script>
@endsection
