<div class="row my-3">
    <div class="col-12 col-lg-4 offset-lg-4">
        <img src="{{asset('admin/images/0_resultados.png')}}" style="width: 55px;" alt="">
        <img class="mx-2" src="{{asset('admin/images/1_administrativo.png')}}" style="width: 55px;" alt="">
        <img class="mx-2" src="{{asset('admin/images/2_tecnico.png')}}" style="width: 55px;" alt="">
        <img class="mx-2" src="{{asset('admin/images/3_comercial.png')}}" style="width: 55px;" alt="">
        <img src="{{asset('admin/images/4_marketing.png')}}" style="width: 55px;" alt="">
    </div>
    <div class="col-12 col-lg-4">
    </div>
</div>
@php
    if(session()->get("academia")){
        $academia = \App\Models\Academia::find(session()->get("academia"));
    }else{
        $academia = \App\Models\Academia::find(session()->get("usuario")["academia_id"]);
    }
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 d-flex justify-content-center">
                            <div class="media">
                                <div class="me-3">
                                    <img src="{{asset($academia->logo)}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="row align-items-end">
                                <div class="col px-4 mt-3">
                                    <img src="{{asset('admin/images/niveis/skate.png')}}" style="max-width: 100%; max-height: 80px; @if($academia->nivel != 0) filter: grayscale(100%); @endif" alt="">
                                </div>
                                <div class="col px-4 mt-3">
                                    <img src="{{asset('admin/images/niveis/patinete.png')}}" style="max-width: 100%; max-height: 80px; @if($academia->nivel != 1) filter: grayscale(100%); @endif" alt="">
                                </div>
                                <div class="col px-4 mt-3">
                                    <img src="{{asset('admin/images/niveis/bicicleta.png')}}" style="max-width: 100%; max-height: 80px; @if($academia->nivel != 2) filter: grayscale(100%); @endif" alt="">
                                </div>
                                <div class="col px-4 mt-3">
                                    <img src="{{asset('admin/images/niveis/motocicleta.png')}}" style="max-width: 100%; max-height: 80px; @if($academia->nivel != 3) filter: grayscale(100%); @endif" alt="">
                                </div>
                                <div class="col px-4 mt-3">
                                    <img src="{{asset('admin/images/niveis/carro.png')}}" style="max-width: 100%; max-height: 80px; @if($academia->nivel != 4) filter: grayscale(100%); @endif" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 align-self-center">
                            <div class="text-lg-center mt-4 mt-lg-0">
                                <div class="row">
                                    @if($academia->inicio_contrato && $academia->fim_contrato && date('Y-m-d H:i:s') < $academia->fim_contrato)
                                        <div class="col-12 col-lg-4">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Início</p>
                                                <h5 class="mb-0">{{date('d/m/Y', strtotime($academia->inicio_contrato))}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Fim</p>
                                                <h5 class="mb-0">{{date('d/m/Y', strtotime($academia->fim_contrato))}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div>
                                                <p class="text-muted text-truncate mb-2">Valor</p>
                                                <h5 class="mb-0">R${{number_format($academia->valor_contrato, 2, ",", ".")}}</h5>
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
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9 text-center">
                        <h5 class="font-size-14 mb-n3">Resultados</h5>
                        <div id="line-chart" class="e-charts mt-5"></div>
                    </div>
                    <div class="col-3 text-center mt-5">
                        <h5 class="font-size-14 mb-n3"></h5>
                        <div id="pizza-chart" class="e-charts"></div>
                    </div>
                </div>
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
                        <div class="col-12 col-lg-3 text-center">
                            <h5 class="font-size-14 mb-n3">Progresso Geral</h5>
                            <div id="gauge-chart" class="e-charts"></div>
                        </div>
                        <div class="col-12 col-lg-9 text-center">
                            <div class="row mt-4">
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Administrativo (%)</h5>
                                        <input class="knob grafico_departamento" did="0" data-width="150" data-fgcolor="{{\Functions::corDepartamento(0)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Técnico (%)</h5>
                                        <input class="knob grafico_departamento" did="1"data-width="150" data-fgcolor="{{\Functions::corDepartamento(1)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Comercial (%)</h5>
                                        <input class="knob grafico_departamento" did="2"data-width="150" data-fgcolor="{{\Functions::corDepartamento(2)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Marketing (%)</h5>
                                        <input class="knob grafico_departamento" did="3"data-width="150" data-fgcolor="{{\Functions::corDepartamento(3)}}">
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
@if($academia->jornada)

@endif
