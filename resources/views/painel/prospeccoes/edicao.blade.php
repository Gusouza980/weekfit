@extends('painel.template.main')

@section("styles")

<link rel="stylesheet" href="{{asset('admin/libs/owl.carousel/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

@endsection

@section('titulo')
    Cadastro de Prospecção
@endsection

@section('botoes')
    <a name="" id="" class="btn btn-primary" href="{{route('painel.prospeccoes')}}" role="button">Voltar</a>
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
                <form action="{{route('painel.prospeccao.salvar', ['prospeccao' => $prospeccao])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-lg-4">
                            <label for="nome">Nome Fantasia *</label>
                            <input type="text" class="form-control" name="nome"
                                id="nome" maxlength="250" value="{{$prospeccao->nome}}" required>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="gestor">Gestor</label>
                            <input type="text" class="form-control" name="gestor"
                                id="gestor" maxlength="100" value="{{$prospeccao->gestor}}"> 
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                                id="email" maxlength="100" value="{{$prospeccao->email}}"> 
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-4">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" name="cidade"
                                id="cidade" maxlength="50" value="{{$prospeccao->cidade}}">
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="estado"
                                class="form-label">Estado *</label>
                            <select id="estado" name="estado"
                                class="form-select">
                                <option value="AC" @if($prospeccao->estado == "AC") selected @endif>Acre</option>
                                <option value="AL" @if($prospeccao->estado == "AL") selected @endif>Alagoas</option>
                                <option value="AP" @if($prospeccao->estado == "AP") selected @endif>Amapá</option>
                                <option value="AM" @if($prospeccao->estado == "AM") selected @endif>Amazonas</option>
                                <option value="BA" @if($prospeccao->estado == "BA") selected @endif>Bahia</option>
                                <option value="CE" @if($prospeccao->estado == "CE") selected @endif>Ceará</option>
                                <option value="DF" @if($prospeccao->estado == "DF") selected @endif>Distrito Federal</option>
                                <option value="ES" @if($prospeccao->estado == "ES") selected @endif>Espírito Santo</option>
                                <option value="GO" @if($prospeccao->estado == "GO") selected @endif>Goiás</option>
                                <option value="MA" @if($prospeccao->estado == "MA") selected @endif>Maranhão</option>
                                <option value="MT" @if($prospeccao->estado == "MT") selected @endif>Mato Grosso</option>
                                <option value="MS" @if($prospeccao->estado == "MS") selected @endif>Mato Grosso do Sul</option>
                                <option value="MG" @if($prospeccao->estado == "MG") selected @endif>Minas Gerais</option>
                                <option value="PA" @if($prospeccao->estado == "PA") selected @endif>Pará</option>
                                <option value="PB" @if($prospeccao->estado == "PB") selected @endif>Paraíba</option>
                                <option value="PR" @if($prospeccao->estado == "PR") selected @endif>Paraná</option>
                                <option value="PE" @if($prospeccao->estado == "PE") selected @endif>Pernambuco</option>
                                <option value="PI" @if($prospeccao->estado == "PI") selected @endif>Piauí</option>
                                <option value="RJ" @if($prospeccao->estado == "RJ") selected @endif>Rio de Janeiro</option>
                                <option value="RN" @if($prospeccao->estado == "RN") selected @endif>Rio Grande do Norte</option>
                                <option value="RS" @if($prospeccao->estado == "RS") selected @endif>Rio Grande do Sul</option>
                                <option value="RO" @if($prospeccao->estado == "RO") selected @endif>Rondônia</option>
                                <option value="RR" @if($prospeccao->estado == "RR") selected @endif>Roraima</option>
                                <option value="SC" @if($prospeccao->estado == "SC") selected @endif>Santa Catarina</option>
                                <option value="SP" @if($prospeccao->estado == "SP") selected @endif>São Paulo</option>
                                <option value="SE" @if($prospeccao->estado == "SE") selected @endif>Sergipe</option>
                                <option value="TO" @if($prospeccao->estado == "TO") selected @endif>Tocantins</option>
                                <option value="EX" @if($prospeccao->estado == "EX") selected @endif>Estrangeiro</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-4">
                            <label for="contato">Contato</label>
                            <input type="text" class="form-control" name="contato"
                                id="contato" maxlength="100" value="{{$prospeccao->contato}}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12 col-lg-4">
                            <label for="status">Status</label>
                            <select name="status"
                                class="form-select">
                                @foreach(config("prospeccoes.status") as $key => $status)
                                    <option value="{{$key}}" @if($prospeccao->status == $key) selected @endif>{{$status}}</option>
                                @endforeach
                            </select>
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

<div class="row" id="row_notas">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nova nota</h5>
                <hr>
                <form action="{{route('painel.prospeccao.nota.adicionar', ['prospeccao' => $prospeccao])}}" method="post">
                    @csrf
                    <textarea name="texto" class="form-control" id="" rows="2"></textarea>
                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
                </form>
                <hr>
                <h5 class="card-title mt-4">Histórico de Notas</h5>
                <div class="hori-timeline mt-4">
                    <div class="owl-carousel owl-theme navs-carousel events" id="timeline-carousel">
                        @foreach($prospeccao->notas as $nota)
                            <div class="item event-list">
                                <div>
                                    <div class="event-date">
                                        <div class="text-primary mb-1">{{date("d/m/Y - H:i:s", strtotime($nota->created_at))}}</div>
                                    </div>
                                    <div class="event-down-icon">
                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                    </div>

                                    <div class="mt-3 px-3">
                                        <p class="text-muted">{{$nota->texto}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
@endsection

@section('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
{{-- <link rel="stylesheet" href="{{asset('admin/js/pages/timeline.init.js')}}"> --}}

@if(session()->get("nota_adicionada"))

    <script>

    
        $(document).ready(function(){
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#row_notas").offset().top + 100
            }, 2000);
        });
    </script>

@endif

<script>

    

    $(document).ready(function(){
        $("#timeline-carousel").owlCarousel({ items: 1, loop: !1, margin: 0, nav: !0, navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"], dots: !1, responsive: { 576: { items: 2 }, 768: { items: 3 } } });            

        // carregaCarousel();
    });

</script>

@endsection