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
                                <img src="{{asset('admin/images/users/avatar-1.jpg')}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <p class="mb-2">Welcome to Skote Dashboard</p>
                                    <h5 class="mb-1">Henry wells</h5>
                                    <p class="mb-0">UI / UX Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 align-self-center">
                        <div class="text-lg-center mt-4 mt-lg-0">
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Total Projects</p>
                                        <h5 class="mb-0">48</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Projects</p>
                                        <h5 class="mb-0">40</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Clients</p>
                                        <h5 class="mb-0">18</h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="clearfix mt-4 mt-lg-0">
                            <div class="dropdown float-end">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bxs-cog align-middle me-1"></i> Setting
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<div class="row d-flex flex-row">
    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title">Progresso Geral</h4>
                <div id="gauge-chart" class="e-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card w-100 h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9 col-sm-8">
                        <div  class="p-4">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>Skote Crypto Dashboard</p>

                            <div class="text-muted">
                                <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> If several languages coalesce</p>
                                <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Sed ut perspiciatis unde</p>
                                <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> It would be necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 align-self-center">
                        <div>
                            <img src="assets/images/crypto/features-img/img-1.png" alt="" class="img-fluid d-block">
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
                <h4 class="card-title">Progresso por departamento</h4>
                <div class="row mt-4">
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Administrativo</h5>
                            <input class="knob" data-width="150" data-fgcolor="#556ee6" @if($departamentos[0]["total_atividades"] != 0) value="{{number_format(($departamentos[0]["total_atividades_completas"] * 100) / $departamentos[0]["total_atividades"], 1)}}" @else value="0" @endif>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Técnico</h5>
                            <input class="knob" data-width="150" data-fgcolor="#556ee6" @if($departamentos[1]["total_atividades"] != 0) value="{{number_format(($departamentos[1]["total_atividades_completas"] * 100) / $departamentos[1]["total_atividades"], 1)}}" @else value="0" @endif>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Comercial</h5>
                            <input class="knob" data-width="150" data-fgcolor="#556ee6" @if($departamentos[2]["total_atividades"] != 0) value="{{number_format(($departamentos[2]["total_atividades_completas"] * 100) / $departamentos[2]["total_atividades"], 1)}}" @else value="0" @endif>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Marketing</h5>
                            <input class="knob" data-width="150" data-fgcolor="#556ee6" @if($departamentos[3]["total_atividades"] != 0) value="{{number_format(($departamentos[3]["total_atividades_completas"] * 100) / $departamentos[3]["total_atividades"], 1)}}" @else value="0" @endif>
                        </div>
                    </div>

                </div>

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