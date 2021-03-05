<!doctype html>
<html lang="pt-br">

    
<head>
        
        <meta charset="utf-8" />
        <title>Gefit - Painel Administrativo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Painel de controle da Gefit" name="description" />
        <meta content="Luis Gustavo de Souza Carvalho" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('admin/libs/owl.carousel/assets/owl.carousel.min.css')}}">

        <link rel="stylesheet" href="{{asset('admin/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('admin/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @toastr_css

    </head>

    <body class="auth-body-bg">
        
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    
                    <div class="col-xl-9" style="background: url(/admin/images/background-login.jpg); background-size: cover; background-position:center;">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">
    
                                    <div class="p-4 mt-auto">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-7">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3" style="background-color: #002e82;">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="index.html" class="md-block auth-logo">
                                            <img src="{{asset('admin/images/logo-gefit-branco.png')}}" alt="" width="200" class="mx-auto auth-logo-dark">
                                            <img src="{{asset('admin/images/logo-gefit-branco.png')}}" alt="" width="200" class="mx-auto auth-logo-light">
                                        </a>
                                    </div>
                                    <div class="my-auto">
                                        
                                        <div>
                                            <h5 class="text-white">Bem vindo de volta !</h5>
                                            <p class="text-white">Insira seus dados para acessar.</p>
                                        </div>
            
                                        <div class="mt-4">
                                            <form action="{{route('painel.logar')}}" method="post">
                                                @csrf
                                                <div class="mb-3 text-white">
                                                    <label for="usuario" class="form-label">Usuário</label>
                                                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Informe o usuário">
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="form-label text-white">Senha</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control" name="senha" placeholder="Informa a senha" aria-label="Password" aria-describedby="password-addon">
                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                </div>
                        
                                                <!-- <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Lembrar de mim
                                                    </label>
                                                </div> -->
                                                
                                                <div class="mt-3 d-grid">
                                                    <button class="btn waves-effect waves-light" style="background-color: rgba(179,244,0,1); color:white;" type="submit">Entrar</button>
                                                </div>
                    
                                                
                                                <div class="mt-4 text-center">
                                                    <h5 class="font-size-14 mb-3 text-white">Conecte-se com</h5>
                    
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                                <i class="mdi mdi-facebook"></i>
                                                            </a>
                                                        </li>
                                                        <!-- <li class="list-inline-item">
                                                            <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                                <i class="mdi mdi-twitter"></i>
                                                            </a>
                                                        </li> -->
                                                        <li class="list-inline-item">
                                                            <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                                <i class="mdi mdi-google"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </form>
                                            <div class="mt-5 text-center text-white">
                                                <p>Ainda não possui uma conta ? <a href="auth-register-2.html" class="fw-medium text-white"> Cadastre-se Agora</a> </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-5 text-center text-white">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Gefit</p>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('admin/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('admin/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('admin/libs/node-waves/waves.min.js')}}"></script>

        <!-- owl.carousel js -->
        <script src="{{asset('admin/libs/owl.carousel/owl.carousel.min.js')}}"></script>

        <!-- auth-2-carousel init -->
        <script src="{{asset('admin/js/pages/auth-2-carousel.init.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('admin/js/app.js')}}"></script>
        @toastr_js
        @toastr_render
    </body>

<!-- Mirrored from themesbrand.com/skote/layouts/auth-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Feb 2021 12:51:15 GMT -->
</html>

