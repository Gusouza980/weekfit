<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Painel Administrativo - Ciclobank</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Painel Administrativo da Ciclobank" name="description" />
        <meta content="Luis Gustavo" name="author" />
        <meta name="_token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('admin/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @toastr_css
        @yield("css")
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('admin/images/logo.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('admin/images/logo-dark.png')}}" alt="" height="17">
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span style="font-size: 25px; color: white;">Ciclobank</span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect mr-3" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 60px;">
                                <i class="bx bx-bell bx-tada"></i>
                                {{-- <span class="badge badge-danger badge-pill" id="qtd-notificacoes">{{$notificacoes->count()}}</span> --}}
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notificações </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="" class="small"> Ver Todas</a>
                                        </div>

                                    </div>
                                </div>
                                {{-- <div data-simplebar style="max-height: 230px;">
                                    @foreach($notificacoes as $notificacao)
                                        <a class="text-reset notification-item mt-1">
                                            <div class="media mt-2">
                                                <div class="media-body px-3">
                                                    <h6 class="mt-0 mb-1">{{$notificacao->titulo}}</h6>
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-1">{!! $notificacao->descricao !!}</p>
                                                        @php
                                                            $agora = new Datetime();
                                                            $data_notificacao = new Datetime($notificacao->created_at);
                                                            $intervalo = $agora->diff($data_notificacao);
                                                            $intervalo = $intervalo->format('%i'). " min atrás";
                                                        @endphp
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{$intervalo}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div> --}}
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-xl-inline-block ml-1">Admin</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                {{-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href=""><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Sair</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header> 
            
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            
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
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">@yield("titulo")</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">@yield("subtitulo")</li>
                                        </ol>
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
                                <script>document.write(new Date().getFullYear())</script> © Skote.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Design & Develop by Themesbrand
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
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-right">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="{{asset('admin/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{asset('admin/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="{{asset('admin/css/bootstrap-dark.min.css')}}" data-appStyle="{{asset('admin/css/app-dark.min.css')}}" />
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{asset('admin/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-5">
                        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="{{asset('admin/css/app-rtl.min.css')}}" />
                        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

            
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

        

        <script src="{{asset('admin/js/app.js')}}"></script>
        @yield("js")
        @toastr_js 
        @toastr_render 
        
    </body>

</html>