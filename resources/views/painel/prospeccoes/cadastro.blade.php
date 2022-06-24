@extends('painel.template.main')

@section('titulo')
    Cadastro de Prospecção
@endsection

@section('conteudo')

@include('painel.includes.errors')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-left my-3" style="color:red;">
                        * Campos obrigatórios
                    </div>
                </div>
                <form action="{{route('painel.prospeccao.cadastrar')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-lg-4">
                            <label for="nome">Nome Fantasia *</label>
                            <input type="text" class="form-control" name="nome"
                                id="nome" maxlength="250" required>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="gestor">Gestor</label>
                            <input type="text" class="form-control" name="gestor"
                                id="gestor" maxlength="100"> 
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                                id="email" maxlength="100"> 
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-4">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" name="cidade"
                                id="cidade" maxlength="50">
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="estado"
                                class="form-label">Estado *</label>
                            <select id="estado" name="estado"
                                class="form-select">
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                <option value="EX">Estrangeiro</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="contato">Contato</label>
                            <input type="text" class="form-control" name="contato"
                                id="contato" maxlength="100">
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn btn-primary px-5">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection

@section('scripts')
@endsection