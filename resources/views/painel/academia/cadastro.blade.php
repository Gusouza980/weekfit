@extends('painel.template.main')

@section('titulo')
    Cadastro de Academia
@endsection

@section('conteudo')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <a name="" id="" class="btn btn-primary" href="{{route('painel.academias')}}" role="button">Voltar</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-left my-3" style="color:red;">
                        * Campos obrigatórios
                    </div>
                </div>
                <h4 class="card-title mb-4">Informações Básicas</h4>

                <form action="{{route('painel.academia.cadastrar')}}" method="POST" enctype="multipart/form-data">
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

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo">
                                <small>Usado como referência para o outro sistema</small>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="mb-3">
                                <label for="ativo" class="form-label">Ativo</label>
                                <select class="form-select" name="ativo">
                                    <option value="0">Não</option>
                                    <option value="1" selected>Sim</option>
                                </select>
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
                        <div class="col-lg-3 col-12">
                            <div class="mb-3">
                                <label for="usuario_proprietario" class="form-label">Usuário *</label>
                                <input type="text" class="form-control" name="usuario_proprietario" id="usuario_proprietario" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="mb-3">
                                <label for="senha_proprietario" class="form-label">Senha *</label>
                                <input type="password" class="form-control" name="senha_proprietario" id="senha_proprietario" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4 class="card-title mb-4 mt-4">Chaves</h4>
                    
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="login_sistema" class="form-label">Login do sistema</label>
                                <input type="text" class="form-control" name="login_sistema" id="login_sistema">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="senha_sistema" class="form-label">Senha do sistema</label>
                                <input type="text" class="form-control" name="senha_sistema" id="senha_sistema">
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="login_google" class="form-label">Email Google</label>
                                <input type="text" class="form-control" name="login_google" id="login_google">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="senha_google" class="form-label">Senha do email</label>
                                <input type="text" class="form-control" name="senha_google" id="senha_google">
                            </div>
                        </div>

                    </div>

                    <hr>

                    <h4 class="card-title mb-4 mt-4">Links e Credenciais</h4>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="url" class="form-label">Url do Website</label>
                                <input type="text" class="form-control" name="url" id="url">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">Whatsapp</label>
                                <input type="text" class="form-control" name="whatsapp" id="whatsapp">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="painel" class="form-label">Url do Painel</label>
                                <input type="text" class="form-control" name="painel" id="painel">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="aplicativo" class="form-label">Url do Aplicativo</label>
                                <input type="text" class="form-control" name="aplicativo" id="aplicativo">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="facebook">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_facebook" class="form-label">Login do facebook</label>
                                <input type="text" class="form-control" name="login_facebook" id="login_facebook">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_facebook" class="form-label">Senha do facebook</label>
                                <input type="text" class="form-control" name="senha_facebook" id="senha_facebook">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="linkedin" class="form-label">Linkedin</label>
                                <input type="text" class="form-control" name="linkedin" id="linkedin">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_linkedin" class="form-label">Login do linkedin</label>
                                <input type="text" class="form-control" name="login_linkedin" id="login_linkedin">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_linkedin" class="form-label">Senha do linkedin</label>
                                <input type="text" class="form-control" name="senha_linkedin" id="senha_linkedin">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_instagram" class="form-label">Login do instagram</label>
                                <input type="text" class="form-control" name="login_instagram" id="login_instagram">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_instagram" class="form-label">Senha do instagram</label>
                                <input type="text" class="form-control" name="senha_instagram" id="senha_instagram">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="pinterest" class="form-label">Pinterest</label>
                                <input type="text" class="form-control" name="pinterest" id="pinterest">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_pinterest" class="form-label">Login do pinterest</label>
                                <input type="text" class="form-control" name="login_pinterest" id="login_pinterest">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_pinterest" class="form-label">Senha do pinterest</label>
                                <input type="text" class="form-control" name="senha_pinterest" id="senha_pinterest">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" name="twitter" id="twitter">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_twitter" class="form-label">Login do twitter</label>
                                <input type="text" class="form-control" name="login_twitter" id="login_twitter">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_twitter" class="form-label">Senha do twitter</label>
                                <input type="text" class="form-control" name="senha_twitter" id="senha_twitter">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="youtube" class="form-label">Youtube</label>
                                <input type="text" class="form-control" name="youtube" id="youtube">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_youtube" class="form-label">Login do youtube</label>
                                <input type="text" class="form-control" name="login_youtube" id="login_youtube">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_youtube" class="form-label">Senha do youtube</label>
                                <input type="text" class="form-control" name="senha_youtube" id="senha_youtube">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="google_negocio" class="form-label">Google Meu Negócio</label>
                                <input type="text" class="form-control" name="google_negocio" id="google_negocio">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_google_negocio" class="form-label">Login do Google Meu Negócio</label>
                                <input type="text" class="form-control" name="login_google_negocio" id="login_google_negocio">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_google_negocio" class="form-label">Senha do Google Meu Negócio</label>
                                <input type="text" class="form-control" name="senha_google_negocio" id="senha_google_negocio">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="tiktok" class="form-label">Tiktok</label>
                                <input type="text" class="form-control" name="tiktok" id="tiktok">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="login_tiktok" class="form-label">Login do Tiktok</label>
                                <input type="text" class="form-control" name="login_tiktok" id="login_tiktok">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="mb-3">
                                <label for="senha_tiktok" class="form-label">Senha do Tiktok</label>
                                <input type="text" class="form-control" name="senha_tiktok" id="senha_tiktok">
                            </div>
                        </div>
                        
                    </div>
                    <hr>

                    <div class="row">
                        <h4 class="card-title mb-4 mt-4">Informações de Contrato</h4>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="inicio_contrato" class="form-label">Início do Contrato</label>
                                <input type="date" class="form-control" name="inicio_contrato" id="inicio_contrato">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="fim_contrato" class="form-label">Fim do Contrato</label>
                                <input type="date" class="form-control" name="fim_contrato" id="fim_contrato">
                            </div>
                        </div>

                    </div>
                    <hr>
                    
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title mb-4 mt-4">Logo</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <img id="logo-preview" src="{{asset('admin/images/logos/padrao.png')}}" style="width: 100%; max-width:200px;" alt="">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <label class="btn btn-primary" for="logo-upload">Escolher</label>
                                    <input name="logo" id="logo-upload" style="display: none;" type="file">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <small style="color: red;">* Importante: Caso a logo tenha elementos brancos, coloque um fundo de outra cor.</small>
                                </div>
                            </div>
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
    <script>
        var inp = document.getElementById('logo-upload');
        inp.addEventListener('change', function(e){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById('logo-preview').src = this.result;
                };
            reader.readAsDataURL(file);
        },false);
    </script>
@endsection