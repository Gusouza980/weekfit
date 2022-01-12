@extends('painel.template.main')

@section('styles')
    <!-- DataTables -->
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Leads: {{date("d/m/Y", strtotime($inicio))}} - {{date("d/m/Y", strtotime($fim))}}
@endsection

@section('botoes')
    <form action="{{route('dashboard.leads')}}" method="POST">
        @csrf
        <div class="row justify-content-end">
            <div class="form-group" style="width: 200px;">
                <label for="">Início</label>
                <input type="date" name="inicio" id="" class="form-control" value="{{date('Y-m-d', strtotime($inicio))}}" placeholder="" aria-describedby="helpId">
            </div>
            {{-- / --}}
            <div class="form-group" style="width: 200px;">
                <label for="">Fim</label>
                <input type="date" name="fim" id="" class="form-control" value="{{date('Y-m-d', strtotime($fim))}}" placeholder="" max="{{date('Y-m-t')}}" aria-describedby="helpId">
            </div>
            <div class="form-group" style="width: 100px;">
                <button class="btn btn-primary mt-4">Filtrar</button>
            </div>
        </div>
        
    </form>
@endsection

@section('conteudo')
<div class="row mt-3">
    <div class="col-12 col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted fw-medium">Aguardando</p>
                        <h4 class="mb-0">{{$leads->where("status", 0)->count()}}</h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-laranja align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-time-five font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted fw-medium">Conversando</p>
                        <h4 class="mb-0">{{$leads->where("status", 1)->count()}}</h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-laranja align-self-center">
                        <span class="avatar-title">
                            <i class="bx bxs-chat font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted fw-medium">Convertido</p>
                        <h4 class="mb-0">{{$leads->where("status", 2)->count()}}</h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-laranja align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-check-double font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="overflow-x: scroll;">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>Formulário</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach($leads as $lead)
                            <tr>
                                <td style="vertical-align: middle;">{{$lead->formulario}}</td>
                                <td style="vertical-align: middle;">{{$lead->nome}}</td>
                                <td style="vertical-align: middle;">{{$lead->email}}</td>
                                <td style="vertical-align: middle;">{{$lead->celular}}</td>
                                <td style="vertical-align: middle;">{{$lead->ip_uf}}</td>
                                <td style="vertical-align: middle;">{{$lead->ip_cidade}}</td>
                                <td style="vertical-align: middle;">{{date("d/m/Y H:i:s", strtotime($lead->created_at))}}</td>
                                <td style="vertical-align: middle;">
                                    <select class="form-control" name="status" lid="{{$lead->id}}" id="">
                                        @foreach(config("globals.lead_status") as $key => $status)
                                            <option value="{{$key}}" @if($lead->status == $key) selected @endif>{{$status}}</option>
                                        @endforeach
                                    </select>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="{{asset('admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.10/sorting/datetime-moment.js"></script>
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment( 'DD/MM/YYYY HH:mm:ss' );    //Formatação com Hora
            $.fn.dataTable.moment('DD/MM/YYYY');    //Formatação sem Hora
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
                },
                order: [[6, "desc"]] 
            } );
            $("select[name='status']").change(function(){
                var status = $(this).val();
                var lead = $(this).attr("lid");
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });
                var id = $(this).val();
                $.ajax({
                    url: "{!! route('dashboard.lead.status.alterar') !!}",
                    type: 'POST',
                    data: {
                        status: status,
                        lead: lead
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data == 200) {
                            toastr.success('Status alterado com sucesso', 'Sucesso', {
                                timeOut: 1000
                            })
                        }
                    },
                });
            })
        } );    
    </script> 
@endsection