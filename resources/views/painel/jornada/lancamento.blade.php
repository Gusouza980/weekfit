@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Listagem de Atividades da Jornada
@endsection 

@section('conteudo')
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            @if($academia->jornada)
                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        @for($i = 1; $i <= 7; $i++)
                            <li class="nav-item">
                                <a class="nav-link @if($i == 1) active @endif @if($academia->mes_jornada < $i) disabled @endif" data-bs-toggle="tab" href="#mes{{$i}}" role="tab">
                                    <span class="d-block d-sm-none">{{$i}}</span>
                                    <span class="d-none d-sm-block">Mês {{$i}}</span>    
                                </a>
                            </li>
                        @endfor
                    </ul>
                    <div class="tab-content p-3 text-muted">
                        @for($i = 1; $i <= 7; $i++)
                            <div class="tab-pane @if($i == 1) active @endif" id="mes{{$i}}" role="tabpanel" style="overflow-x: scroll;">
                                
                                @for($j = 1; $j <= 4; $j++)
                                    @if(($academia->mes_jornada . $academia->semana_jornada) >= ($i . $j))
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <h5>Semana {{$j}}</h5>
                                                <table class="table project-list-table align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width: 6%;">Pilar</th>
                                                            <th scope="col" style="width: 39%;">Atividade</th>
                                                            <th class="text-center" scope="col" style="width: 20%;">Vídeo</th>
                                                            <th class="text-center" scope="col" style="width: 20%;">Material</th>
                                                            <th class="text-center" scope="col" style="width: 8%;">Time</th>
                                                            <th class="text-center" scope="col" style="width: 7%;">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-striped">
                                                        @foreach($atividades->where("mes", $i)->where("semana", $j) as $atividade)
                                                            <tr>
                                                                <td><img src="{{asset(config('globals.departamentos_imagens')[$atividade->departamento])}}" width="70" alt=""></td>
                                                                <td>
                                                                    <h5 class="text-truncate font-size-14 text-dark">
                                                                        {{$atividade->titulo}}
                                                                        @if($atividade->importancia > 0)
                                                                            <i class="fas fa-exclamation-triangle" title="Atividade Importante" alt="Atividade Importante" style="color: #ffd700; cursor: pointer;"></i>
                                                                        @endif
                                                                    </h5>
                                                                    <p class="text-muted mb-0">{{$atividade->descricao}}</p>
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($atividade->link)
                                                                        <a href="{{$atividade->link}}" class="btn btn-primary">
                                                                            {{$atividade->texto_link}}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if($atividade->link_material)
                                                                        <a href="{{$atividade->link_material}}" class="btn btn-success">
                                                                            {{$atividade->texto_link_material}}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="mx-auto">
                                                                        <div class="avatar-group-item">
                                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                                <img src="{{asset(config('globals.responsaveis_fotos')[$atividade->responsavel])}}" alt="" class="rounded-circle avatar-xs">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="form-check form-switch form-switch-md mt-2 mx-auto" style="padding-left: 0px; width: 40px;" dir="ltr">
                                                                        <input class="form-check-input completar_atividade" style="left:0px; margin-left: 0px;" type="checkbox" aid="{{$atividade->id}}" @if($atividade->completo) checked @endif>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>    
                                        </div>
                                        <hr>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <strong>Você não possui jornada ativa</strong>
                    </div>
                </div>
            @endif
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
            $(".completar_atividade").change(function(){
                var aid = $(this).attr("aid");
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });  
                $.ajax({
                    url: '/dashboard/administracao/jornada/status/trocar/' + aid,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        toastr.success(data, 'Sucesso')
                    },
                    error: function(){
                        toastr.error('Erro na operação. Atualize a página e tente novamente.', 'Erro')
                    }
                });
            })
        });
    </script> 
@endsection