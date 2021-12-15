@php
    
$usuario = \App\Models\Usuario::find(session()->get("usuario")["id"]);

@endphp

<!doctype html>
<html lang="pt-br">
    
<head>
        
        <meta charset="utf-8" />
        <title>Gefit - Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Painel Administrativo da Gefit" name="description" />
        <meta content="Luis Gustavo de Souza Carvalho" name="author" />
        <meta name="_token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('admin/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @toastr_css
        @yield("styles")
    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{route('painel.index')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('admin/images/logo-gefit-branco.png')}}" alt="" width="100">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('admin/images/logo-g.png')}}" alt="" width="100">
                                </span>
                            </a>

                            <a href="{{route('painel.index')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('admin/images/logo-g.png')}}" alt="" style="max-width: 25px;">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('admin/images/logo-gefit-branco.png')}}" alt="" width="100">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        {{-- <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <select class="form-control">
                                    <option>Nenhuma Academia Selecionada</option>
                                    @foreach(\App\Models\Academia::all() as $academia)
                                        <option value="{{$academia->id}}">{{$academia->nome}}</option>
                                    @endforeach
                                </select>
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form> --}}

                        {{-- <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
                            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <span key="t-megamenu">Mega Menu</span>
                                <i class="mdi mdi-chevron-down"></i> 
                            </button>
                            <div class="dropdown-menu dropdown-megamenu">
                                <div class="row">
                                    
                                </div>

                            </div>
                        </div> --}}
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-customize"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="px-lg-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://www.instagram.com/gefit.br" target="_blank">
                                                <img src="{{asset('admin/images/icone_instagram.png')}}" alt="Instagram">
                                                <span>Instagram</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://www.facebook.com/gefit.br" target="_blank">
                                                <img src="{{asset('admin/images/icone_facebook.png')}}" alt="Facebook">
                                                <span>Facebook</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://twitter.com/gefit_br" target="_blank">
                                                <img src="{{asset('admin/images/icone_twitter.png')}}" alt="Twitter">
                                                <span>Twitter</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#" target="_blank">
                                                <img src="{{asset('admin/images/icone_linkedin.png')}}" alt="Linkedin">
                                                <span>Linkedin</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#" target="_blank">
                                                <img src="{{asset('admin/images/icone_tiktok.png')}}" alt="Tiktok">
                                                <span>Tiktok</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://api.whatsapp.com/send?phone=5535997097707" target="_blank">
                                                <img src="{{asset('admin/images/icone_whatsapp.png')}}" alt="Whatsapp">
                                                <span>Whatsapp</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                <span class="badge bg-danger rounded-pill">1</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notificações </h6>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <a href="#!" class="small" key="t-view-all"> View All</a>
                                        </div> --}}
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="https://www.sistemasca.com/blog/" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <img src="{{asset('admin/images/logo_sca.png')}}" style="max-width: 100%;" alt="SCA">
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1" key="t-your-order">Blog Sistema SCA</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">Encontre artigos sobre administrativo, técnico, comercial e marketing.</p>
                                                    {{-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                {{-- <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span> 
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" 
                                    @if($usuario->academia && $usuario->academia->logo) src="{{asset($usuario->academia->logo)}}" 
                                    @else src="{{asset('admin/images/logos/gefit.png')}}" 
                                    @endif
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{session()->get("usuario")["nome"]}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Minha Conta</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-key font-size-16 align-middle me-1"></i> <span key="t-my-wallet">Senha</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Configurações</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{route('painel.sair')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Sair</span></a>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="bx bx-cog bx-spin"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        @if(session()->get("usuario")["admin"])
                            <div class="px-3">
                                <form id="form-select-academia" action="{{route('painel.academia.selecionar')}}" method="post">
                                    @csrf
                                    <select name="academia" id="select-academia" class="form-select">
                                        <option value="0">Administrativo</option>
                                        @foreach(\App\Models\Academia::where("ativo", true)->get() as $academia)
                                            <option value="{{$academia->id}}" @if(session()->get("academia") && session()->get("academia") == $academia->id) selected @endif>{{$academia->nome}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                
                            </div>
                            
                        @endif
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled mt-3" id="side-menu">
                            @if(session()->get("usuario")["admin"] == 0 || session()->get("academia"))
                                <li class="menu-title" key="t-menu">Menu</li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="bx bx-home-circle"></i>
                                        <span key="t-dashboards">Dashboards</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('dashboard.checklist')}}" key="t-default">Checklist</a></li>
                                        <li><a href="{{route('dashboard.jornada')}}" key="t-default">Jornada</a></li>
                                        @if(session()->get("academia"))
                                            <li><a href="{{route('painel.academiaa.getree.relatorio', ['academia' => session()->get("academia")])}}" key="t-default">Getree</a></li>
                                        @else
                                            <li><a href="{{route('painel.academiaa.getree.relatorio', ['academia' => session()->get("usuario")["academia_id"]])}}" key="t-default">Getree</a></li>
                                        @endif
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="mdi mdi-graph-outline"></i>
                                        <span key="t-dashboards">Leads</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('dashboard.leads')}}" key="t-default">Cadastros</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="bx bx-check-square"></i>
                                        <span key="t-dashboards">Lançamento</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('painel.administracao.lancamento')}}" key="t-default">Checklist</a></li>
                                        <li><a href="{{route('painel.administracao.jornada')}}" key="t-default">Jornada</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="bx bx-calendar-event"></i>
                                        <span key="t-dashboards">Calendario</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('calendario.intervencoes')}}" key="t-default">Intervenções</a></li>
                                    </ul>
                                </li>

                            @endif

                            @if(session()->get("usuario") && session()->get("usuario")["admin"] && !session()->get("academia"))
                                <li class="menu-title" key="t-menu">Administrativo</li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="fas fa-dumbbell menu-icon"></i>
                                        <span key="t-dashboards">Academias</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('painel.academias')}}" key="t-default">Cadastros</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="{{route('painel.logs')}}" class="waves-effect">
                                        <i class="fas fa-info-circle menu-icon" aria-hidden="true"></i>
                                        <span key="t-dashboards">Logs</span>
                                    </a>
                                </li>

                                <li class="menu-title" key="t-menu">Configurações</li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="fas fa-tasks menu-icon"></i>
                                        <span key="t-dashboards">Atividades</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('painel.configuracoes.grupos')}}" key="t-default">Gerenciamento</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="fas fa-level-up-alt"></i>
                                        <span key="t-dashboards">Jornada</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('painel.configuracoes.jornada.atividades')}}" key="t-default">Gerenciamento</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="fa fa-users menu-icon" aria-hidden="true"></i>
                                        <span key="t-dashboards">Usuários</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('painel.usuarios')}}" key="t-default">Cadastros</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="bx bx-calendar-event" aria-hidden="true"></i>
                                        <span key="t-dashboards">Calendário</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('calendario.intervencoes')}}" key="t-default">Intervenções</a></li>
                                    </ul>
                                </li>

                                
                            @endif
                            
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="col-6 text-start">
                                        <h4 class="mb-sm-0 font-size-18">@yield("titulo")</h4>
                                    </div>
                                    <div class="col-6 text-end">
                                        @yield("botoes")
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        @yield("conteudo")                  
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © GEFIT | Fitness Intelligence.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by 7 Seven Trends
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Atualizações</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />           
                <div class="p-4 lista-atualizacoes">

                    <h6 class="text-left mb-3 mt-4">13/09/2021 - V 1.5</h6>
                    <ul class="">
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição de sistema de jornadas.</span></li>
                    
                    </ul>

                    <h6 class="text-left mb-3 mt-4">25/04/2021 - V 1.4</h6>
                    <ul class="">
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição da visualização de leads.</span></li>
                    
                    </ul>

                    <h6 class="text-left mb-3 mt-4">12/04/2021 - V 1.3</h6>
                    <ul class="">
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição do sistema de calendário de intervenções.</span></li>
                    
                    </ul>

                    <h6 class="text-left mb-3 mt-4">02/03/2021 - V 1.2</h6>
                    <ul class="">
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição do sistema de nível para a academia.</span></li>
                    
                    </ul>

                    <h6 class="text-left mb-3 mt-4">25/02/2021 - V 1.1</h6>
                    <ul class="">
                        <li><i class="fas fa-sync-alt" style="color: #dab600;"></i> <span>Atualizando dashboard de checklist para conter informações por grupo.</span></li>
                    
                    </ul>
                    
                    
                    <h6 class="text-left mb-3 mt-4">24/02/2021 - V 1.0</h6>
                    <ul class="">
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição do sistema de lançamento de atividades.</span></li>
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição da dashboard de checklist.</span></li>
                    </ul>
                    
                    <h6 class="text-left mb-3 mt-4">16/02/2021 - V 0.5</h6>
                    <ul class="">
                        <li><i class="fa fa-plus" aria-hidden="true" style="color: green;"></i> <span>Adição do sistema de acesso.</span></li>
                    </ul>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('admin/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('admin/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('admin/libs/node-waves/waves.min.js')}}"></script>
        @toastr_js
        @toastr_render

        <!-- dashboard init -->
        {{-- <script src="{{asset('admin/js/pages/dashboard.init.js')}}"></script> --}}

        <!-- App js -->
        <script src="{{asset('admin/js/app.js')}}"></script>
        @yield("scripts")
        <script>
            $(document).ready(function(){
                $("#select-academia").change(function(){
                    $("#form-select-academia").submit();
                });
            });
        </script>
    </body>

</html>