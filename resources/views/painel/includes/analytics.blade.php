<div class="row">
    <div class="col-12 col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted fw-medium">Usuários Online</p>
                        <h4 class="mb-0">{{$analytics["numero_acessos_atuais"]}}</h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-laranja align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-user font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted fw-medium">Novos visitantes (Últimos 7 dias)</p>
                        <h4 class="mb-0">@if(count($analytics["tipos_usuarios"])) {{$analytics["tipos_usuarios"][0]["sessions"]}} @else - @endif</h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-laranja align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-user font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <p class="text-muted fw-medium">Visitantes Recorrentes (Últimos 7 dias)</p>
                        <h4 class="mb-0">@if(count($analytics["tipos_usuarios"])) {{$analytics["tipos_usuarios"][1]["sessions"]}} @else - @endif</h4>
                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-laranja align-self-center">
                        <span class="avatar-title">
                            <i class="bx bx-user font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Acessos (Últimos 7 dias)</h4>
                <ul class="verti-timeline list-unstyled">
                    @if($analytics["numero_acessos"])
                        @foreach($analytics["numero_acessos"] as $acessos)
                            <li class="event-list">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle font-size-18"></i>
                                </div>
                                <div class="media">
                                    <div class="me-3">
                                        <h5 class="font-size-14">{{\App\Classes\Util::convertStringToDate($acessos[0])}} <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            {{$acessos[1]}} Recorrentes e {{$acessos[2]}} Novos
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Principais Referências (Últimos 7 dias)</h4>
                <ul class="verti-timeline list-unstyled">
                    @foreach($analytics["top_referencias"] as $referencia)
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="media">
                                <div class="me-3">
                                    <h5 class="font-size-14">{{$referencia["url"]}} <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        {{$referencia["pageViews"]}} acessos
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Páginas mais visitadas (Últimos 7 dias)</h4>
                <ul class="verti-timeline list-unstyled">
                    @foreach($analytics["paginas_mais_visualizadas"] as $pagina)
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="media">
                                <div class="me-3">
                                    <h5 class="font-size-14">{{$pagina["url"]}} <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        {{$pagina["pageViews"]}} visitantes
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>