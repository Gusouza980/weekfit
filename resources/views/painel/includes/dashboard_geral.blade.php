<div class="row my-3 setor-nav">
    <div class="row mx-auto mb-3" style="width: 50%;">
        <div style="vertical-align: middle;" class="col p-3 text-center" data-filter="aba1" active>
            <img src="{{ asset('admin/images/0_resultados.png') }}" style="width: 75px;" alt="">
        </div>
        <div style="vertical-align: middle;" class="col p-3 text-center" data-filter="aba2">
            <img src="{{ asset('admin/images/1_administrativo.png') }}" style="width: 75px;" alt="">
        </div>
        <div style="vertical-align: middle;" class="col p-3 text-center" data-filter="aba3">
            <img src="{{ asset('admin/images/2_tecnico.png') }}" style="width: 75px;" alt="">
        </div>
        <div style="vertical-align: middle;" class="col p-3 text-center" data-filter="aba4">
            <img src="{{ asset('admin/images/3_comercial.png') }}" style="width: 75px;" alt="">
        </div>
        <div style="vertical-align: middle;" class="col p-3 text-center" data-filter="aba5">
            <img src="{{ asset('admin/images/4_marketing.png') }}" style="width: 75px;" alt="">
        </div>
    </div>
</div>

<style>
    div.setor-nav div.row div.col[active] {
        background-color: #ffffff;
        border-bottom: 5px solid var(--azul);
        opacity: 1;
    }

    div.setor-nav div.row div.col {
        background-color: rgba(255, 255, 255, 0.726);
        transition: .32s;
        cursor: pointer;
    }

    div.setor-nav div.row div.col:hover {
        background-color: #e9e9e9;
    }

</style>
@php
if (session()->get('academia')) {
    $academia = \App\Models\Academia::find(session()->get('academia'));
} else {
    $academia = \App\Models\Academia::find(session()->get('usuario')['academia_id']);
}
@endphp

<main class="aba-content aba1">
    <div class="row">
        <div class="col-lg-1">
            <div class="card" style="min-height: 130px;">
                <div class="card-body" style="display: grid; align-content: center;">
                    <div class="media">
                        <img src="{{ asset($academia->logo) }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 justify-content-center">
            <div class="card" style="min-height: 130px;">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col px-4 mt-3">
                            <img src="{{ asset('admin/images/niveis/skate.png') }}"
                                style="max-width: 65%; max-height: 80px; @if ($academia->nivel != 0) opacity: 0.6;   filter: grayscale(100%); @endif"
                                alt="">
                        </div>
                        <div class="col px-4 mt-3">
                            <img src="{{ asset('admin/images/niveis/patinete.png') }}"
                                style="max-width: 65%; max-height: 80px; @if ($academia->nivel != 1) opacity: 0.6;   filter: grayscale(100%); @endif"
                                alt="">
                        </div>
                        <div class="col px-4 mt-3">
                            <img src="{{ asset('admin/images/niveis/bicicleta.png') }}"
                                style="max-width: 65%; max-height: 80px; @if ($academia->nivel != 2) opacity: 0.6;   filter: grayscale(100%); @endif"
                                alt="">
                        </div>
                        <div class="col px-4 mt-3">
                            <img src="{{ asset('admin/images/niveis/motocicleta.png') }}"
                                style="max-width: 65%; max-height: 80px; @if ($academia->nivel != 3) opacity: 0.6;   filter: grayscale(100%); @endif"
                                alt="">
                        </div>
                        <div class="col px-4 mt-3">
                            <img src="{{ asset('admin/images/niveis/carro.png') }}"
                                style="max-width: 65%; max-height: 80px; @if ($academia->nivel != 4) opacity: 0.6;   filter: grayscale(100%); @endif"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card" style="min-height: 130px;">
                <div class="card-body">
                    <div class="text-lg-center mt-4 mt-lg-0">
                        <div class="row">
                            @if ($academia->inicio_contrato && $academia->fim_contrato && date('Y-m-d H:i:s') < $academia->fim_contrato)
                                <div class="col-12 col-lg-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Início</p>
                                        <h5 class="mb-0">
                                            {{ date('d/m/Y', strtotime($academia->inicio_contrato)) }}</h5>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Fim</p>
                                        <h5 class="mb-0">
                                            {{ date('d/m/Y', strtotime($academia->fim_contrato)) }}</h5>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Valor</p>
                                        <h5 class="mb-0">
                                            R${{ number_format($academia->valor_contrato, 2, ',', '.') }}
                                        </h5>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center align-items-center ">
                                    Sem contrato ativo
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-9 text-center">
            <div class="card" style="min-height: 130px;">
                <div class="card-body">
                    <h5 class="font-size-14 mb-n3">Resultados</h5>
                    <div id="line-chart" class="e-charts mt-5"></div>
                </div>
            </div>
        </div>
        <div class="col-3 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="mx-auto mb-3" style="width: 200px;">
                        <h5 class="mb-n3 py-2" style="font-size: 20px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);"
                            id="resultado-pizza-titulo"></h5>
                    </div>
                    <div id="pizza-chart" class="e-charts"></div>
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
                                            <input class="knob grafico_departamento" did="0" data-width="150"
                                                data-fgcolor="{{ \Functions::corDepartamento(0) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Técnico (%)</h5>
                                            <input class="knob grafico_departamento" did="1" data-width="150"
                                                data-fgcolor="{{ \Functions::corDepartamento(1) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Comercial (%)</h5>
                                            <input class="knob grafico_departamento" did="2" data-width="150"
                                                data-fgcolor="{{ \Functions::corDepartamento(2) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="text-center" dir="ltr">
                                            <h5 class="font-size-14 mb-3">Marketing (%)</h5>
                                            <input class="knob grafico_departamento" did="3" data-width="150"
                                                data-fgcolor="{{ \Functions::corDepartamento(3) }}">
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
</main>

<main class="aba-content aba2">
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-body text-center">
                    <p>Em construção</p>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="aba-content aba3">
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-body text-center">
                    <p>Em construção</p>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="aba-content aba4">
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-body text-center">
                    <p>Em construção</p>
                </div>
            </div>
        </div>
    </div>
</main>



<main class="aba-content aba5">
    <div class="row">
        <div class="col-2">
            <div class="card">
                <div class="card-body text-center">
                    <p>Em construção</p>
                </div>
            </div>
        </div>
    </div>
</main>

@if ($academia->jornada)
@endif



@push('scripts')
    <script>
        $('div.setor-nav div.row > div').click(function() {
            $('div.setor-nav div.row > div').removeAttr('active');
            $(this).attr('active', '');

            $('main.aba-content').hide();
            $(`main.aba-content.${$(this).data('filter')}`).show();
        })
    </script>
@endpush
