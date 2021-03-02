@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Listagem de Atividades do Grupo {{$grupo->nome}}
@endsection

@section('conteudo')
<div class="row">
    <div class="col-12">
        <a name="" id="" class="btn btn-primary" href="{{route('painel.configuracoes.grupos')}}" role="button">Voltar</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#subgrupos" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Subgrupos</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#atividades" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Atividades</span>    
                        </a>
                    </li>
                    
                </ul>

                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="subgrupos" role="tabpanel">
                        <a name="" id="" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalNovoSubgrupo" role="button">Novo Subgrupo</a>

                        <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Atividades</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach($grupo->subgrupos as $subgrupo)
                                    <tr>
                                        <td>{{$subgrupo->nome}}</td>
                                        <td>{{$subgrupo->atividades()->count()}}</td>
                                        <td>
                                            <a name="" id="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditaSubgrupo{{$subgrupo->id}}" role="button">Editar</a>
                                            <a name="" id="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalExcluiSubgrupo{{$subgrupo->id}}" role="button">Excluir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="atividades" role="tabpanel">
                        <a name="" id="" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalNovaAtividade" role="button">Nova atividade</a>

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Link</th>
                                    <th>Subgrupo</th>
                                    <th>Nível</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach($grupo->subgrupos as $subgrupo)
                                    @foreach($subgrupo->atividades as $atividade)
                                        <tr>
                                            <td style='color: {{config('globals.importancia')[$atividade->importancia]}} !important'>{{$atividade->nome}}</td>
                                            <td>
                                                @if($atividade->link)
                                                    <a href="{{$atividade->link}}">{{$atividade->texto_link}}</a>
                                                @endif
                                            </td>
                                            <td>{{$atividade->subgrupo->nome}}</td>
                                            <td>{{$atividade->nivel}}</td>
                                            <td>
                                                <a name="" id="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditaAtividade{{ $atividade->id }}" role="button">Editar</a>
                                                <a name="" id="" class="btn btn-danger" href="{{route('painel.configuracoes.atividade.deletar', ['atividade' => $atividade])}}" role="button">Excluir</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@foreach($grupo->subgrupos as $subgrupo)
    @foreach($subgrupo->atividades as $atividade)
        <div class="modal fade" id="modalEditaAtividade{{$atividade->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaAtividade{{$atividade->id}}Label"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{route('painel.configuracoes.atividade.salvar', ['atividade' => $atividade])}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="nome"
                                        id="nome" aria-describedby="helpId" 
                                        value="{{$atividade->nome}}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" name="link"
                                        id="link" aria-describedby="helpId" 
                                        value="{{$atividade->link}}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12">
                                    <label for="texto_link">Texto Link</label>
                                    <input type="text" class="form-control" name="texto_link"
                                        id="texto_link" aria-describedby="helpId" 
                                        value="{{$atividade->texto_link}}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12">
                                    <label for="subgrupo_id"
                                        class="form-label">Subgrupo</label>
                                    <select id="subgrupo_id" name="subgrupo_id"
                                        class="form-select">
                                        @foreach($grupo->subgrupos as $subgrupo)
                                            <option value="{{$subgrupo->id}}" @if($subgrupo->id == $atividade->subgrupo_id) selected @endif>{{$subgrupo->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12">
                                    <label for="importancia"
                                        class="form-label">Importância</label>
                                    <select id="importancia" name="importancia"
                                        class="form-select">
                                        <option value="0" @if($atividade->importancia == 0) selected @endif>Básico</option>
                                        <option value="1" @if($atividade->importancia == 1) selected @endif>Importante</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-12">
                                    <label for="nivel"
                                        class="form-label">Nível</label>
                                    <select id="nivel" name="nivel"
                                        class="form-select">
                                        <option value="0" @if($atividade->nivel == 0) selected @endif>0</option>
                                        <option value="1" @if($atividade->nivel == 1) selected @endif>1</option>
                                        <option value="2" @if($atividade->nivel == 2) selected @endif>2</option>
                                        <option value="3" @if($atividade->nivel == 3) selected @endif>3</option>
                                        <option value="4" @if($atividade->nivel == 4) selected @endif>4</option>
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
@endforeach

@foreach($grupo->subgrupos as $subgrupo)
    <div class="modal fade" id="modalEditaSubgrupo{{$subgrupo->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaSubgrupo{{$subgrupo->id}}Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('painel.configuracoes.subgrupo.salvar', ['subgrupo' => $subgrupo])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome"
                                    id="nome" aria-describedby="helpId" 
                                    value="{{$subgrupo->nome}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-12">
                                <label for="grupo_id"
                                    class="form-label">Grupo</label>
                                <select id="grupo_id" name="grupo_id"
                                    class="form-select">
                                    @foreach(\App\Models\Grupo::all() as $grupo)
                                        <option value="{{$grupo->id}}" @if($grupo->id == $subgrupo->grupo_id) selected @endif>{{$grupo->nome}} - {{config('globals.departamentos')[$grupo->departamento]}}</option>
                                    @endforeach
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
    <div class="modal fade" id="modalExcluiSubgrupo{{$subgrupo->id}}" tabindex="-1" role="dialog" aria-labelledby="modalExcluiSubgrupo{{$subgrupo->id}}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h5>Ao excluir o subgrupo "{{$subgrupo->nome}}" todas as atividades ligadas a ele também serão excluídas. Deseja continuar ?</h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a name="" id="" class="btn btn-danger" href="{{route('painel.configuracoes.subgrupo.deletar', ['subgrupo' => $subgrupo])}}" role="button">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="modal fade" id="modalNovaAtividade" tabindex="-1" role="dialog" aria-labelledby="modalNovaAtividadeLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('painel.configuracoes.atividade.adicionar')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome"
                                id="nome" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" name="link"
                                id="link" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="texto_link">Texto Link</label>
                            <input type="text" class="form-control" name="texto_link"
                                id="texto_link" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="subgrupo_id"
                                class="form-label">Subgrupo</label>
                            <select id="subgrupo_id" name="subgrupo_id"
                                class="form-select">
                                @foreach($grupo->subgrupos as $subgrupo)
                                    <option value="{{$subgrupo->id}}">{{$subgrupo->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="importancia"
                                class="form-label">Importância</label>
                            <select id="importancia" name="importancia"
                                class="form-select">
                                <option value="0">Básico</option>
                                <option value="1">Importante</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="nivel"
                                class="form-label">Nível</label>
                            <select id="nivel" name="nivel"
                                class="form-select">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
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

<div class="modal fade" id="modalNovoSubgrupo" tabindex="-1" role="dialog" aria-labelledby="modalNovoSubgrupoLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('painel.configuracoes.subgrupo.adicionar')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome"
                                id="nome" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="grupo_id"
                                class="form-label">Grupo</label>
                            <select id="grupo_id" name="grupo_id"
                                class="form-select">
                                @foreach(\App\Models\Grupo::all() as $grupo)
                                    <option value="{{$grupo->id}}">{{$grupo->nome}} - {{config('globals.departamentos')[$grupo->departamento]}}</option>
                                @endforeach
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

@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{asset('admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable( {
                language:{
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
            } );
        } );    
    </script> 
@endsection