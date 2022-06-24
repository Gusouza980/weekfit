@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('titulo')
    {{ $academia->nome }}
@endsection

@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Usuários</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#atividades" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Atividades</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Messages</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Settings</span>    
                        </a>
                    </li> --}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <a class="nav-link mb-2 active" id="v-pills-usuario-cadastro-tab"
                                                data-bs-toggle="pill" href="#v-pills-usuario-cadastro" role="tab"
                                                aria-controls="v-pills-usuario-cadastro" aria-selected="true">Cadastro</a>
                                            <a class="nav-link mb-2" id="v-pills-usuario-listagem-tab" data-bs-toggle="pill"
                                                href="#v-pills-usuario-listagem" role="tab"
                                                aria-controls="v-pills-usuario-listagem" aria-selected="false">Listagem</a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-usuario-cadastro"
                                                role="tabpanel" aria-labelledby="v-pills-usuario-cadastro-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="my-3">Cadastrar novo usuario</h5>
                                                        <form action="{{ route('painel.academia.usuario.salvar') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="academia_id"
                                                                value="{{ $academia->id }}">
                                                            <div class="row">
                                                                <div class="form-group col-12 col-lg-6">
                                                                    <label for="nome">Nome</label>
                                                                    <input type="text" class="form-control" name="nome"
                                                                        id="nome" aria-describedby="helpId"
                                                                        placeholder="Insira o nome do usuário">
                                                                </div>
                                                                <div class="form-group col-12 col-lg-6">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control" name="email"
                                                                        id="email" aria-describedby="helpId"
                                                                        placeholder="Insira o nome do usuário">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="form-group col-12 col-lg-6">
                                                                    <label for="telefone">Telefone</label>
                                                                    <input type="text" class="form-control" name="telefone"
                                                                        id="telefone" aria-describedby="helpId"
                                                                        placeholder="Insira o nome do usuário">
                                                                </div>
                                                                <div class="form-group col-12 col-lg-3">
                                                                    <label for="usuario">Usuario</label>
                                                                    <input type="text" class="form-control" name="usuario"
                                                                        id="usuario" aria-describedby="helpId"
                                                                        placeholder="Insira o nome do usuário">
                                                                </div>
                                                                <div class="form-group col-12 col-lg-3">
                                                                    <label for="senha">Senha</label>
                                                                    <input type="password" class="form-control" name="senha"
                                                                        id="senha" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="form-group col-12 col-lg-6">
                                                                    <label for="departamento"
                                                                        class="form-label">Departamento</label>
                                                                    <select id="departamento" name="departamento"
                                                                        class="form-select">
                                                                        <option value="0">Administrativo</option>
                                                                        <option value="1">Técnico</option>
                                                                        <option value="2">Comercial</option>
                                                                        <option value="3">Marketing</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-12 col-lg-6">
                                                                    <label for="lider" class="form-label">É líder do
                                                                        departamento ?</label>
                                                                    <select id="lider" name="lider" class="form-select">
                                                                        <option value="0">Não</option>
                                                                        <option value="1">Sim</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-12 text-end">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Salvar</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="v-pills-usuario-listagem" role="tabpanel"
                                                aria-labelledby="v-pills-home-tab">
                                                <div class="row">
                                                    <div class="col-12" style="overflow-x: scroll;">
                                                        <table id="tabela_usuarios"
                                                            class="table table-bordered dt-responsive  nowrap w-100" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Nome</th>
                                                                    <th>Email</th>
                                                                    <th>Telefone</th>
                                                                    <th>Departamento</th>
                                                                    <th>Líder</th>
                                                                    <td></td>
                                                                </tr>
                                                            </thead>


                                                            <tbody>
                                                                @foreach ($academia->usuarios as $usuario)
                                                                    <tr>
                                                                        <td>{{ $usuario->nome }}</td>
                                                                        <td>{{ $usuario->email }}</td>
                                                                        <td>{{ $usuario->telefone }}</td>
                                                                        <td>{{ config('globals.departamentos')[$usuario->departamento] }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($usuario->lider)
                                                                                Sim
                                                                            @else
                                                                                Não
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <button 
                                                                                class="btn btn-warning cpointer"
                                                                                role="button" data-bs-toggle="modal" 
                                                                                data-bs-target="#modalEditaUsuario{{ $usuario->id }}">
                                                                                
                                                                                Editar

                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="atividades" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            @foreach (config('globals.departamentos') as $key => $departamento)
                                                <a class="nav-link mb-2 @if ($key==0) active @endif"
                                                    id="v-pills-atividades-departamento-{{ $key }}-tab"
                                                    data-bs-toggle="pill"
                                                    href="#v-pills-atividades-departamento-{{ $key }}" role="tab"
                                                    aria-controls="v-pills-atividades-departamento-{{ $key }}"
                                                    aria-selected="true">{{ $departamento }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                            @foreach (config('globals.departamentos') as $key => $departamento)
                                                <div class="tab-pane fade show @if ($key==0) active @endif"
                                                    id="v-pills-atividades-departamento-{{ $key }}"
                                                    role="tabpanel"
                                                    aria-labelledby="v-pills-atividades-departamento-{{ $key }}-tab">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="accordion" id="accordion0">
                                                                @foreach (\App\Models\Grupo::where('departamento', $key)->get() as $grupo)
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingOne">
                                                                            <button
                                                                                class="accordion-button fw-medium collapsed"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#{{ \Illuminate\Support\Str::slug($grupo->nome) }}"
                                                                                aria-expanded="true"
                                                                                aria-controls="{{ \Illuminate\Support\Str::slug($grupo->nome) }}">
                                                                                {{ $grupo->nome }}
                                                                            </button>
                                                                        </h2>
                                                                        <div id="{{ \Illuminate\Support\Str::slug($grupo->nome) }}"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="headingOne"
                                                                            data-bs-parent="#accordion0">
                                                                            <div class="accordion-body">
                                                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                                                    <h6 class="my-3">
                                                                                        <b>{{ $subgrupo->nome }}</b></h6>
                                                                                    <div class="row my-3">
                                                                                        @foreach ($subgrupo->atividades as $atividade)
                                                                                            <div class="col-12 mt-1">
                                                                                                <div
                                                                                                    class="form-check form-check-inline">
                                                                                                    <label
                                                                                                        class="form-check-label input-atividade">
                                                                                                        <input
                                                                                                            class="form-check-input check-atividade"
                                                                                                            type="checkbox"
                                                                                                            name="" id=""
                                                                                                            value="{{ $atividade->id }}"
                                                                                                            @if ($atividade->ativo) checked @endif> {!!
                                                                                                        $atividade->nome 
                                                                                                        !!}
                                                                                                        @if($atividade->link)
                                                                                                            {!! " <a href='" . $atividade->link . "'> " . $atividade->texto_link . " </a>" !!}
                                                                                                        @endif
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
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
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    @foreach ($academia->usuarios as $usuario)
        <div class="modal fade" id="modalEditaUsuario{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaUsuario{{$usuario->id}}Label"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditaUsuario{{$usuario->id}}Label">{{$usuario->nome}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('painel.academia.usuario.editar', ['usuario' => $usuario]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12 col-lg-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="nome"
                                        id="nome" aria-describedby="helpId" 
                                        value="{{$usuario->nome}}">
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        id="email" aria-describedby="helpId"
                                        value="{{$usuario->email}}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12 col-lg-6">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control" name="telefone"
                                        id="telefone" aria-describedby="helpId"
                                        value="{{$usuario->telefone}}">
                                </div>
                                <div class="form-group col-12 col-lg-3">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" name="usuario"
                                        id="usuario" aria-describedby="helpId"
                                        value="{{$usuario->usuario}}">
                                </div>
                                <div class="form-group col-12 col-lg-3">
                                    <label for="senha">Senha</label>
                                    <input type="password" class="form-control" name="senha"
                                        id="senha">
                                        <small>Deixe em branco caso não queira alterar</small>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12 col-lg-6">
                                    <label for="departamento"
                                        class="form-label">Departamento</label>
                                    <select id="departamento" name="departamento"
                                        class="form-select" @if($usuario->departamento == 100) readonly @endif>
                                        <option value="0" @if($usuario->departamento == 0) selected @endif>Administrativo</option>
                                        <option value="1" @if($usuario->departamento == 1) selected @endif>Técnico</option>
                                        <option value="2" @if($usuario->departamento == 2) selected @endif>Comercial</option>
                                        <option value="3" @if($usuario->departamento == 3) selected @endif>Marketing</option>
                                        <option value="100" @if($usuario->departamento == 100) selected @endif>Proprietario</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <label for="lider" class="form-label">É líder do
                                        departamento ?</label>
                                    <select id="lider" name="lider" class="form-select">
                                        <option value="0" @if(!$usuario->lider) selected @endif>Não</option>
                                        <option value="1" @if($usuario->lider) selected @endif>Sim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="submit"
                                        class="btn btn-primary">Salvar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tabela_usuarios').DataTable({
                language: {
                    "emptyTable": "Nenhum registro encontrado",
                    "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "infoFiltered": "(Filtrados de _MAX_ registros)",
                    "infoThousands": ".",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "zeroRecords": "Nenhum registro encontrado",
                    "search": "Pesquisar",
                    "paginate": {
                        "next": "Próximo",
                        "previous": "Anterior",
                        "first": "Primeiro",
                        "last": "Último"
                    },
                    "aria": {
                        "sortAscending": ": Ordenar colunas de forma ascendente",
                        "sortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        },
                        "1": "%d linha selecionada",
                        "_": "%d linhas selecionadas",
                        "cells": {
                            "1": "1 célula selecionada",
                            "_": "%d células selecionadas"
                        },
                        "columns": {
                            "1": "1 coluna selecionada",
                            "_": "%d colunas selecionadas"
                        }
                    },
                    "buttons": {
                        "copySuccess": {
                            "1": "Uma linha copiada com sucesso",
                            "_": "%d linhas copiadas com sucesso"
                        },
                        "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                        "colvis": "Visibilidade da Coluna",
                        "colvisRestore": "Restaurar Visibilidade",
                        "copy": "Copiar",
                        "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
                        "copyTitle": "Copiar para a Área de Transferência",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pageLength": {
                            "-1": "Mostrar todos os registros",
                            "1": "Mostrar 1 registro",
                            "_": "Mostrar %d registros"
                        },
                        "pdf": "PDF",
                        "print": "Imprimir"
                    },
                    "autoFill": {
                        "cancel": "Cancelar",
                        "fill": "Preencher todas as células com",
                        "fillHorizontal": "Preencher células horizontalmente",
                        "fillVertical": "Preencher células verticalmente"
                    },
                    "lengthMenu": "Exibir _MENU_ resultados por página",
                    "searchBuilder": {
                        "add": "Adicionar Condição",
                        "button": {
                            "0": "Construtor de Pesquisa",
                            "_": "Construtor de Pesquisa (%d)"
                        },
                        "clearAll": "Limpar Tudo",
                        "condition": "Condição",
                        "conditions": {
                            "date": {
                                "after": "Depois",
                                "before": "Antes",
                                "between": "Entre",
                                "empty": "Vazio",
                                "equals": "Igual",
                                "not": "Não",
                                "notBetween": "Não Entre",
                                "notEmpty": "Não Vazio"
                            },
                            "number": {
                                "between": "Entre",
                                "empty": "Vazio",
                                "equals": "Igual",
                                "gt": "Maior Que",
                                "gte": "Maior ou Igual a",
                                "lt": "Menor Que",
                                "lte": "Menor ou Igual a",
                                "not": "Não",
                                "notBetween": "Não Entre",
                                "notEmpty": "Não Vazio"
                            },
                            "string": {
                                "contains": "Contém",
                                "empty": "Vazio",
                                "endsWith": "Termina Com",
                                "equals": "Igual",
                                "not": "Não",
                                "notEmpty": "Não Vazio",
                                "startsWith": "Começa Com"
                            }
                        },
                        "data": "Data",
                        "deleteTitle": "Excluir regra de filtragem",
                        "logicAnd": "E",
                        "logicOr": "Ou",
                        "title": {
                            "0": "Construtor de Pesquisa",
                            "_": "Construtor de Pesquisa (%d)"
                        },
                        "value": "Valor"
                    },
                    "searchPanes": {
                        "clearMessage": "Limpar Tudo",
                        "collapse": {
                            "0": "Painéis de Pesquisa",
                            "_": "Painéis de Pesquisa (%d)"
                        },
                        "count": "{total}",
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Nenhum Painel de Pesquisa",
                        "loadMessage": "Carregando Painéis de Pesquisa...",
                        "title": "Filtros Ativos"
                    },
                    "searchPlaceholder": "Digite um termo para pesquisar",
                    "thousands": "."
                }
            });

            $('.check-atividade').change(function() {
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                var id = $(this).val();
                $.ajax({
                    url: '/dashboard/academia/atividade/ativo/troca/' + id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data == "ativado") {
                            toastr.success('Atividade ativada', 'Sucesso', {
                                timeOut: 1000
                            })
                        } else {
                            toastr.success('Atividade desativada', 'Sucesso', {
                                timeOut: 1000
                            })
                        }
                    },
                });
                return false;
            });
        });

    </script>
@endsection
