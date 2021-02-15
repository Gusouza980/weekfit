@extends('painel.template.main')

@section('titulo')
    Dados
@endsection

@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="media">
                            <div class="me-3">
                                <img src="{{asset('admin/images/users/avatar-1.jpg')}}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <p class="mb-2">Welcome to Skote Dashboard</p>
                                    <h5 class="mb-1">Henry wells</h5>
                                    <p class="mb-0">UI / UX Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 align-self-center">
                        <div class="text-lg-center mt-4 mt-lg-0">
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Total Projects</p>
                                        <h5 class="mb-0">48</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Projects</p>
                                        <h5 class="mb-0">40</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Clients</p>
                                        <h5 class="mb-0">18</h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="clearfix mt-4 mt-lg-0">
                            <div class="dropdown float-end">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bxs-cog align-middle me-1"></i> Setting
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div id="gauge-chart" class="e-charts"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9 col-sm-8">
                        <div  class="p-4">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>Skote Crypto Dashboard</p>

                            <div class="text-muted">
                                <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> If several languages coalesce</p>
                                <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Sed ut perspiciatis unde</p>
                                <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> It would be necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 align-self-center">
                        <div>
                            <img src="assets/images/crypto/features-img/img-1.png" alt="" class="img-fluid d-block">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Disable display input</h5>
                            <input class="knob" data-width="150" data-fgcolor="#556ee6" data-displayinput="false" value="35">
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Cursor mode</h5>
                            <input class="knob" data-width="150" data-cursor="true" data-fgcolor="#34c38f" value="29">
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Display previous value</h5>
                            <input class="knob" data-width="150" data-min="-100" data-fgcolor="#50a5f1" data-displayprevious="true" value="44">
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Angle offset</h5>
                            <input class="knob" data-width="150" data-angleoffset="90" data-linecap="round" data-fgcolor="#f1b44c" value="35">
                        </div>
                    </div>
                    {{-- <div class="col-xl-4 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3"> 5-digit values, step 1000</h5>
                            <input class="knob" data-width="150" data-min="-15000" data-displayprevious="true" data-max="15000" data-step="1000" value="-11000" data-fgcolor="#2a3142">
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Angle offset and arc</h5>
                            <input class="knob" data-width="150" data-cursor="true" data-fgcolor="#f46a6a" value="29">
                        </div>
                    </div>
                    
                    <div class="col-xl-4 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3">Readonly</h5>
                            <input class="knob" data-width="150" data-height="150" data-linecap=round
                                    data-fgColor="#f06292" value="80" data-skin="tron" data-angleOffset="180"
                                    data-readOnly=true data-thickness=".1"/>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="text-center" dir="ltr">
                            <h5 class="font-size-14 mb-3"> Angle offset and arc</h5>
                            <input class="knob" data-width="150" data-height="150"
                            data-displayPrevious=true data-fgColor="#8d6e63" data-skin="tron"
                            data-cursor=true value="75" data-thickness=".2" data-angleOffset=-125
                            data-angleArc=250 value="44"/>
                        </div>

                    </div> --}}
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- end row -->
@endsection

@section('scripts')
    <!-- echarts js -->
    <script src="{{asset('admin/libs/echarts/echarts.min.js')}}"></script>
    <!-- echarts init -->
    <script src="{{asset('admin/js/pages/echarts.init.js')}}"></script>>

    <script src="{{asset('admin/libs/jquery-knob/jquery.knob.min.js')}}"></script> 

    <script src="{{asset('admin/js/pages/jquery-knob.init.js')}}"></script> 
@endsection