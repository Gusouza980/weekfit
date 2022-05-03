<div class="modal fade" id="modalCadastroArquivos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar'>
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="titulo">Nome do Arquivo *</label>
                            <input type="text" class="form-control" name="titulo"
                                id="titulo" maxlength="50" required wire:model="nome">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-12">
                            <label for="categoria"
                                class="form-label">Tipo de Arquivo *</label>
                            <select id="categoria" name="categoria"
                                class="form-select" wire:model="tipo">
                                @foreach(config("documentos.tipos") as $key => $tipo)
                                    <option value="{{$key}}" >{{$tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-12">
                            <label for="" class="form-label"></label>
                            <input type="file" class="form-control mt-2" name="" id="" placeholder="" wire:model="caminho">
                            <small>{{ $caminho }}</small>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                          <button type="submit" name="" id="" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push("scripts")
    <script>
        window.addEventListener('abreModalCadastroArquivos', (event) => {
            $('#modalCadastroArquivos').modal("show")
        })

        window.addEventListener('fechaModalCadastroArquivos', (event) => {
            $('#modalCadastroArquivos').modal("hide")
        })
    </script>
@endpush