@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('titulo')
    Lançamento Anual
@endsection

@section('botoes')
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-12">
            <div class="card" style="min-height: 100vh;">
                <div class="card-body" style="overflow-x: scroll;">
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if(!session()->get('aba')) active @endif" data-bs-toggle="tab" href="#geral" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Geral</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(session()->get('aba') && session()->get('aba') == 'administrativo') active @endif" data-bs-toggle="tab" href="#administrativo" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Administrativo</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(session()->get('aba') && session()->get('aba') == 'tecnico') active @endif" data-bs-toggle="tab" href="#tecnico" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Técnico</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(session()->get('aba') && session()->get('aba') == 'comercial') active @endif" data-bs-toggle="tab" href="#comercial" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Comercial</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(session()->get('aba') && session()->get('aba') == 'marketing') active @endif" data-bs-toggle="tab" href="#marketing" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Marketing</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane @if(!session()->get('aba')) active @endif" id="geral" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5 class="card-title">Calcular Resultados</h5>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <form action="{{route('painel.academia.dashboard.lancamentos.calcular', ['academia' => $academia])}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-12 col-md-3">
                                                    <label for="">Valor de Contrato</label>
                                                    <input type="number" class="form-control" name="contrato" id=""
                                                        aria-describedby="helpId" step="0.01" placeholder="" value="{{number_format($academia->valor_contrato, 2, ".", ",")}}">
                                                </div>
                                                <div class="form-group col-12 col-md-3">
                                                    <label for="">Período</label>
                                                    <input type="month" class="form-control" name="data" required>
                                                </div>
                                                <div class="form-group col-12 col-md-3 mt-4">
                                                    <button type="submit" class="btn btn-primary">Calcular</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="container-fluid">
                                            <div class="row">
                                                @php
                                                    $ultimo_valor = null
                                                @endphp
                                                @foreach($academia->lancamentos->sortBy("data") as $lancamento)
                                                    @php
                                                        $valor = $lancamento->mercado - $lancamento->contrato;
                                                    @endphp
                                                    <div class="card-lancamento text-center mx-2 mt-3" contrato="{{$lancamento->contrato}}" mercado="{{$lancamento->mercado}}" data="{{$lancamento->data}}" lid="{{$lancamento->id}}" mesano="{{date('m/Y', strtotime($lancamento->data))}}">
                                                        <div>
                                                            <h5>{{date("m/Y", strtotime($lancamento->data))}}</h5>
                                                            <span>R${{number_format($valor, 2, ",", ".")}}</span>
                                                            @if($ultimo_valor)
                                                                @if($ultimo_valor < $valor)
                                                                    <i class="fas fa-angle-up" style="color: green; margin: 0 3px 0 5px;"></i><span style="color: green;">{{number_format((($valor * 100 / $ultimo_valor) - 100), 2, ",", ".")}}%</span>
                                                                @else
                                                                    <i class="fas fa-angle-down" style="color: red;"></i><span style="color: red;">{{number_format((($valor * 100 / $ultimo_valor) - 100) * -1, 2, ",", ".")}}%</span>
                                                                @endif
                                                            @endif
                                                            @php
                                                                $ultimo_valor = $valor;
                                                            @endphp
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if(session()->get('aba') && session()->get('aba') == 'administrativo') active @endif" id="administrativo" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <a name="" id="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoLancamentoAdministrativo" role="button">Novo lançamento</a>
                                </div>
                            </div>
                           
                            <div class="row">
                                @php
                                    $ultimo_valor = null
                                @endphp
                                @foreach($academia->lancamentos_administrativos->sortBy("data") as $lancamento)
                                    @php
                                        $valor = $lancamento->total;
                                    @endphp
                                    <div class="card-lancamento text-center mx-2 mt-3" data-bs-toggle="modal" data-bs-target="#modalEditaLancamentoAdministrativo{{$lancamento->id}}">
                                        <div>
                                            <h5>{{date("m/Y", strtotime($lancamento->data))}}</h5>
                                            <span>R${{number_format($valor, 2, ",", ".")}}</span>
                                            @if($ultimo_valor)
                                                @if($ultimo_valor < $valor)
                                                    <i class="fas fa-angle-up" style="color: green; margin: 0 3px 0 5px;"></i><span style="color: green;">{{number_format((($valor * 100 / $ultimo_valor) - 100), 2, ",", ".")}}%</span>
                                                @else
                                                    <i class="fas fa-angle-down" style="color: red;"></i><span style="color: red;">{{number_format((($valor * 100 / $ultimo_valor) - 100) * -1, 2, ",", ".")}}%</span>
                                                @endif
                                            @endif
                                            @php
                                                $ultimo_valor = $valor;
                                            @endphp
                                        </div>
                                        <div class="modal fade" id="modalEditaLancamentoAdministrativo{{$lancamento->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaLancamentoAdministrativo{{$lancamento->id}}Label"
                                        aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-start">
                                                        <h5>Editando Lançamento Administrativo - {{date("m/Y", strtotime($lancamento->data))}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <form action="{{route('painel.academia.dashboard.lancamentos.administrativo.salvar', ['lancamento' => $lancamento])}}" method="post">
                                                            @csrf
                                                            <div class="row">
                                                                <h5 class="card-title mt-4">Jornada de Mentoria de Administrativo</h5>
                                                                <div class="form-group col-12 col-md-6 mt-2">
                                                                    <label for="">Valor</label>
                                                                    <input type="number" class="form-control" name="jornada_mentoria_preco"
                                                                        aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->jornada_mentoria_preco}}" required>
                                                                </div>
                                                                <div class="form-group col-12 col-md-6 mt-2">
                                                                    <label for="">Quantidade</label>
                                                                    <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                                                        aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->jornada_mentoria_quantidade}}" required>
                                                                </div>
                                                                <h5 class="card-title mt-4">Checklist</h5>
                                                                <div class="form-group col-12 col-md-6 mt-2">
                                                                    <label for="">Valor</label>
                                                                    <input type="number" class="form-control" name="checklist_preco"
                                                                        aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->checklist_preco}}" required>
                                                                </div>
                                                                <div class="form-group col-12 col-md-6 mt-2">
                                                                    <label for="">Quantidade</label>
                                                                    <input type="number" class="form-control" name="checklist_quantidade"
                                                                        aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->checklist_quantidade}}" required>
                                                                </div>
                                                                <h5 class="card-title mt-4">Taxa de Juros do Cartão</h5>
                                                                <div class="form-group col-12 col-md-6 mt-2">
                                                                    <label for="">Valor</label>
                                                                    <input type="number" class="form-control" name="juros_valor"
                                                                        aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->juros_valor}}" required>
                                                                </div>
                                                                <div class="form-group col-12 col-md-6 mt-2">
                                                                    <label for="">Taxa (%)</label>
                                                                    <input type="number" class="form-control" name="juros"
                                                                        aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->juros}}" required>
                                                                </div>
                                                                <div class="col-12 mt-2 text-end">
                                                                    <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane @if(session()->get('aba') && session()->get('aba') == 'tecnico') active @endif" id="tecnico" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <a name="" id="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoLancamentoTecnico" role="button">Novo lançamento</a>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $ultimo_valor = null
                                @endphp
                                @foreach($academia->lancamentos_tecnicos->sortBy("data") as $lancamento)
                                    @php
                                        $valor = $lancamento->total;
                                    @endphp
                                    <div class="card-lancamento text-center mx-2 mt-3" data-bs-toggle="modal" data-bs-target="#modalEditaLancamentoTecnico{{$lancamento->id}}">
                                        <div>
                                            <h5>{{date("m/Y", strtotime($lancamento->data))}}</h5>
                                            <span>R${{number_format($valor, 2, ",", ".")}}</span>
                                            @if($ultimo_valor)
                                                @if($ultimo_valor < $valor)
                                                    <i class="fas fa-angle-up" style="color: green; margin: 0 3px 0 5px;"></i><span style="color: green;">{{number_format((($valor * 100 / $ultimo_valor) - 100), 2, ",", ".")}}%</span>
                                                @else
                                                    <i class="fas fa-angle-down" style="color: red;"></i><span style="color: red;">{{number_format((($valor * 100 / $ultimo_valor) - 100) * -1, 2, ",", ".")}}%</span>
                                                @endif
                                            @endif
                                            @php
                                                $ultimo_valor = $valor;
                                            @endphp
                                        </div>
                                        <div class="modal fade" id="modalEditaLancamentoTecnico{{$lancamento->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaLancamentoTecnico{{$lancamento->id}}Label"
                                            aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-start">
                                                            <h5>Editando Lançamento Técnico - {{date("m/Y", strtotime($lancamento->data))}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <form action="{{route('painel.academia.dashboard.lancamentos.tecnico.salvar', ['lancamento' => $lancamento])}}" method="post">
                                                                @csrf
                                                                <div class="row">
                                                                    <h5 class="card-title mt-4">Jornada de Mentoria de Administrativo</h5>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Valor</label>
                                                                        <input type="number" class="form-control" name="jornada_mentoria_preco"
                                                                            aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->jornada_mentoria_preco}}" required>
                                                                    </div>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Quantidade</label>
                                                                        <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                                                            aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->jornada_mentoria_quantidade}}" required>
                                                                    </div>
                                                                    <h5 class="card-title mt-4">Programa de Resultados</h5>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Valor</label>
                                                                        <input type="number" class="form-control" name="programa_resultados_preco"
                                                                            aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->programa_resultados_preco}}" required>
                                                                    </div>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Quantidade</label>
                                                                        <input type="number" class="form-control" name="programa_resultados_quantidade"
                                                                            aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->programa_resultados_quantidade}}" required>
                                                                    </div>
                                                                    <div class="col-12 mt-2 text-end">
                                                                        <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane @if(session()->get('aba') && session()->get('aba') == 'comercial') active @endif" id="comercial" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <a name="" id="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoLancamentoComercial" role="button">Novo lançamento</a>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $ultimo_valor = null
                                @endphp
                                @foreach($academia->lancamentos_comerciais->sortBy("data") as $lancamento)
                                    @php
                                        $valor = $lancamento->total;
                                    @endphp
                                    <div class="card-lancamento text-center mx-2 mt-3" data-bs-toggle="modal" data-bs-target="#modalEditaLancamentoComercial{{$lancamento->id}}">
                                        <div>
                                            <h5>{{date("m/Y", strtotime($lancamento->data))}}</h5>
                                            <span>R${{number_format($valor, 2, ",", ".")}}</span>
                                            @if($ultimo_valor)
                                                @if($ultimo_valor < $valor)
                                                    <i class="fas fa-angle-up" style="color: green; margin: 0 3px 0 5px;"></i><span style="color: green;">{{number_format((($valor * 100 / $ultimo_valor) - 100), 2, ",", ".")}}%</span>
                                                @else
                                                    <i class="fas fa-angle-down" style="color: red;"></i><span style="color: red;">{{number_format((($valor * 100 / $ultimo_valor) - 100) * -1, 2, ",", ".")}}%</span>
                                                @endif
                                            @endif
                                            @php
                                                $ultimo_valor = $valor;
                                            @endphp
                                        </div>
                                        <div class="modal fade" id="modalEditaLancamentoComercial{{$lancamento->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaLancamentoComercial{{$lancamento->id}}Label"
                                            aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-start">
                                                            <h5>Editando Lançamento Comercial - {{date("m/Y", strtotime($lancamento->data))}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <form action="{{route('painel.academia.dashboard.lancamentos.comercial.salvar', ['lancamento' => $lancamento])}}" method="post">
                                                                @csrf
                                                                <div class="row">
                                                                    <h5 class="card-title mt-4">Jornada de Mentoria de Administrativo</h5>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Valor</label>
                                                                        <input type="number" class="form-control" name="jornada_mentoria_preco"
                                                                            aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->jornada_mentoria_preco}}" required>
                                                                    </div>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Quantidade</label>
                                                                        <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                                                            aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->jornada_mentoria_quantidade}}" required>
                                                                    </div>
                                                                    <h5 class="card-title mt-4">Precificação</h5>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Valor</label>
                                                                        <input type="number" class="form-control" name="precificacao_preco"
                                                                            aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->precificacao_preco}}" required>
                                                                    </div>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Quantidade</label>
                                                                        <input type="number" class="form-control" name="precificacao_quantidade"
                                                                            aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->precificacao_quantidade}}" required>
                                                                    </div>
                                                                    <h5 class="card-title mt-4">Scripts de Ligação</h5>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Valor</label>
                                                                        <input type="number" class="form-control" name="scripts_ligacao_preco"
                                                                            aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->scripts_ligacao_preco}}" required>
                                                                    </div>
                                                                    <div class="form-group col-12 col-md-6 mt-2">
                                                                        <label for="">Quantidade</label>
                                                                        <input type="number" class="form-control" name="scripts_ligacao_quantidade"
                                                                            aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->scripts_ligacao_quantidade}}" required>
                                                                    </div>
                                                                    <div class="col-12 mt-2 text-end">
                                                                        <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane @if(session()->get('aba') && session()->get('aba') == 'marketing') active @endif" id="marketing" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <a name="" id="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoLancamentoMarketing" role="button">Novo lançamento</a>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $ultimo_valor = null
                                @endphp
                                @foreach($academia->lancamentos_marketings->sortBy("data") as $lancamento)
                                    @php
                                        $valor = $lancamento->total;
                                    @endphp
                                    <div class="card-lancamento text-center mx-2 mt-3" data-bs-toggle="modal" data-bs-target="#modalEditaLancamentoMarketing{{$lancamento->id}}">
                                        <div>
                                            <h5>{{date("m/Y", strtotime($lancamento->data))}}</h5>
                                            <span>R${{number_format($valor, 2, ",", ".")}}</span>
                                            @if($ultimo_valor)
                                                @if($ultimo_valor < $valor)
                                                    <i class="fas fa-angle-up" style="color: green; margin: 0 3px 0 5px;"></i><span style="color: green;">{{number_format((($valor * 100 / $ultimo_valor) - 100), 2, ",", ".")}}%</span>
                                                @else
                                                    <i class="fas fa-angle-down" style="color: red;"></i><span style="color: red;">{{number_format((($valor * 100 / $ultimo_valor) - 100) * -1, 2, ",", ".")}}%</span>
                                                @endif
                                            @endif
                                            @php
                                                $ultimo_valor = $valor;
                                            @endphp
                                        </div>
                                        <div class="modal fade" id="modalEditaLancamentoMarketing{{$lancamento->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaLancamentoMarketing{{$lancamento->id}}Label"
                                            aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-start">
                                                            <h5>Editando Lançamento Marketing - {{date("m/Y", strtotime($lancamento->data))}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <form action="{{route('painel.academia.dashboard.lancamentos.marketing.salvar', ['lancamento' => $lancamento])}}" method="post">
                                                                @csrf
                                                                <div class="row">                                                                
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Jornada de Mentoria de Marketing</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="jornada_mentoria_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->jornada_mentoria_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->jornada_mentoria_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Editorial</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="editorial_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->editorial_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="editorial_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->editorial_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Posts / Imagem / Padrão</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="post_imagem_padrao_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->post_imagem_padrao_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="post_imagem_padrao_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->post_imagem_padrao_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Posts / Vídeos / Padrão</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="post_video_padrao_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->post_video_padrao_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="post_video_padrao_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->post_video_padrao_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Posts / Metodologia / Padrão</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="post_metodologia_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->post_metodologia_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="post_metodologia_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->post_metodologia_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Posts / Imagem / Personalizado</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="post_imagem_personalizado_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->post_imagem_personalizado_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="post_imagem_personalizado_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->post_imagem_personalizado_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Posts / Videos / Personalizado</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="post_video_personalizado_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->post_video_personalizado_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="post_video_personalizado_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->post_video_personalizado_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Artigo Técnico de Blog</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="artigo_tecnico_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->artigo_tecnico_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="artigo_tecnico_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->artigo_tecnico_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Agendamento de Publicações e Monitoramento</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="agendamento_publicacoes_monitoramento_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->agendamento_publicacoes_monitoramento_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="agendamento_publicacoes_monitoramento_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->agendamento_publicacoes_monitoramento_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Campanha Online</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="campanha_online_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->campanha_online_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="campanha_online_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->campanha_online_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Campanha Offline</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="campanha_offline_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->campanha_offline_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="campanha_offline_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->campanha_offline_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Proposta de Ativação e Parceria</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="proposta_ativacao_parceria_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->proposta_ativacao_parceria_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="proposta_ativacao_parceria_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->proposta_ativacao_parceria_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Getree</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="getree_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->getree_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="getree_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->getree_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Site Institucional</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="site_institucional_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->site_institucional_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="site_institucional_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->site_institucional_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Página de Captura</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="pagina_captura_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->pagina_captura_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="pagina_captura_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->pagina_captura_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Emails Personalizados</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="email_personalizado_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->email_personalizado_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="email_personalizado_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->email_personalizado_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                        
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="row">
                                                                            <h5 class="card-title mt-4">Guias e Manuais Técnicos</h5>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Valor</label>
                                                                                <input type="number" class="form-control" name="guias_manuais_preco"
                                                                                    aria-describedby="helpId" step="0.01" placeholder="" value="{{$lancamento->guias_manuais_preco}}" required>
                                                                            </div>
                                                                            <div class="form-group col-12 col-md-6 mt-2">
                                                                                <label for="">Quantidade</label>
                                                                                <input type="number" class="form-control" name="guias_manuais_quantidade"
                                                                                    aria-describedby="helpId" step="1" placeholder="" value="{{$lancamento->guias_manuais_quantidade}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-12 mt-2 text-end">
                                                                        <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="modalEditaLancamento" tabindex="-1" role="dialog" aria-labelledby="modalEditaLancamentoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="data_titulo_modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('painel.academia.dashboard.lancamentos.calcular', ['academia' => $academia])}}" method="post">
                        @csrf
                        <input type="hidden" name="data" id="data_modal" value="">
                        <input type="hidden" name="lid" id="lid_modal" value="">
                        <div class="row">
                            <div class="form-group col-12 col-md-4">
                                <label for="">Valor de Contrato</label>
                                <input type="number" class="form-control" name="contrato" id="contrato_modal"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="">Valor de Mercado</label>
                                <input type="number" class="form-control" name="mercado" id="mercado_modal"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="">
                            </div>
                            <div class="form-group col-12 col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNovoLancamentoAdministrativo" tabindex="-1" role="dialog" aria-labelledby="modalNovoLancamentoAdministrativoLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Lançamento do Administrativo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('painel.academia.dashboard.lancamentos.administrativo.lancar', ['academia' => $academia])}}" method="post">
                        @csrf
                        <div class="row">
                            <h5 class="card-title">Período</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <input type="month" class="form-control" name="data" required>
                            </div>
                            <h5 class="card-title mt-4">Jornada de Mentoria de Administrativo</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="jornada_mentoria_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="0" required>
                            </div>
                            <h5 class="card-title mt-4">Checklist</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="checklist_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="checklist_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="0" required>
                            </div>
                            <h5 class="card-title mt-4">Taxa de Juros do Cartão</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="juros_valor"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Taxa (%)</label>
                                <input type="number" class="form-control" name="juros"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="col-12 mt-2 text-end">
                                <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNovoLancamentoTecnico" tabindex="-1" role="dialog" aria-labelledby="modalNovoLancamentoTecnicoLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Lançamento do Técnico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('painel.academia.dashboard.lancamentos.tecnico.lancar', ['academia' => $academia])}}" method="post">
                        @csrf
                        <div class="row">
                            <h5 class="card-title">Período</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <input type="month" class="form-control" name="data" required>
                            </div>
                            <h5 class="card-title mt-4">Jornada de Mentoria de Administrativo</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="jornada_mentoria_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="0" required>
                            </div>
                            <h5 class="card-title mt-4">Programa de Resultados</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="programa_resultados_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="programa_resultados_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="0" required>
                            </div>
                            <div class="col-12 mt-2 text-end">
                                <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNovoLancamentoComercial" tabindex="-1" role="dialog" aria-labelledby="modalNovoLancamentoComercialLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Lançamento do Comercial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('painel.academia.dashboard.lancamentos.comercial.lancar', ['academia' => $academia])}}" method="post">
                        @csrf
                        <div class="row">
                            <h5 class="card-title">Período</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <input type="month" class="form-control" name="data" required>
                            </div>
                            <h5 class="card-title mt-4">Jornada de Mentoria de Administrativo</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="jornada_mentoria_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="0" required>
                            </div>
                            <h5 class="card-title mt-4">Precificação</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="precificacao_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="precificacao_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="" required>
                            </div>
                            <h5 class="card-title mt-4">Scripts de Ligação</h5>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Valor</label>
                                <input type="number" class="form-control" name="scripts_ligacao_preco"
                                    aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                            </div>
                            <div class="form-group col-12 col-md-6 mt-2">
                                <label for="">Quantidade</label>
                                <input type="number" class="form-control" name="scripts_ligacao_quantidade"
                                    aria-describedby="helpId" step="1" placeholder="" value="" required>
                            </div>
                            <div class="col-12 mt-2 text-end">
                                <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNovoLancamentoMarketing" tabindex="-1" role="dialog" aria-labelledby="modalNovoLancamentoMarketingLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Lançamento do Marketing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('painel.academia.dashboard.lancamentos.marketing.lancar', ['academia' => $academia])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="card-title">Período</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <input type="month" class="form-control" name="data" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Jornada de Mentoria de Marketing</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="jornada_mentoria_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="0" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="jornada_mentoria_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Editorial</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="editorial_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="editorial_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Posts / Imagem / Padrão</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="post_imagem_padrao_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="post_imagem_padrao_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Posts / Vídeos / Padrão</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="post_video_padrao_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="post_video_padrao_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Posts / Metodologia / Padrão</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="post_metodologia_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="post_metodologia_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Posts / Imagem / Personalizado</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="post_imagem_personalizado_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="post_imagem_personalizado_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Posts / Videos / Personalizado</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="post_video_personalizado_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="post_video_personalizado_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Artigo Técnico de Blog</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="artigo_tecnico_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="artigo_tecnico_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Agendamento de Publicações e Monitoramento</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="agendamento_publicacoes_monitoramento_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="agendamento_publicacoes_monitoramento_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Campanha Online</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="campanha_online_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="campanha_online_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Campanha Offline</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="campanha_offline_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="campanha_offline_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Proposta de Ativação e Parceria</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="proposta_ativacao_parceria_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="proposta_ativacao_parceria_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Getree</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="getree_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="getree_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Site Institucional</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="site_institucional_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="site_institucional_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Página de Captura</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="pagina_captura_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="pagina_captura_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Emails Personalizados</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="email_personalizado_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="email_personalizado_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <h5 class="card-title mt-4">Guias e Manuais Técnicos</h5>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" name="guias_manuais_preco"
                                            aria-describedby="helpId" step="0.01" placeholder="" value="" required>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mt-2">
                                        <label for="">Quantidade</label>
                                        <input type="number" class="form-control" name="guias_manuais_quantidade"
                                            aria-describedby="helpId" step="1" placeholder="" value="" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-2 text-end">
                                <button type="submit" class="btn btn-primary btn-block px-5">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // $(".card-lancamento").click(function(){
            //     var lid = $(this).attr("lid");
            //     var contrato = $(this).attr("contrato");
            //     var mercado = $(this).attr("mercado");
            //     var data = $(this).attr("data");
            //     var mesano = $(this).attr("mesano");

            //     $("#data_titulo_modal").html(mesano);

            //     $("#lid_modal").val(lid);
            //     $("#contrato_modal").val(contrato);
            //     $("#mercado_modal").val(mercado);
            //     $("#data_modal").val(data);

            //     $("#modalEditaLancamento").modal("show");
            // })
        });
    </script>
@endsection
