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
            <div class="card-body">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#mes1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 1</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($atividades->where('mes', '=', 1)->where('completo', false)->count() > 0) disabled @endif" data-bs-toggle="tab" href="#mes2" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 2</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($atividades->where('mes', '=', 2)->where('completo', false)->count() > 0) disabled @endif" data-bs-toggle="tab" href="#mes3" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 3</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($atividades->where('mes', '=', 3)->where('completo', false)->count() > 0) disabled @endif" data-bs-toggle="tab" href="#mes4" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 4</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($atividades->where('mes', '=', 4)->where('completo', false)->count() > 0) disabled @endif" data-bs-toggle="tab" href="#mes5" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 5</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($atividades->where('mes', '=', 5)->where('completo', false)->count() > 0) disabled @endif" data-bs-toggle="tab" href="#mes6" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 6</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($atividades->where('mes', '=', 6)->where('completo', false)->count() > 0) disabled @endif" data-bs-toggle="tab" href="#mes7" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 7</span>    
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content p-3 text-muted">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="tab-pane @if($i == 1) active @endif" id="mes{{$i}}" role="tabpanel" style="overflow-x: scroll;">
                            
                            @for($j = 1; $j <= 4; $j++)
                                @if(($academia->mes_jornada . $academia->semana_jornada) >= ($i . $j))
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <h5>Semana {{$j}}</h5>
                                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Dep.</th>
                                                        <th>Descrição</th>
                                                        <th>Responsável</th>
                                                        <th width="130">Completar</th>
                                                    </tr>
                                                </thead>


                                                <tbody>

                                                    @foreach($atividades->where("mes", $i)->where("semana", $j) as $atividade)
                                                        <tr>
                                                            <td>
                                                                {{config("globals.departamentos")[$atividade->departamento]}}
                                                            </td>
                                                            <td>
                                                                {{$atividade->descricao}} 
                                                                <span class="input-atividade ml-3">
                                                                    @if($atividade->link)
                                                                        {!! " <a class='ml-2' target='_blank' href='" . $atividade->link . "'> " . $atividade->texto_link . " </a>" !!}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td>
                                                                {{config("globals.responsaveis")[$atividade->responsavel]}}
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                                                    <input class="form-check-input completar_atividade" type="checkbox" aid="{{$atividade->id}}" @if($atividade->completo) checked @endif>
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
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
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