@extends('painel.template.main')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('admin/libs/tui-time-picker/tui-time-picker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/libs/tui-date-picker/tui-date-picker.min.css')}}">
<link href="{{asset('admin/libs/tui-calendar/tui-calendar.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/libs/datetimepicker/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Calendário de Intervenções
@endsection

@section('botoes')
@endsection

@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id="menu">
                    <span id="menu-navi">
                        <button type="button" class="btn btn-outline-secondary move-today" id="move-today" data-action="move-today">Hoje</button>
                        <button type="button" class="btn btn-outline-secondary move-prev" id="move-prev" data-action="move-prev">
                            <i class="calendar-icon bx bx-left-arrow-alt" data-action="move-prev"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary move-next" id="move-next" data-action="move-next">
                            <i class="calendar-icon bx bx-right-arrow-alt" data-action="move-next"></i>
                        </button>
                    </span>
                    <span id="renderRange" class="render-range"></span>
                </div>
                
                <hr>
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <a name="" id="novo-registro" class="btn btn-primary" role="button">Novo Registro</a>
                    </div>
                </div>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalIntervencao" tabindex="-1" role="dialog" aria-labelledby="modalIntervencaoLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('calendario.intervencao.salvar')}}" method="post">
                    @csrf
                    <input type="hidden" name="identificador" value="">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="assunto">Assunto</label>
                            <input type="text" class="form-control" name="assunto"
                                id="assunto" aria-describedby="helpId" 
                                value="">
                        </div>
                    </div>
                    <div class="row mt-3">
						<div class="col-12">
							<label class="form-label">Academia</label>
							<br>
							<select class="select2 form-control select2-multiple"
								multiple="multiple" name="academias[]" data-placeholder="Escolha" style="width: 100%;" required>
								@foreach(\App\Models\Academia::all() as $academia)
									<option value="{{$academia->id}}">{{$academia->nome}}</option>
								@endforeach
							</select>
						</div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="observacao">Observação</label>
                            <textarea name="observacao" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-6">
                            <label for="inicio">Inicio</label>
                            <input class="form-control" name="inicio" id="datetimepicker" type="text" >
                        </div>
                        <div class="form-group col-6">
                            <label for="fim">Fim</label>
                            <input class="form-control" name="fim" id="datetimepicker2" type="text" >
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <label for="situacao">Situação</label>
                            <select class="form-select" name="situacao">
                                <option value="1">Atendida</option>
                                <option value="2">Não Atendida</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <button type="submit"
                                class="btn btn-primary">Salvar</button>
							@if(session()->get("usuario")["acesso"] == 0)
                            	<a name="" id="remove_intervencao" class="btn btn-danger" href="" role="button">Remover</a>
							@endif
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var intervencoes = {!! $intervencoes->toJson() !!};
</script>
<script src="{{asset('admin/libs/calendar/tui-code-snippet.min.js')}}"></script>
<script src="{{asset('admin/libs/tui-dom/tui-dom.min.js')}}"></script>

<script src="{{asset('admin/libs/tui-time-picker/tui-time-picker.min.js')}}"></script>
<script src="{{asset('admin/libs/tui-date-picker/tui-date-picker.min.js')}}"></script>

<script src="{{asset('admin/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin/libs/chance/chance.min.js')}}"></script>

