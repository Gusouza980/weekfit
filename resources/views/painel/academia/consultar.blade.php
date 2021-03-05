@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Listagem de Academias
@endsection

@section('botoes')
<a name="" id="" class="btn btn-success" href="{{route('painel.academia.cadastro')}}" role="button">Nova academia</a>
<a name="" id="" class="btn btn-primary" href="{{route('painel.academia.totais.atualizar')}}" role="button">Atualizar Dados</a>
@endsection

@section('conteudo')
{{-- <div class="row">
    <div class="col-12 text-end">
        
    </div>
</div> --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="overflow-x: scroll;">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Usuários</th>
                            <th>Nível</th>
                            <th>Ger</th>
                            <th>Adm</th>
                            <th>Tec</th>
                            <th>Com</th>
                            <th>Mkt</th>
                            <th></th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($academias as $academia)
                            <tr>
                                <td>{{$academia->codigo}}</td>
                                <td>{{$academia->nome}}</td>
                                <td>{{$academia->email}}</td>
                                <td>{{$academia->telefone}}</td>
                                <td>{{$academia->usuarios()->count()}}</td>
                                <td>
                                    <select class="form-control select_nivel" name="select_nivel{{$academia->id}}" academia="{{$academia->id}}">
                                        <option value="0" @if($academia->nivel == 0) selected @endif>0</option>
                                        <option value="1" @if($academia->nivel == 1) selected @endif>1</option>
                                        <option value="2" @if($academia->nivel == 2) selected @endif>2</option>
                                        <option value="3" @if($academia->nivel == 3) selected @endif>3</option>
                                        <option value="4" @if($academia->nivel == 4) selected @endif>4</option>
                                    </select>
                                </td>
                                <td>{{number_format($academia->total_geral, 2)}}%</td>
                                <td>{{number_format($academia->total_administrativo, 2)}}%</td>
                                <td>{{number_format($academia->total_tecnico, 2)}}%</td>
                                <td>{{number_format($academia->total_comercial, 2)}}%</td>
                                <td>{{number_format($academia->total_marketing, 2)}}%</td>
                                <td>
                                    <a name="" id="" class="btn btn-warning" href="{{route('painel.academia.edicao', ['academia' => $academia])}}" role="button">Editar</a>
                                    <a class="mx-3" href="{{route('painel.academia.visualizar', ['academia' => $academia])}}"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

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


            $(".select_nivel").change(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                var academia = $(this).attr("academia");
                var nivel = $(this).val();

                $.ajax({
                    url: '/dashboard/academia/nivel/alterar/' + academia,
                    type: 'POST',
                    data: {
                        nivel: nivel
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data == "sucesso") {
                            toastr.success('Nível alterado com sucesso', 'Sucesso', {
                                timeOut: 1000
                            })
                        } else {
                            toastr.success('Erro ao alterar o nível da academia', 'Erro', {
                                timeOut: 3000
                            })
                        }
                    },
                });
            });

            
        } );    
    </script> 
@endsection