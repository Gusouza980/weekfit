@extends('painel.template.main')

@section('titulo')
    Editando Academia: {{$academia->nome}}
@endsection

@section('conteudo')
@include('painel.includes.errors')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Informações Básicas</h4>

                <form action="{{route('painel.academia.salvar', ['academia' => $academia])}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Academia *</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{$academia->nome}}" required>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email da Academia *</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$academia->email}}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone da Academia *</label>
                                <input type="text" class="form-control" name="telefone" id="telefone" value="{{$academia->telefone}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control" name="rua" id="rua" value="{{$academia->rua}}" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" name="numero" id="numero" value="{{$academia->numero}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" value="{{$academia->bairro}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="cidade" value="{{$academia->cidade}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-select">
                                    <option value="AC" @if($academia->estado == "AC") selected @endif>Acre</option>
                                    <option value="AL" @if($academia->estado == "AL") selected @endif>Alagoas</option>
                                    <option value="AP" @if($academia->estado == "AP") selected @endif>Amapá</option>
                                    <option value="AM" @if($academia->estado == "AM") selected @endif>Amazonas</option>
                                    <option value="BA" @if($academia->estado == "BA") selected @endif>Bahia</option>
                                    <option value="CE" @if($academia->estado == "CE") selected @endif>Ceará</option>
                                    <option value="DF" @if($academia->estado == "DF") selected @endif>Distrito Federal</option>
                                    <option value="ES" @if($academia->estado == "ES") selected @endif>Espírito Santo</option>
                                    <option value="GO" @if($academia->estado == "GO") selected @endif>Goiás</option>
                                    <option value="MA" @if($academia->estado == "MA") selected @endif>Maranhão</option>
                                    <option value="MT" @if($academia->estado == "MT") selected @endif>Mato Grosso</option>
                                    <option value="MS" @if($academia->estado == "MS") selected @endif>Mato Grosso do Sul</option>
                                    <option value="MG" @if($academia->estado == "MG") selected @endif>Minas Gerais</option>
                                    <option value="PA" @if($academia->estado == "PA") selected @endif>Pará</option>
                                    <option value="PB" @if($academia->estado == "PB") selected @endif>Paraíba</option>
                                    <option value="PR" @if($academia->estado == "PR") selected @endif>Paraná</option>
                                    <option value="PE" @if($academia->estado == "PE") selected @endif>Pernambuco</option>
                                    <option value="PI" @if($academia->estado == "PI") selected @endif>Piauí</option>
                                    <option value="RJ" @if($academia->estado == "RJ") selected @endif>Rio de Janeiro</option>
                                    <option value="RN" @if($academia->estado == "RN") selected @endif>Rio Grande do Norte</option>
                                    <option value="RS" @if($academia->estado == "RS") selected @endif>Rio Grande do Sul</option>
                                    <option value="RO" @if($academia->estado == "RO") selected @endif>Rondônia</option>
                                    <option value="RR" @if($academia->estado == "RR") selected @endif>Roraima</option>
                                    <option value="SC" @if($academia->estado == "SC") selected @endif>Santa Catarina</option>
                                    <option value="SP" @if($academia->estado == "SP") selected @endif>São Paulo</option>
                                    <option value="SE" @if($academia->estado == "SE") selected @endif>Sergipe</option>
                                    <option value="TO" @if($academia->estado == "TO") selected @endif>Tocantins</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" name="cep" id="cep" value="{{$academia->cep}}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title mb-4 mt-4">Informações do Proprietário</h4>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="nome_proprietario" class="form-label">Nome *</label>
                                <input type="text" class="form-control" name="nome_proprietario" id="nome_proprietario" value="{{$academia->proprietario[0]->nome}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="email_proprietario" class="form-label">Email *</label>
                                <input type="email" class="form-control" name="email_proprietario" id="email_proprietario" value="{{$academia->proprietario[0]->email}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="telefone_proprietario" class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone_proprietario" id="telefone_proprietario" value="{{$academia->proprietario[0]->telefone}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="usuario_proprietario" class="form-label">Usuário *</label>
                                <input type="text" class="form-control" name="usuario_proprietario" id="usuario_proprietario" value="{{$academia->proprietario[0]->usuario}}" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title mb-4 mt-4">Redes Sociais e Website</h4>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="url" class="form-label">Url do Website</label>
                                <input type="text" class="form-control" name="url" id="url" value="{{$academia->url}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" value="{{$academia->facebook}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="linkedin" class="form-label">Linkedin</label>
                                <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{$academia->linkedin}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" value="{{$academia->instagram}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="pinterest" class="form-label">Pinterest</label>
                                <input type="text" class="form-control" name="pinterest" id="pinterest" value="{{$academia->pinterest}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="youtube" class="form-label">Youtube</label>
                                <input type="text" class="form-control" name="youtube" id="youtube" value="{{$academia->youtube}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="google_negocio" class="form-label">Google Meu Negócio</label>
                                <input type="text" class="form-control" name="google_negocio" id="google_negocio" value="{{$academia->google_negocio}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 text-left" style="color:red;">
                            * Campos obrigatórios
                        </div>
                        <div class="col-12 col-lg-6" style="text-align: right;">
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