<script src="{{asset('admin/libs/tui-calendar/tui-calendar.min.js')}}"></script>
<script src="{{asset('admin/libs/datetimepicker/jquery.datetimepicker.full.js')}}"></script>
<script src="{{asset('admin/js/pages/calendars.js')}}"></script>
<script src="{{asset('admin/js/pages/schedules.js')}}"></script>
<script src="{{asset('admin/libs/select2/js/select2.min.js')}}"></script>
{{--  <script src="{{asset('admin/js/pages/form-advanced.init.js')}}"></script>  --}}
<script>

    var cal = new tui.Calendar('#calendar', {
        defaultView: 'month', // monthly view option
    });

    $.datetimepicker.setLocale('pt-BR')
    $('#datetimepicker').datetimepicker({
        format:'d/m/Y H:i:s'
    });
    $('#datetimepicker2').datetimepicker({
        format:'d/m/Y H:i:s'
    });

    cal.on('clickSchedule', function(event) {
        academia = event.schedule.location;
        $("select[name='situacao'] option:selected").removeAttr('selected');
        $("select[name='situacao'] option[value='"+event.schedule.calendarId+"']").attr("selected", "selected");
        $("input[name='identificador']").val(event.schedule.id);
        $("input[name='assunto']").val(event.schedule.title);
        $("select[name='academias[]']").val(academia);
		$("select[name='academias[]']").trigger('change');
        $("textarea[name='observacao']").html(event.schedule.body);
        
        var inicio = event.schedule.start;
        var dia = (inicio.getDate() < 10) ? "0" + (inicio.getDate()) : (inicio.getDate())
        var mes = (inicio.getMonth() < 9) ? "0" + (inicio.getMonth() + 1) : (inicio.getMonth() + 1)
        var ano = inicio.getFullYear()
        var hora = (inicio.getHours() < 10) ? "0" + (inicio.getHours()) : (inicio.getHours())
        var minuto = (inicio.getMinutes() < 10) ? "0" + (inicio.getMinutes()) : (inicio.getMinutes())
        var segundo = (inicio.getSeconds() < 10) ? "0" + (inicio.getSeconds()) : (inicio.getSeconds())
        inicio = dia + "/" + mes + "/" + ano + " " + hora + ":" + minuto + ":" + segundo;
        
        var fim = event.schedule.end;
        dia = (fim.getDate() < 10) ? "0" + (fim.getDate()) : (fim.getDate())
        mes = (fim.getMonth() < 9) ? "0" + (fim.getMonth() + 1) : (fim.getMonth() + 1)
        ano = fim.getFullYear()
        hora = (fim.getHours() < 10) ? "0" + (fim.getHours()) : (fim.getHours())
        minuto = (fim.getMinutes() < 10) ? "0" + (fim.getMinutes()) : (fim.getMinutes())
        segundo = (fim.getSeconds() < 10) ? "0" + (fim.getSeconds()) : (fim.getSeconds())
        fim = dia + "/" + mes + "/" + ano + " " + hora + ":" + minuto + ":" + segundo;
        
        $("input[name='inicio']").val(inicio);
        $("input[name='fim']").val(fim);

        $("#remove_intervencao").removeClass("d-none");
        $("#remove_intervencao").attr("href", "/dashboard/calendario/intervencao/remover/" + event.schedule.id);

        $("#modalIntervencao").modal("show");
        //cal.openCreationPopup(event.schedule);
    });
    
    $("#novo-registro").click(function(){
        $("select[name='situacao'] option:selected").removeAttr('selected');
        $("input[name='identificador']").val("");
        $("input[name='assunto']").val("");
        $("select[name='academias[]']").val("");
		$("select[name='academias[]']").trigger('change');
        $("input[name='observacao']").val("");
        $("input[name='inicio']").val("");
        $("input[name='fim']").val("");
        $("#remove_intervencao").addClass("d-none");
        $("#remove_intervencao").attr("href", "");
        $("#modalIntervencao").modal("show");
    });

    var date = cal.getDate().toDate();
    $("#renderRange").html(date.getMonth() + "/" + date.getFullYear());
    
    {{-- $("#move-today").click(function(){
        cal.today();
        date = cal.getDate().toDate();
        $("#renderRange").html(date.getMonth() + "/" + date.getFullYear());
    })

    $("#move-next").click(function(){
        cal.next();
        date = cal.getDate().toDate();
        $("#renderRange").html(date.getMonth() + "/" + date.getFullYear());
    })

    $("#move-prev").click(function(){
        cal.prev();
        date = cal.getDate().toDate();
        $("#renderRange").html(date.getMonth() + "/" + date.getFullYear());
    }) --}}

