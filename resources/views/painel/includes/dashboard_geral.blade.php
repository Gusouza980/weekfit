<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
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
                                        <h5 class="font-size-14 mb-3">Administrativo</h5>
                                        <input class="knob grafico_departamento" did="0" data-width="150" data-fgcolor="{{\Functions::corDepartamento(0)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Técnico</h5>
                                        <input class="knob grafico_departamento" did="1"data-width="150" data-fgcolor="{{\Functions::corDepartamento(1)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Comercial</h5>
                                        <input class="knob grafico_departamento" did="2"data-width="150" data-fgcolor="{{\Functions::corDepartamento(2)}}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="text-center" dir="ltr">
                                        <h5 class="font-size-14 mb-3">Marketing</h5>
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
