@extends('painel.template.main')

@section('styles')
    <!-- Sweet Alert-->
    <link href="{{asset('admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Editando Academia: {{$academia->nome}}
@endsection

@section('conteudo')
@include('painel.includes.errors')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-12">
                        <a name="" id="" class="btn btn-primary" href="{{route('painel.academias')}}" role="button">Voltar</a>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(!session()->get('getree')) active @endif" data-bs-toggle="tab" href="#cadastro" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Dados de Cadastro</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session()->get('getree')) active @endif" data-bs-toggle="tab" href="#gefitapp" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Getree</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane @if(!session()->get('getree')) active @endif" id="cadastro" role="tabpanel">
                        <form id="form-edicao" action="{{route('painel.academia.salvar', ['academia' => $academia])}}" method="POST" enctype="multipart/form-data">
                    
                            @csrf
                            <h4 class="card-title mb-4">Informações Básicas</h4>
        
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
        
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="codigo" class="form-label">Código</label>
                                        <input type="text" class="form-control" name="codigo" id="codigo" value="{{$academia->codigo}}">
                                        <small>Usado como referência para o outro sistema</small>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="ativo" class="form-label">Ativo</label>
                                        <select class="form-select" name="ativo">
                                            <option value="0" @if($academia->ativo == 0) selected @endif>Não</option>
                                            <option value="1" @if($academia->ativo == 1) selected @endif>Sim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{$academia->cpf}}" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-3">
                                        <label for="cnpj" class="form-label">CNPJ</label>
                                        <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{$academia->cnpj}}" maxlength="20">
                                    </div>
                                </div>
                            </div>
        
                            <hr>
        
                            <h4 class="card-title mb-4 mt-4">Informações do Proprietário</h4>
        
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="nome_proprietario" class="form-label">Nome *</label>
                                        <input type="text" class="form-control" name="nome_proprietario" id="nome_proprietario" @if(count($academia->proprietario) > 0) value="{{$academia->proprietario[0]->nome}}" @endif required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="email_proprietario" class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email_proprietario" id="email_proprietario" @if(count($academia->proprietario) > 0) value="{{$academia->proprietario[0]->email}}" @endif required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="telefone_proprietario" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="telefone_proprietario" id="telefone_proprietario" @if(count($academia->proprietario) > 0) value="{{$academia->proprietario[0]->telefone}}" @endif>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="mb-3">
                                        <label for="usuario_proprietario" class="form-label">Usuário *</label>
                                        <input type="text" class="form-control" name="usuario_proprietario" id="usuario_proprietario" @if(count($academia->proprietario) > 0) value="{{$academia->proprietario[0]->usuario}}" @endif required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="mb-3">
                                        <label for="senha_proprietario" class="form-label">Senha *</label>
                                        <input type="password" class="form-control" name="senha_proprietario" id="senha_proprietario">
                                        <small>Preencha apenas caso deseje alterar</small>
                                    </div>
                                </div>
                            </div>
        
                            <hr>
        
                            <h4 class="card-title mb-4 mt-4">Observações</h4>
                                <div class="form-group">
                                    <textarea class="form-control" name="observacoes" id="" rows="3">{{$academia->observacoes}}</textarea>
                                </div>
                            <hr>
        
                            <h4 class="card-title mb-4 mt-4">Chaves</h4>
                            
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="login_sistema" class="form-label">Login do sistema</label>
                                        <input type="text" class="form-control" name="login_sistema" id="login_sistema" value="{{$academia->login_sistema}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="senha_sistema" class="form-label">Senha do sistema</label>
                                        <input type="text" class="form-control" name="senha_sistema" id="senha_sistema" value="{{$academia->senha_sistema}}">
                                    </div>
                                </div>
        
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="login_google" class="form-label">Email Google</label>
                                        <input type="text" class="form-control" name="login_google" id="login_google" value="{{$academia->login_google}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="senha_google" class="form-label">Senha do email</label>
                                        <input type="text" class="form-control" name="senha_google" id="senha_google" value="{{$academia->senha_google}}">
                                    </div>
                                </div>
                            </div>

                            <hr>
        
                            <h4 class="card-title mb-4 mt-4">Getree</h4>
                            <div class="row">
                                <div class="col-lg-6 col-10">
                                    <div class="mb-3">
                                        <label for="titulo_getree" class="form-label">Título</label>
                                        <input type="text" class="form-control" name="titulo_getree" id="titulo_getree" maxlength="100" value="{{$academia->titulo_getree}}">
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-10">
                                    <div class="mb-3">
                                        <label for="subtitulo_getree" class="form-label">Subtítulo</label>
                                        <input type="text" class="form-control" name="subtitulo_getree" id="subtitulo_getree" maxlength="250" value="{{$academia->subtitulo_getree}}">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="example-color-input" class="col-form-label">Cor do Título</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-control form-control-color" name="cor_titulo_getree" type="color" value="{{$academia->cor_titulo_getree}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="example-color-input" class="col-form-label">Cor do Subtítulo</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-control form-control-color" name="cor_subtitulo_getree" type="color" value="{{$academia->cor_subtitulo_getree}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="example-color-input" class="col-form-label">Fundo do Cartão</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-control form-control-color mx-2" name="cor_fundo_cartao_getree" type="color" value="{{$academia->cor_fundo_cartao_getree}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="example-color-input" class="col-form-label">Fundo do Cartão (Hover)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-control form-control-color mx-2" name="cor_fundo_cartao_hover_getree" type="color" value="{{$academia->cor_fundo_cartao_hover_getree}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="example-color-input" class="col-form-label">Letra do Cartão</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-control form-control-color mx-2" name="cor_letra_cartao_getree" type="color" value="{{$academia->cor_letra_cartao_getree}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="example-color-input" class="col-form-label">Letra do Cartão (Hover)</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input class="form-control form-control-color mx-2" name="cor_letra_cartao_hover_getree" type="color" value="{{$academia->cor_letra_cartao_hover_getree}}">
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-lg-3 col-12 mt-3">
                                    <div class="mb-3">
                                        <label for="slug_getree" class="form-label">Slug da url</label>
                                        <input type="text" class="form-control" name="slug_getree" id="slug_getree" value="{{$academia->slug_getree}}">
                                        <small>Ex: academiateste</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title mb-4 mt-4">Imagem de Fundo</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @if($academia->fundo_getree)
                                                <img id="fundo_getree-preview" src="{{asset($academia->fundo_getree)}}" style="max-height: 400px;" alt="">
                                            @else
                                                <img id="fundo_getree-preview" src="{{asset('admin/images/logos/padrao.png')}}" style="max-height: 400px;" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <label class="btn btn-primary" for="fundo_getree-upload">Escolher</label>
                                            <input name="fundo_getree" id="fundo_getree-upload" style="display: none;" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
        
                            <h4 class="card-title mb-4 mt-4">Links e Credenciais</h4>
        
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="url" class="form-label">Url do Website</label>
                                        <input type="text" class="form-control" name="url" id="url" value="{{$academia->url}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="whatsapp" class="form-label">Whatsapp</label>
                                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{$academia->whatsapp}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="painel" class="form-label">Url do Painel</label>
                                        <input type="text" class="form-control" name="painel" id="painel" value="{{$academia->painel}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label for="aplicativo" class="form-label">Url do Aplicativo</label>
                                        <input type="text" class="form-control" name="aplicativo" id="aplicativo" value="{{$academia->aplicativo}}">
                                    </div>
                                </div>
                                
                                {{--  FACEBOOK  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{$academia->facebook}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_facebook" class="form-label">Login do facebook</label>
                                        <input type="text" class="form-control" name="login_facebook" id="login_facebook" value="{{$academia->login_facebook}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_facebook" class="form-label">Senha do facebook</label>
                                        <input type="text" class="form-control" name="senha_facebook" id="senha_facebook" value="{{$academia->senha_facebook}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="facebook_getree" @if($academia->facebook_getree) checked @endif >
                                    </div>
                                </div>

                                {{--  LINKEDIN  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="linkedin" class="form-label">Linkedin</label>
                                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{$academia->linkedin}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_linkedin" class="form-label">Login do linkedin</label>
                                        <input type="text" class="form-control" name="login_linkedin" id="login_linkedin" value="{{$academia->login_linkedin}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_linkedin" class="form-label">Senha do linkedin</label>
                                        <input type="text" class="form-control" name="senha_linkedin" id="senha_linkedin" value="{{$academia->senha_linkedin}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="linkedin_getree" @if($academia->linkedin_getree) checked @endif>
                                    </div>
                                </div>

                                {{--  INSTAGRAM  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{$academia->instagram}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_instagram" class="form-label">Login do instagram</label>
                                        <input type="text" class="form-control" name="login_instagram" id="login_instagram" value="{{$academia->login_instagram}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_instagram" class="form-label">Senha do instagram</label>
                                        <input type="text" class="form-control" name="senha_instagram" id="senha_instagram" value="{{$academia->senha_instagram}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="instagram_getree" @if($academia->instagram_getree) checked @endif>
                                    </div>
                                </div>

                                {{--  PINTEREST  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="pinterest" class="form-label">Pinterest</label>
                                        <input type="text" class="form-control" name="pinterest" id="pinterest" value="{{$academia->pinterest}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_pinterest" class="form-label">Login do pinterest</label>
                                        <input type="text" class="form-control" name="login_pinterest" id="login_pinterest" value="{{$academia->login_pinterest}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_pinterest" class="form-label">Senha do pinterest</label>
                                        <input type="text" class="form-control" name="senha_pinterest" id="senha_pinterest" value="{{$academia->senha_pinterest}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="pinterest_getree" @if($academia->pinterest_getree) checked @endif>
                                    </div>
                                </div>

                                {{--  TWITTER  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="twitter" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{$academia->twitter}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_twitter" class="form-label">Login do twitter</label>
                                        <input type="text" class="form-control" name="login_twitter" id="login_twitter" value="{{$academia->login_twitter}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_twitter" class="form-label">Senha do twitter</label>
                                        <input type="text" class="form-control" name="senha_twitter" id="senha_twitter" value="{{$academia->senha_twitter}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="twitter_getree" @if($academia->twitter_getree) checked @endif>
                                    </div>
                                </div>

                                {{--  YOUTUBE  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">Youtube</label>
                                        <input type="text" class="form-control" name="youtube" id="youtube" value="{{$academia->youtube}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_youtube" class="form-label">Login do youtube</label>
                                        <input type="text" class="form-control" name="login_youtube" id="login_youtube" value="{{$academia->login_youtube}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_youtube" class="form-label">Senha do youtube</label>
                                        <input type="text" class="form-control" name="senha_youtube" id="senha_youtube" value="{{$academia->senha_youtube}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="youtube_getree" @if($academia->youtube_getree) checked @endif>
                                    </div>
                                </div>

                                {{--  GOOGLE MEU NEGOCIO  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="google_negocio" class="form-label">Google Meu Negócio</label>
                                        <input type="text" class="form-control" name="google_negocio" id="google_negocio" value="{{$academia->google_negocio}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_google_negocio" class="form-label">Login do Google Meu Negócio</label>
                                        <input type="text" class="form-control" name="login_google_negocio" id="login_google_negocio" value="{{$academia->login_google_negocio}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_google_negocio" class="form-label">Senha do Google Meu Negócio</label>
                                        <input type="text" class="form-control" name="senha_google_negocio" id="senha_google_negocio" value="{{$academia->senha_google_negocio}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="google_negocio_getree" @if($academia->google_negocio_getree) checked @endif>
                                    </div>
                                </div>

                                {{--  TIKTOK  --}}
                                <div class="col-lg-5 col-12">
                                    <div class="mb-3">
                                        <label for="tiktok" class="form-label">Tiktok</label>
                                        <input type="text" class="form-control" name="tiktok" id="tiktok" value="{{$academia->tiktok}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="login_tiktok" class="form-label">Login do Tiktok</label>
                                        <input type="text" class="form-control" name="login_tiktok" id="login_tiktok" value="{{$academia->login_tiktok}}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-5">
                                    <div class="mb-3">
                                        <label for="senha_tiktok" class="form-label">Senha do Tiktok</label>
                                        <input type="text" class="form-control" name="senha_tiktok" id="senha_tiktok" value="{{$academia->senha_tiktok}}">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center justify-content-center">
                                    <div class="form-check form-switch form-switch-md mt-2" dir="ltr">
                                        <input class="form-check-input getree-check" type="checkbox" name="tiktok_getree" @if($academia->tiktok_getree) checked @endif> 
                                    </div>
                                </div>
                                
                            </div>
                            <hr>
        
                            <div class="row">
                                <h4 class="card-title mb-4 mt-4">Informações de Contrato</h4>
                                <div class="col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label for="inicio_contrato" class="form-label">Início do Contrato</label>
                                        <input type="date" class="form-control" name="inicio_contrato" id="inicio_contrato" value="{{$academia->inicio_contrato}}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label for="fim_contrato" class="form-label">Fim do Contrato</label>
                                        <input type="date" class="form-control" name="fim_contrato" id="fim_contrato" value="{{$academia->fim_contrato}}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="mb-3">
                                        <label for="valor_contrato" class="form-label">Valor do Contrato (R$)</label>
                                        <input type="number" class="form-control" name="valor_contrato" id="valor_contrato" value="{{$academia->valor_contrato}}" min="0" step="0.01">
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
                                            @if($academia->logo)
                                                <img id="logo-preview" src="{{asset($academia->logo)}}" style="width: 100%; max-width:200px;" alt="">
                                            @else
                                                <img id="logo-preview" src="{{asset('admin/images/logos/padrao.png')}}" style="width: 100%; max-width:200px;" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <label class="btn btn-primary" for="logo-upload">Trocar</label>
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
                        </form>
                        <div class="row">
                            <div class="col-12 col-lg-6 text-left" style="color:red;">
                                * Campos obrigatórios
                            </div>
                            <div class="col-12 col-lg-6 text-end">
                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-warning">Salvar</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane @if(session()->get('getree')) active @endif" id="gefitapp" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <form action="{{route('painel.academia.getree.adicionar', ['academia' => $academia])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mt-3">
                                            <label for="formFile" class="form-label">Imagem</label>
                                            <input class="form-control" name="imagem" type="file">
                                        </div>   
                                        <div class="mt-3">
                                            <label for="titulo">Título</label>
                                            <input type="text" class="form-control" name="titulo" id="titulo-getree" maxlength="250">
                                        </div> 
                                        <div class="mt-3">
                                            <label for="link">Link</label>
                                            <input type="text" class="form-control" name="link" maxlength="250">
                                        </div>   
                                        <div class="mt-3">
                                            <label for="link">Posição</label>
                                            <input type="number" class="form-control" name="posicao" min="0" max="100">
                                        </div> 
                                        <div class="mt-3 text-end">
                                            <button class="btn btn-primary" type="submit">Adicionar</button>    
                                        </div>                                   
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Imagem</th>
                                                <th>Título</th>
                                                <th>Posição</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                    
                    
                                        <tbody>
                                            @foreach($academia->getree->sortByDesc("posicao") as $elemento)
                                                <tr>
                                                    <td style="width: 10%; text-align: center;"><img src="{{asset($elemento->imagem)}}" alt="" width="40"></td>
                                                    <td><a href="{{$elemento->link}}">{{$elemento->titulo }}</a></td>
                                                    <td class="text-center">{{$elemento->posicao}}</td>
                                                    <td width="200">
                                                        <a name="" id="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditaGetree{{ $elemento->id }}" role="button">Editar</a>
                                                        <a class="btn btn-danger mx-1" href="{{route('painel.academia.getree.remover', ['getree' => $elemento])}}">Excluir</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                    
                                </div>
                            </div>
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
<!-- end row -->
@foreach($academia->getree as $elemento)
    <div class="modal fade" id="modalEditaGetree{{$elemento->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditaGetree{{$elemento->id}}Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('painel.academia.getree.salvar', ['getree' => $elemento])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label for="formFile" class="form-label">Imagem</label>
                            <input class="form-control" name="imagem" type="file">
                            <small>Escolha apenas caso deseje trocar</small>
                        </div>   
                        <div class="mt-3">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" name="titulo" value="{{$elemento->titulo}}" id="titulo-getree">
                        </div> 
                        <div class="mt-3">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" value="{{$elemento->link}}" name="link">
                        </div>   
                        <div class="mt-3">
                            <label for="link">Posição</label>
                            <input type="number" class="form-control" value="{{$elemento->posicao}}" name="posicao" min="0" max="100">
                        </div> 
                        <div class="mt-3 text-end">
                            <button class="btn btn-primary" type="submit">Salvar</button>    
                        </div>  

                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
    <!-- Sweet Alerts js -->
    <script src="{{asset('admin/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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

        var inp = document.getElementById('fundo_getree-upload');
        inp.addEventListener('change', function(e){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById('fundo_getree-preview').src = this.result;
                };
            reader.readAsDataURL(file);
        },false);

        $(document).ready(function(){
            $("#sa-warning").click(function () {
                Swal.fire({
                    title: "Tem Certeza?",
                    text: "Isso irá atualizar as informações da academia!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Sim, atualizar!",
                }).then(function (t) {
                    if(t.isConfirmed){
                        $("#form-edicao").submit();
                    }
                });
            })

            $(".getree-check").change(function(){
                var name = $(this).attr("name");
                var id = {!! $academia->id !!}
                var _token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                });  
                $.ajax({
                    url: '/dashboard/academias/getree/rede/' + id,
                    type: 'POST',
                    data: {
                        name: name
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        toastr.success(data, 'Sucesso')
                    },
                    error: function(){
                        toastr.error('Erro na operação. Atualize a página e tente novamente.', 'Erro')
                    }
                });
            });
        })
    </script>
@endsection
