@extends('painel.template.main')

@section('titulo')
    Dados da Jornada
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <div class="row justify-content-between" style="width: 100%;">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="me-3">
                                    <img src="{{ asset($academia->logo) }}" alt=""
                                        class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="text-muted">
                                        <h5 class="mb-1">{{ $academia->nome }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 align-self-center">
                    <div class="card" style="min-height: 112px">
                        <div class="card-body">
                            <div class="text-lg-center mt-4 mt-lg-0">
                                <div class="row">
                                    @php
                                        $atual = new DateTime('now');
                                        $fim = new DateTime($academia->fim_contrato);
                                        $dias = date_diff($atual, $fim);
                                    @endphp
                                    @if ($academia->inicio_contrato && $academia->fim_contrato && $atual->format('Y-m-d H:i:s') < $academia->fim_contrato)
                                        <div class="col-12 col-lg-4">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Início do Contrato</p>
                                                <h5 class="mb-0">
                                                    {{ date('d/m/Y', strtotime($academia->inicio_contrato)) }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Fim do Contrato</p>
                                                <h5 class="mb-0">
                                                    {{ date('d/m/Y', strtotime($academia->fim_contrato)) }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Dias Restantes</p>

                                                <h5 class="mb-0">{{ $dias->format('%a') }}</h5>

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
                </div>
            </div>
            <!-- end row -->
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
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 01</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(0) }}"
                                                @if ($meses[0]['total_atividades'] != 0) value="{{ number_format(($meses[0]['total_atividades_completas'] * 100) / $meses[0]['total_atividades'], 1) }}" @else value="0" @endif>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 02</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(1) }}"
                                                @if ($meses[1]['total_atividades'] != 0) value="{{ number_format(($meses[1]['total_atividades_completas'] * 100) / $meses[1]['total_atividades'], 1) }}" @else value="0" @endif>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 03</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(2) }}"
                                                @if ($meses[2]['total_atividades'] != 0) value="{{ number_format(($meses[2]['total_atividades_completas'] * 100) / $meses[2]['total_atividades'], 1) }}" @else value="0" @endif>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 04</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(3) }}"
                                                @if ($meses[3]['total_atividades'] != 0) value="{{ number_format(($meses[3]['total_atividades_completas'] * 100) / $meses[3]['total_atividades'], 1) }}" @else value="0" @endif>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 05</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(4) }}"
                                                @if ($meses[4]['total_atividades'] != 0) value="{{ number_format(($meses[4]['total_atividades_completas'] * 100) / $meses[4]['total_atividades'], 1) }}" @else value="0" @endif>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 06</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(5) }}"
                                                @if ($meses[5]['total_atividades'] != 0) value="{{ number_format(($meses[5]['total_atividades_completas'] * 100) / $meses[5]['total_atividades'], 1) }}" @else value="0" @endif>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Mês 07</h5>
                                            <input class="knob" data-width="100"
                                                data-fgcolor="{{ \Functions::corJornada(6) }}"
                                                @if ($meses[6]['total_atividades'] != 0) value="{{ number_format(($meses[6]['total_atividades_completas'] * 100) / $meses[6]['total_atividades'], 1) }}" @else value="0" @endif>
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
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    @for ($i = 0; $i < 7; $i++)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Mês {{ $i + 1 }}</h5>
                        <div class="row mt-4">
                            @for ($j = 0; $j < 4; $j++)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Semana {{ $j + 1 }}</h5>
                                        <input class="knob" data-width="150"
                                            data-fgcolor="{{ \Functions::corJornada($i) }}"
                                            @if ($meses[$i][$j]['total_atividades'] != 0) value="{{ number_format(($meses[$i][$j]['total_atividades_completas'] * 100) / $meses[$i][$j]['total_atividades'], 1) }}" @else value="0" @endif>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endfor
    <!-- end row -->
@endsection

@section('scripts')
    <!-- echarts js -->
    <script src="{{ asset('admin/libs/echarts/echarts.min.js') }}"></script>
    <!-- echarts init -->
    <script>
        dom = document.getElementById("gauge-chart"), myChart = echarts.init(dom), app = {};
        option = null, option = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },
            series: [{
                name: "Completo",
                type: "gauge",
                detail: {
                    formatter: "{value}%"
                },
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
                data: [{
                    value: "{!! number_format(($meses['total_atividades_completas'] * 100) / $meses['total_atividades']) !!}",
                    name: ""
                }]
            }]
        }, option && "object" == typeof option && myChart.setOption(option, !0);
    </script>
    {{-- <script src="{{asset('admin/js/pages/echarts.init.js')}}"></script>> --}}

    <script src="{{ asset('admin/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <script>
        $(function() {
            $(".knob").knob({
                'readOnly': true
            })
        });
    </script>

    {{-- <script src="{{asset('admin/js/pages/jquery-knob.init.js')}}"></script> --}}
@endsection
