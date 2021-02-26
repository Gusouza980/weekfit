@extends('painel.template.main')

@section('titulo')
    Dados
@endsection

@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="media">
                            <div class="me-3">
                                <img src="{{asset($academia->logo)}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <h5 class="mb-1">{{$academia->nome}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 align-self-center">
                        <div class="text-lg-center mt-4 mt-lg-0">
                            <div class="row">
                                @if($academia->inicio_contrato && $academia->fim_contrato && $academia->inicio_contrato < $academia->fim_contrato)
                                    <div class="col-12 col-lg-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Início do Contrato</p>
                                            <h5 class="mb-0">{{date('d/m/Y', strtotime($academia->inicio_contrato))}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Fim do Contrato</p>
                                            <h5 class="mb-0">{{date('d/m/Y', strtotime($academia->fim_contrato))}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Dias Restantes</p>
                                            @php
                                                $inicio = new DateTime($academia->inicio_contrato);
                                                $fim = new DateTime($academia->fim_contrato);
                                                $dias = date_diff($inicio, $fim);
                                            @endphp
                                            <h5 class="mb-0">{{$dias->format("%a")}}</h5>
                                            
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12 text-center">
                                        Sem contrato ativo
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-5 text-center">
                            <h5 class="font-size-14 mb-n3">Progresso Geral</h5>
                            <div id="gauge-chart" class="e-charts"></div>
                        </div>
                        <div class="col-12 col-lg-7 text-center">
                            <div class="row mt-4">
                                <div class="col-12 col-lg-6">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Administrativo</h5>
                                        <input class="knob" data-width="150" data-fgcolor="{{\Functions::corDepartamento(0)}}" @if($departamentos[0]["total_atividades"] != 0) value="{{number_format(($departamentos[0]["total_atividades_completas"] * 100) / $departamentos[0]["total_atividades"], 1)}}" @else value="0" @endif>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Técnico</h5>
                                        <input class="knob" data-width="150" data-fgcolor="{{\Functions::corDepartamento(1)}}" @if($departamentos[1]["total_atividades"] != 0) value="{{number_format(($departamentos[1]["total_atividades_completas"] * 100) / $departamentos[1]["total_atividades"], 1)}}" @else value="0" @endif>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Comercial</h5>
                                        <input class="knob" data-width="150" data-fgcolor="{{\Functions::corDepartamento(2)}}" @if($departamentos[2]["total_atividades"] != 0) value="{{number_format(($departamentos[2]["total_atividades_completas"] * 100) / $departamentos[2]["total_atividades"], 1)}}" @else value="0" @endif>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Marketing</h5>
                                        <input class="knob" data-width="150" data-fgcolor="{{\Functions::corDepartamento(3)}}" @if($departamentos[3]["total_atividades"] != 0) value="{{number_format(($departamentos[3]["total_atividades_completas"] * 100) / $departamentos[3]["total_atividades"], 1)}}" @else value="0" @endif>
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
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Progresso por Grupos</h4>
                <hr>
                @for($i = 0; $i < 4; $i++)
                    <h5>{{config("globals.departamentos")[$i]}}</h5>
                    <div class="row mt-4">
                        @foreach(\App\Models\Grupo::where("departamento", $i)->get() as $grupo)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="text-center" dir="ltr">
                                    <h5 class="font-size-14 mb-3">{{$grupo->nome}}</h5>
                                    <input class="knob" data-width="150" data-fgcolor="{{\Functions::corDepartamento($i)}}" @if($departamentos[$i][$grupo->nome]["total_atividades"] != 0) value="{{number_format(($departamentos[$i][$grupo->nome]["total_atividades_completas"] * 100) / $departamentos[$i][$grupo->nome]["total_atividades"], 1)}}" @else value="0" @endif>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- end row -->
@endsection

@section('scripts')
    <!-- echarts js -->
    <script src="{{asset('admin/libs/echarts/echarts.min.js')}}"></script>
    <!-- echarts init -->
    <script>
        dom = document.getElementById("gauge-chart"), myChart = echarts.init(dom), app = {};
        option = null, option = {
            tooltip: { formatter: "{a} <br/>{b} : {c}%" },
            series: [{
                name: "Completo",
                type: "gauge",
                detail: { formatter: "{value}%" },
                axisLine: {
                    lineStyle: {
                        color: [
                            [0.3, "#f46a6a"],
                            [.7, "#f8ed62"],
                            [1, "#34c38f"],
                        ],
                        width: 20
                    }
                },
                splitLine: {
                    distance: -30,
                    length: 20,
                    lineStyle: {
                        color: '#fff',
                        width: 4
                    }
                },
                data: [{ value: "{!! number_format(($departamentos['total_atividades_completas'] * 100) / $departamentos['total_atividades']) !!}", name: "" }]
            }]
        }, option && "object" == typeof option && myChart.setOption(option, !0);
    </script>
    {{-- <script src="{{asset('admin/js/pages/echarts.init.js')}}"></script>> --}}

    <script src="{{asset('admin/libs/jquery-knob/jquery.knob.min.js')}}"></script> 

    <script>
        $(function(){
            $(".knob").knob({
                'readOnly': true
            })
        });
    </script>

    {{-- <script src="{{asset('admin/js/pages/jquery-knob.init.js')}}"></script>  --}}
@endsection