</script>
<script>
/* eslint-disable */
function init() {
    cal.setCalendars(CalendarList);
  
    setRenderRangeText();
    setSchedules();
    setEventListener();
  }
  
  function getDataAction(target) {
    return target.dataset ? target.dataset.action : target.getAttribute('data-action');
  }
  
  function setDropdownCalendarType() {
    var calendarTypeName = document.getElementById('calendarTypeName');
    var calendarTypeIcon = document.getElementById('calendarTypeIcon');
    var options = cal.getOptions();
    var type = cal.getViewName();
    var iconClassName;
  
    if (type === 'day') {
      type = 'Daily';
      iconClassName = 'calendar-icon ic_view_day';
    } else if (type === 'week') {
      type = 'Weekly';
      iconClassName = 'calendar-icon ic_view_week';
    } else if (options.month.visibleWeeksCount === 2) {
      type = '2 weeks';
      iconClassName = 'calendar-icon ic_view_week';
    } else if (options.month.visibleWeeksCount === 3) {
      type = '3 weeks';
      iconClassName = 'calendar-icon ic_view_week';
    } else {
      type = 'Monthly';
      iconClassName = 'calendar-icon ic_view_month';
    }
  
    calendarTypeName.innerHTML = type;
    calendarTypeIcon.className = iconClassName;
  }
  
  function onClickMenu(e) {
    var target = $(e.target).closest('a[role="menuitem"]')[0];
    var action = getDataAction(target);
    var options = cal.getOptions();
    var viewName = '';
  
    switch (action) {
      case 'toggle-daily':
        viewName = 'day';
        break;
      case 'toggle-weekly':
        viewName = 'week';
        break;
      case 'toggle-monthly':
        options.month.visibleWeeksCount = 0;
        viewName = 'month';
        break;
      case 'toggle-weeks2':
        options.month.visibleWeeksCount = 2;
        viewName = 'month';
        break;
      case 'toggle-weeks3':
        options.month.visibleWeeksCount = 3;
        viewName = 'month';
        break;
      case 'toggle-narrow-weekend':
        options.month.narrowWeekend = !options.month.narrowWeekend;
        options.week.narrowWeekend = !options.week.narrowWeekend;
        viewName = cal.getViewName();
  
        target.querySelector('input').checked = options.month.narrowWeekend;
        break;
      case 'toggle-start-day-1':
        options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
        options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
        viewName = cal.getViewName();
  
        target.querySelector('input').checked = options.month.startDayOfWeek;
        break;
      case 'toggle-workweek':
        options.month.workweek = !options.month.workweek;
        options.week.workweek = !options.week.workweek;
        viewName = cal.getViewName();
  
        target.querySelector('input').checked = !options.month.workweek;
        break;
      default:
        break;
    }
  
    cal.setOptions(options, true);
    cal.changeView(viewName, true);
  
    setDropdownCalendarType();
    setRenderRangeText();
    setSchedules();
  }
  
  function onClickNavi(e) {
    var action = getDataAction(e.target);
  
    switch (action) {
      case 'move-prev':
        cal.prev();
        break;
      case 'move-next':
        cal.next();
        break;
      case 'move-today':
        cal.today();
        break;
      default:
        return;
    }
  
    setRenderRangeText();
    setSchedules();
  }
  
  function setRenderRangeText() {
    var renderRange = document.getElementById('renderRange');
    var options = cal.getOptions();
    var viewName = cal.getViewName();
    var html = [];
    if (viewName === 'day') {
      html.push(moment(cal.getDate().getTime()).format('YYYY.MM.DD'));
    } else if (viewName === 'month' &&
      (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
      html.push(moment(cal.getDate().getTime()).format('MM/YYYY'));
    } else {
      html.push(moment(cal.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
      html.push(' ~ ');
      html.push(moment(cal.getDateRangeEnd().getTime()).format(' MM.DD'));
    }
    renderRange.innerHTML = html.join('');
  }
  
  function setSchedules() {
    cal.clear();
    generateSchedule(cal.getViewName(), cal.getDateRangeStart(), cal.getDateRangeEnd());
    cal.createSchedules(ScheduleList);
    refreshScheduleVisibility();
  }
  
  
  function refreshScheduleVisibility() {
    var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
  
    CalendarList.forEach(function(calendar) {
      cal.toggleSchedules(calendar.id, !calendar.checked, false);
    });
  
    cal.render(true);
  
    calendarElements.forEach(function(input) {
      var span = input.nextElementSibling;
      span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
    });
  }
  
  resizeThrottled = tui.util.throttle(function() {
    cal.render();
  }, 50);
  
  function setEventListener() {
    $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
    $('#menu-navi').on('click', onClickNavi);
    window.addEventListener('resize', resizeThrottled);
  }
  
  cal.on({
    'clickTimezonesCollapseBtn': function(timezonesCollapsed) {
      if (timezonesCollapsed) {
        cal.setTheme({
          'week.daygridLeft.width': '77px',
          'week.timegridLeft.width': '77px'
        });
      } else {
        cal.setTheme({
          'week.daygridLeft.width': '60px',
          'week.timegridLeft.width': '60px'
        });
      }
  
      return true;
    }
  });
  
  init();

  $(document).ready(function(){
	$(".select2").select2()
  });
</script>
@endsection