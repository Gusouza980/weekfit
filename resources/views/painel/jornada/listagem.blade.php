@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Listagem de Atividades da Jornada
@endsection 

@section('conteudo')
<div class="row">
    <div class="col-12">
        <a name="" id="" class="btn btn-primary" href="{{route('painel.configuracoes.grupos')}}" role="button">Voltar</a>
        <a name="" id="" class="btn btn-primary ml-3" data-bs-toggle="modal" data-bs-target="#modalNovaAtividade" role="button">Nova Atividade</a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body"  style="overflow-x: scroll;">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#mes1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 1</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mes2" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 2</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mes3" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 3</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mes4" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 4</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mes5" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 5</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mes6" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 6</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#mes7" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Mês 7</span>    
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content p-3 text-muted">
                    @for($i = 1; $i <= 7; $i++)
                        <div class="tab-pane @if($i == 1) active @endif" id="mes{{$i}}" role="tabpanel" style="overflow-x: scroll;">
                            <table id="datatable" class="datatable table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Descrição</th>
                                        <th>Semana</th>
                                        <th>Departamento</th>
                                        <th>Responsável</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach($atividades->where("mes", $i) as $atividade)
                                        <tr>
                                            <td>
                                                <div class="dropdown mt-4 mt-sm-0">
                                                    <a href="#" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-bars" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu" style="margin: 0px;">
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditaAtividade{{$atividade->id}}" role="button"><i class="bx bx-edit-alt"></i> Editar</a>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalExcluiAtividade{{$atividade->id}}" role="button"><i class="bx bx-trash-alt"></i> Excluir</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><b>{{$atividade->titulo}}</b><br>{{$atividade->descricao}}</td>
                                            <td>{{$atividade->semana}}</td>
                                            <td>{{config("globals.departamentos")[$atividade->departamento]}}</td>
                                            <td>{{config("globals.responsaveis")[$atividade->responsavel]}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@foreach($atividades as $atividade)
    <div class="modal fade" id="modalEditaAtividade{{$atividade->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaatividade{{$atividade->id}}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('painel.configuracoes.jornada.atividade.salvar', ['atividade' => $atividade])}}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="form-group col-12">
                                <label for="titulo">Título</label>
                                <input class="form-control" name="titulo" maxlength="255" value="{{$atividade->titulo}}" required/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-12">
                                <label for="nome">Descrição</label>
                                <textarea class="form-control" name="descricao" required>{!! $atividade->descricao !!}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-12 col-lg-6">
                                <label for="texto_link">Texto do Link (Vídeo)</label>
                                <input class="form-control" name="texto_link" value="{{$atividade->texto_link}}" maxlength="255"/>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="link">Link (Vídeo)</label>
                                <input class="form-control" name="link" value="{{$atividade->link}}" maxlength="255"/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-12 col-lg-6">
                                <label for="texto_link">Texto do Link (Material)</label>
                                <input class="form-control" name="texto_link_material" value="{{$atividade->texto_link_material}}" maxlength="255"/>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="link">Link (Material)</label>
                                <input class="form-control" name="link_material" value="{{$atividade->link_material}}" maxlength="255"/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-12 col-lg-3">
                                <label for="link">Mês</label>
                                <select class="form-control" name="mes">
                                    @for($i = 1; $i <= 7; $i++)
                                        <option value="{{$i}}" @if($atividade->mes == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-3">
                                <label for="">Semana</label>
                                <select class="form-control" name="semana">
                                    @for($i = 1; $i <= 4; $i++)
                                        <option value="{{$i}}" @if($atividade->semana == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-3">
                                <label for="">Departamento</label>
                                <select class="form-control" name="departamento">
                                    @foreach(config("globals.departamentos") as $chave => $departamento)
                                        <option value="{{$chave}}" @if($atividade->departamento == $chave) selected @endif>{{$departamento}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-3">
                                <label for="">Responsável</label>
                                <select class="form-control" name="responsavel">
                                    @foreach(config("globals.responsaveis") as $chave => $responsavel)
                                        <option value="{{$chave}}" @if($atividade->responsavel == $chave) selected @endif>{{$responsavel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-check form-checkbox-outline form-check-danger col-12">
                                    <input class="form-check-input" name="importancia" type="checkbox" value="1" @if($atividade->importancia > 0) checked @endif>
                                    <label class="form-check-label" for="customCheckcolor5">
                                        Atividade Importante
                                    </label>
                                </div>
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
    <div class="modal fade" id="modalExcluiAtividade{{$atividade->id}}" tabindex="-1" role="dialog" aria-labelledby="modalExcluiAtividade{{$atividade->id}}Label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h5>Deseja realmente excluir essa atividade ?</h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a name="" id="" class="btn btn-danger" href="{{route('painel.configuracoes.jornada.atividade.deletar', ['atividade' => $atividade])}}" role="button">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="modal fade" id="modalNovaAtividade" tabindex="-1" role="dialog" aria-labelledby="modalNovaAtividadeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('painel.configuracoes.jornada.atividade.cadastrar')}}" method="post">
                    @csrf
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="titulo">Título</label>
                            <input class="form-control" name="titulo" maxlength="255"/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="nome">Descrição</label>
                            <textarea class="form-control" name="descricao"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-6">
                            <label for="texto_link">Texto do Link (Vídeo)</label>
                            <input class="form-control" name="texto_link" maxlength="255"/>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="link">Link (Vídeo)</label>
                            <input class="form-control" name="link" maxlength="255"/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-6">
                            <label for="texto_link">Texto do Link (Material)</label>
                            <input class="form-control" name="texto_link_material" maxlength="255"/>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="link">Link (Material)</label>
                            <input class="form-control" name="link_material" maxlength="255"/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-3">
                            <label for="link">Mês</label>
                            <select class="form-control" name="mes">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-3">
                            <label for="">Semana</label>
                            <select class="form-control" name="semana">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-3">
                            <label for="">Departamento</label>
                            <select class="form-control" name="departamento">
                                @foreach(config("globals.departamentos") as $chave => $departamento)
                                    <option value="{{$chave}}">{{$departamento}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-3">
                            <label for="">Responsável</label>
                            <select class="form-control" name="responsavel">
                                @foreach(config("globals.responsaveis") as $chave => $responsavel)
                                    <option value="{{$chave}}">{{$responsavel}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-check form-checkbox-outline form-check-danger col-12">
                                <input class="form-check-input" name="importancia" type="checkbox" value="1">
                                <label class="form-check-label" for="customCheckcolor5">
                                    Atividade Importante
                                </label>
                            </div>
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
            $('.datatable').DataTable( {
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
                }, 
                order: [[ 2, "asc" ]]
            } );
        } );    
    </script> 
@endsection