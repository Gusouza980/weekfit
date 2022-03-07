@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('titulo')
    Dashboard Comercial
@endsection

@section('botoes')
    <a name="" id="" class="btn btn-success" href="{{ route('painel.prospeccao.cadastro') }}" role="button">Nova
        Prospecção</a>
@endsection

@section('conteudo')
    <div class="row mt-3">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Gráfico diário de prospecções</h4>
                    <div id="graficoQuantidadeProspeccoesDiarias" class="e-charts"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Gráfico mensal de prospecções</h4>
                    <div id="graficoQuantidadeProspeccoesMensais" class="e-charts"></div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
    <div class="row mt-3">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Gráfico diário de interações</h4>
                    <div id="graficoQuantidadeInteracoesDiarias" class="e-charts"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Gráfico mensal de interações</h4>
                    <div id="graficoQuantidadeInteracoesMensais" class="e-charts"></div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Gráfico de status</h4>
                    <div id="graficoQuantidadeProspeccoesStatus" class="e-charts"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('admin/libs/echarts/echarts.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            function carrega_quantidade_prospeccoes_status() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('painel.prospeccoes.quantidade.status') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        var datas = [];
                        var quantidades = [];
                        data.forEach(element => {
                            datas.push(element.name);
                            quantidades.push(element);
                        });
                        carregaGraficoCirculo(datas, quantidades, document.getElementById(
                            "graficoQuantidadeProspeccoesStatus"));
                    },
                    error: function(ret) {
                        console.log(ret);
                    }
                });
            }

            function carrega_quantidade_prospeccoes_diarias() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('painel.prospeccoes.quantidade.diaria') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(data);
                        var datas = [];
                        var quantidades = [];
                        data.forEach(element => {
                            datas.push(element.data);
                            quantidades.push(element.quantidade);
                        });
                        carregaGraficoLinear(datas, quantidades, document.getElementById(
                            "graficoQuantidadeProspeccoesDiarias"));
                        carrega_quantidade_prospeccoes_mensais();

                    },
                    error: function(ret) {
                        console.log(ret);
                    }
                });
            }

            function carrega_quantidade_prospeccoes_mensais() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('painel.prospeccoes.quantidade.mensal') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        var datas = [];
                        var quantidades = [];
                        data.forEach(element => {
                            datas.push(element.data);
                            quantidades.push(element.quantidade);
                        });
                        carregaGraficoLinear(datas, quantidades, document.getElementById(
                            "graficoQuantidadeProspeccoesMensais"));
                        carrega_quantidade_interacoes_diarias();
                    },
                    error: function() {
                        toastr.error('Erro na operação. Atualize a página e tente novamente.', 'Erro')
                    }
                });
            }

            function carrega_quantidade_interacoes_diarias() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('painel.prospeccoes.quantidade.interacoes.diaria') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        var datas = [];
                        var quantidades = [];
                        data.forEach(element => {
                            datas.push(element.data);
                            quantidades.push(element.quantidade);
                        });
                        carregaGraficoLinear(datas, quantidades, document.getElementById(
                            "graficoQuantidadeInteracoesDiarias"));
                        carrega_quantidade_interacoes_mensais();
                    },
                    error: function() {
                        toastr.error('Erro na operação. Atualize a página e tente novamente.', 'Erro')
                    }
                });
            }

            function carrega_quantidade_interacoes_mensais() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                $.ajax({
                    url: "{!! route('painel.prospeccoes.quantidade.interacoes.mensal') !!}",
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        var datas = [];
                        var quantidades = [];
                        data.forEach(element => {
                            datas.push(element.data);
                            quantidades.push(element.quantidade);
                        });
                        carregaGraficoLinear(datas, quantidades, document.getElementById(
                            "graficoQuantidadeInteracoesMensais"));
                        carrega_quantidade_prospeccoes_status();
                    },
                    error: function() {
                        toastr.error('Erro na operação. Atualize a página e tente novamente.', 'Erro')
                    }
                });
            }

            function carregaGraficoLinear(datas, quantidades, elemento) {
                var dom = elemento,
                    myChart = echarts.init(dom),
                    app = {};
                (option = null), (option = {
                    grid: {
                        zlevel: 0,
                        x: 50,
                        x2: 50,
                        y: 30,
                        y2: 30,
                        borderWidth: 0,
                        backgroundColor: 'rgba(0,0,0,0)',
                        borderColor: 'rgba(0,0,0,0)',
                    },
                    xAxis: {
                        type: 'category',
                        data: datas,
                        axisLine: {
                            lineStyle: {
                                color: '#8791af'
                            }
                        },
                    },
                    yAxis: {
                        type: 'value',
                        axisLine: {
                            lineStyle: {
                                color: '#8791af'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: 'rgba(166, 176, 207, 0.1)'
                            }
                        },
                    },
                    series: [{
                        data: quantidades,
                        type: 'line'
                    }],
                    color: ['#34c38f'],
                }), option && 'object' == typeof option && myChart.setOption(option, !0);
            }

            function carregaGraficoCirculo(datas, quantidades, elemento) {
                (dom = elemento), (myChart = echarts.init(
                    dom
                )), (app = {});
                (option = null), (option = {
                    tooltip: {
                        trigger: 'item',
                        formatter: '{a} <br/>{b}: {c} ({d}%)'
                    },
                    legend: {
                        orient: 'vertical',
                        x: 'left',
                        data: datas,
                        textStyle: {
                            color: '#8791af'
                        },
                    },
                    color: ['#556ee6', '#f1b44c', '#34c38f'],
                    series: [{
                        name: 'Total sales',
                        type: 'pie',
                        radius: ['50%', '70%'],
                        avoidLabelOverlap: !1,
                        label: {
                            normal: {
                                show: !1,
                                position: 'center'
                            },
                            emphasis: {
                                show: !0,
                                textStyle: {
                                    fontSize: '20',
                                    fontWeight: 'bold'
                                }
                            },
                        },
                        labelLine: {
                            normal: {
                                show: !1
                            }
                        },
                        data: quantidades,
                    },
                ],
                }), option && 'object' == typeof option && myChart.setOption (option, !0);
            }

            carrega_quantidade_prospeccoes_diarias();
        });
    </script>
    <script>

    </script>
@endsection
