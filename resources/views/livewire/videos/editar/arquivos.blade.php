<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">   
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-start">
                            <button type="button" class="btn btn-primary" onclick="Livewire.emit('carregaModalCadastroArquivos')">Adicionar Arquivo</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <table class="table table-hover table-responsive" style="vertical-align: middle;">
                                <thead class="thead-default">
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Nome</th>
                                        <th>Arquivo</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($arquivos as $arquivo)
                                            <tr>
                                                <td scope="row" style="font-size: 25px;">{!! config('documentos.icones')[$arquivo->tipo] !!}</td>
                                                <td>{{ $arquivo->nome }}</td>
                                                <td><a name="" id="" class="btn btn-primary" href="{{ asset($arquivo->caminho) }}" target="_blank" role="button">Visualizar</a></td>
                                                <td style="font-size: 16px;">
                                                    <i class="bx bx-edit-alt text-warning cpointer" onclick="Livewire.emit('carregaModalEdicaoArquivos', {{ $arquivo->id }})"></i>
                                                    <i class="bx bx-trash-alt ms-3 text-danger cpointer" wire:click="removerArquivo({{ $arquivo->id }})"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>          
                
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    
    <!-- end col -->
</div>