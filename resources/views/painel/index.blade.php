@extends('painel.template.main')


@section('conteudo')
    @if(session()->get("usuario")["admin"] && !session()->get("academia"))
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
            
            // DEPARTAMENTOS
            
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
                                $(".grafico_departamento[did='"+i+"']").val(resultado.toFixed(0)).trigger('change');
                                $(".grafico_departamento[did='"+i+"']").val(resultado.toFixed(0) + "%");
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
                        data: [{ value: valor.toFixed(2), name: "" }]
                    }]
                }, option && "object" == typeof option && myChart.setOption(option, !0);
            }

            // RESULTADOS

            function carrega_resultados() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('dashboard.resultados.api') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(dados) {
                        carrega_grafico_resultados(dados.datas,dados.contratos,dados.mercados);
                        if(dados.total_mercados > dados.total_contratos){
                            html = '<i class="fas fa-angle-up" style="color: green; margin: 0 8px 0 0px;"></i><span style="color: green;">R$' + number_format(dados.total_mercados - dados.total_contratos, 2, ",", ".") + '</span>'
                            $("#resultado-pizza-titulo").html(html);
                        }else{
                            html = '<i class="fas fa-angle-down" style="color: red; margin: 0 8px 0 0px;"></i><span style="color: red;">R$' + number_format(dados.total_mercados - dados.total_contratos, 2, ",", ".") + '</span>'
                            $("#resultado-pizza-titulo").html(html);
                        }
                        carrega_grafico_resultados_pizza(dados.total_contratos, dados.total_mercados);
                    },
                    error: function(ret) {
                        console.log(ret);
                    }
                });
            }

            function carrega_grafico_resultados(datas, contratos, mercados){
                dom = document.getElementById("line-chart"), myChart = echarts.init(dom), app = {};
                option = null, option = {
                    xAxis: {
                        type: 'category',
                        data: datas
                    },
                    yAxis: {
                        type: 'value'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    series: [
                        {
                            color: "#B22222",
                            name: 'Contrato',
                            data: contratos,
                            type: 'line',
                            smooth: false
                        },
                        {
                            color: "#005b96",
                            name: 'Mercado',
                            data: mercados,
                            type: 'line',
                            smooth: false
                        }
                    ],
                    legend: {
                        data: ['Contrato', "Mercado"]
                    },
                }, option && "object" == typeof option && myChart.setOption(option, !0);
            }

            function carrega_grafico_resultados_pizza(contratos, mercados){
                dom = document.getElementById("pizza-chart"), myChart = echarts.init(dom), app = {};
                option = null, option = {
                    tooltip: {
                        trigger: 'item',
                        formatter: 'R${c}' 
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [
                        {
                            name: 'Resultados',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            colorBy: 'data',
                            itemStyle: {
                                borderRadius: 10,
                                borderColor: '#fff',
                                borderWidth: 2
                            },
                            label: {
                                show: false,
                                position: 'center',
                                formatter: '{d}%'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '15',
                                    fontWeight: 'bold',
                                    formatter: '{d}%'
                                },
                                focus: 'self',
                            },
                            labelLine: {
                                show: false
                            },
                            data: [
                                { value: contratos, itemStyle:{color: "#B22222"}, name: 'Contrato' },
                                { value: mercados, itemStyle:{color: "#005b96"}, name: 'Mercado' },
                            ]
                        }
                    ],
                }, option && "object" == typeof option && myChart.setOption(option, !0);
            }

            function number_format (number, decimals, dec_point, thousands_sep) {
                // Strip all characters but numerical ones.
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            carrega_progresso_departamentos();
            carrega_resultados();
        })
    </script>
@endsection