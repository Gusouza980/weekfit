@extends('painel.template.main')

@section('titulo')
    Cadastro de Academia
@endsection

@section('conteudo')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-left my-3" style="color:red;">
                        * Campos obrigatórios
                    </div>
                </div>
                <h4 class="card-title mb-4">Informações Básicas</h4>

                <form action="{{route('painel.academia.cadastrar')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Academia *</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email da Academia *</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone da Academia *</label>
                                <input type="text" class="form-control" name="telefone" id="telefone" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control" name="rua" id="rua">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" name="numero" id="numero">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-select">
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
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" name="cep" id="cep">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title mb-4 mt-4">Informações do Proprietário</h4>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="nome_proprietario" class="form-label">Nome *</label>
                                <input type="text" class="form-control" name="nome_proprietario" id="nome_proprietario" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="email_proprietario" class="form-label">Email *</label>
                                <input type="email" class="form-control" name="email_proprietario" id="email_proprietario" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="telefone_proprietario" class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone_proprietario" id="telefone_proprietario">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="usuario_proprietario" class="form-label">Usuário *</label>
                                <input type="text" class="form-control" name="usuario_proprietario" id="usuario_proprietario" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title mb-4 mt-4">Redes Sociais e Website</h4>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="url" class="form-label">Url do Website</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="facebook">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="linkedin" class="form-label">Linkedin</label>
                                <input type="text" class="form-control" name="linkedin" id="linkedin">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="pinterest" class="form-label">Pinterest</label>
                                <input type="text" class="form-control" name="pinterest" id="pinterest">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="youtube" class="form-label">Youtube</label>
                                <input type="text" class="form-control" name="youtube" id="youtube">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="google_negocio" class="form-label">Google Meu Negócio</label>
                                <input type="text" class="form-control" name="google_negocio" id="google_negocio">
                            </div>
                        </div>
                    </div>
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