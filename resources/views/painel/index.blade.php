@extends('painel.template.main')


@section('conteudo')
    @if(session()->get("usuario")["admin"])
        @include('painel.includes.analytics')
    @else
        @include('painel.includes.dashboard_geral')
    @endif
@endsection


@section('scripts')

    <script src="{{asset('admin/libs/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('admin/libs/jquery-knob/jquery.knob.min.js')}}"></script> 
    <script>
        $(function(){
            $(".knob").knob({
                'readOnly': true
            })
        });
    </script>
    <script>
        $(document).ready(function(){
            function carrega_progresso_departamentos() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('dashboard.checklist.api') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        for(var i = 0; i < 4; i++){
                            if(data[i].total_atividades > 0){
                                var resultado = (data[i].total_atividades_completas * 100) / data[i].total_atividades;
                                $(".grafico_departamento[did='"+i+"']").val(resultado);
                            }else{
                                $(".grafico_departamento[did='"+i+"']").val("0")
                            }
                        }

                        if(data.total_atividades > 0){
                            carrega_grafico_progresso_geral_departamentos((data.total_atividades_completas * 100) / data.total_atividades);
                        }else{
                            carrega_grafico_progresso_geral_departamentos(0);
                        }
                            
                    },
                    error: function(ret) {
                        console.log(ret);
                    }
                });
            }

            function carrega_grafico_progresso_geral_departamentos(valor){
                dom = document.getElementById("gauge-chart"), myChart = echarts.init(dom), app = {};
                option = null, option = {
                    tooltip: { formatter: "{a} <br/>{b} : {c}%" },
                    series: [{
                        name: "Completo",
                        type: "gauge",
                        detail: { 
                            formatter: "{value}%",
                            fontSize: 15 
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
                        pointer: {
                            itemStyle: {
                                color: 'auto',
                            },
                            length: '50%',
                            width: 5
                        },
                        data: [{ value: valor, name: "" }]
                    }]
                }, option && "object" == typeof option && myChart.setOption(option, !0);
            }

            carrega_progresso_departamentos();

        })
    </script>
@endsection