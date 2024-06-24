@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.defaultsubmenu',['entity'=>$Page->entity])

@endsection

@section('page_modals')

    <!-- Modal - View event -->
    <div class="modal modal-top fade" id="modal-view-event" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="badge badge-warning">EM ABERTO</span></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="flexbox mb-16">
                        <i class="ti-calendar fs-18 w-30px"></i>
                        <div class="flex-grow">
                            Vencimento:
                            <b class="mb-0" id="due"></b>
                        </div>
                    </div>

                    <div class="flexbox mb-16">
                        <i class="ti-id-badge fs-18 w-30px"></i>
                        <div class="flex-grow">
                            Fornecedor:
                            <b class="mb-0" id="supplier"></b>
                        </div>
                    </div>

                    <div class="flexbox align-items-center mb-16">
                        <i class="ti-money fs-18 w-30px"></i>
                        <div class="flex-grow">
                            Valor:
                            <b class="mb-0" id="value"></b>
                        </div>
                    </div>

                    <div class="flexbox align-items-center">
                        <i class="ti-user fs-18 w-30px"></i>
                        <div class="flex-grow">
                            Aprovador:
                            <b class="mb-0" id="approver"></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal - View event -->

@endsection

@section('page_content')
    <!-- Main container -->

    <div class="main-content">


    @include('layout.inc.alerts')
    <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Filter row
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="card">
            <header class="card-header">
                <h4 class="card-title">Filtros</h4>
                <ul class="card-controls">
                    <li><a class="card-btn-slide" href="#"></a></li>
                </ul>
            </header>
            <div class="card-content">
                <div class="card-body">
                    {!! Form::open(['route' => 'expenses.index',
                        'class' => 'form-inline',
                        'method' => 'GET']) !!}
                        <div class="form-group">
                            <label class="sr-only" for="expense_id">Buscar por ID</label>
                            <input name="expense_id" class="form-control" value="{{old('expense_id', Request::get('expense_id'))}}" placeholder="Digite o ID">
                        </div>

                        <button class="btn btn-primary" name="search_id" type="submit"><i class="ti-search"></i> Filtrar por ID</button>
                    {{ Form::close() }}

                    <hr class="hr-sm mb-2">

                    {!! Form::open(['route' => 'expenses.index',
                        'method' => 'GET']) !!}
                    {{Form::hidden('supplier_type', NULL)}}
                    <div class="form-row">
                        <div class="col-md-5">
                            <h6>Período de Lançamento</h6>
                            <div class="input-group" data-provide="datepicker" data-language="pt-BR">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">De</span>
                                </div>
                                {{Form::text('begin_created_at', old('begin_created_at', Request::get('begin_created_at')),['class'=>'form-control show-date', 'required'])}}
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">Até</span>
                                </div>
                                {{Form::text('end_created_at', old('end_created_at', Request::get('end_created_at')),['class'=>'form-control show-date'])}}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h6>Período de Vencimento</h6>
                            <div class="input-group" data-provide="datepicker" data-language="pt-BR">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">De</span>
                                </div>
                                {{Form::text('begin_due', old('begin_due', Request::get('begin_due')),['class'=>'form-control show-date'])}}
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">Até</span>
                                </div>
                                {{Form::text('end_due', old('end_due', Request::get('end_due')),['class'=>'form-control show-date'])}}
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            {!! Html::decode(Form::label('overdue', 'Vencimento', array('class' => 'col-form-label'))) !!}
                            <div class="form-group">
                                <input type="checkbox" data-provide="switchery" name="overdue" data-size="small" @if(!Request::has('search') || Request::has('overdue')) checked @endif> Mostrar apenas vencidas
                            </div>
                        </div>
                    </div>

                    <hr class="hr-sm mb-2">

                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('owner_id', 'Autor', array('class' => 'col-form-label'))) !!}
                            {{Form::select('owner_id',[], old('owner_id', Request::get('owner_id')), [ 'class'=>'form-control select2_single'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('approver_id', 'Aprovador', array('class' => 'col-form-label'))) !!}
                            {{Form::select('approver_id',[], old('approver_id', Request::get('approver_id')), [ 'class'=>'form-control select2_single'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-md-2">
                            {!! Html::decode(Form::label('parents', 'Despesas', array('class' => 'col-form-label'))) !!}
                            <div class="form-group">
                                <input type="checkbox" data-provide="switchery" name="parents" data-size="small" @if(Request::has('parents')) checked @endif> Mostrar apenas principais
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('supplier_conveyor_id', 'Fornecedor/Transportador', array('class' => 'col-form-label'))) !!}
                            {{Form::select('supplier_conveyor_id',[], old('supplier_conveyor_id', Request::get('supplier_conveyor_id')), [ 'class'=>'form-control select2_single'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('expense_type_id', 'Tipo de Despesa', array('class' => 'col-form-label'))) !!}
                            {{Form::select('expense_type_id', $Page->auxiliar['expense_types'], old('expense_type_id', Request::get('expense_type_id')), ['placeholder' => 'Destinatário', 'class'=>'form-control select2_single'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('department_id', 'Departamento', array('class' => 'col-form-label'))) !!}
                            {{Form::select('department_id', $Page->auxiliar['departments'], old('department_id', Request::get('department_id')), ['placeholder' => 'Departamento', 'class'=>'form-control select2_single'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-secondary pull-left"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Despesas pendentes de aprovação com data de lançamento ontem e hoje" name="macro" type="submit"><i class="ti-magnet"></i> Macro Despesas Pendentes</button>
                        <button class="btn btn-primary" name="search" type="submit"><i class="ti-search"></i> Filtrar</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        @if(count($Page->response) > 0)
            <div class="card">
                <h4 class="card-title"><strong>{{count($Page->response)}}</strong> {{$Page->names}}
                    <span class="float-right">
                        <button class="btn btn-info change-view" data-calendar="true">
                            <i class="ti-list"></i> Visualizar Tabela
{{--                            <i class="ti-calendar"></i> Visualizar Calendário--}}
                        </button>
                    </span>
                </h4>

                <div class="card-content">
                    <div class="card-body calendar-results">
                        <header class="header header-inverse bg-img" data-overlay="7">

                            <div class="header-action">
                                <div class="flexbox align-items-center gap-items-4">
                                    <a class="text-white" href="#" data-calendar="prev"><i class="ti-angle-left"></i></a>
                                    <span class="text-white fs-16" id="calendar-title"></span>
                                    <a class="text-white" href="#" data-calendar="next"><i class="ti-angle-right"></i></a>
                                </div>

                                <nav class="nav">
                                    <a class="nav-link" href="#" data-calendar="today">Hoje</a>
                                    <a class="nav-link active" href="#" data-calendar-view="month">Mês</a>
                                    <a class="nav-link" href="#" data-calendar-view="basicWeek">Semana</a>
                                    <a class="nav-link" href="#" data-calendar-view="basicDay">Dia</a>
                                    <div class="dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Mais</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-calendar-view="agendaWeek">Agenda da semana</a>
                                            <a class="dropdown-item" href="#" data-calendar-view="agendaDay">Agenda do dia</a>
                                            <a class="dropdown-item" href="#" data-calendar-view="listYear">Lista do ano</a>
                                            <a class="dropdown-item" href="#" data-calendar-view="listMonth">Lista do mês</a>
                                            <a class="dropdown-item" href="#" data-calendar-view="listWeek">Lista da semana</a>
                                            <a class="dropdown-item" href="#" data-calendar-view="listDay">Lista do dia</a>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </header>

                        <div class="main-content">
                            <div class="card card-body">
                                <div id="calendar" data-provide="fullcalendar" data-locale="pt-br"></div>
                            </div>
                        </div><!--/.main-content -->
                    </div>
                    <div class="card-body table-results" style="display: none;">

                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Lançamento</th>
                                <th>Fornecedor/Transportadora</th>
                                <th>Tipo de Despesa</th>
                                <th>Referência</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Autor</th>
                                <th>Departamento</th>
                                <th>Aprovador</th>
                                <th>Data de Baixa</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Lançamento</th>
                                <th>Fornecedor/Transportadora</th>
                                <th>Tipo de Despesa</th>
                                <th>Referência</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Autor</th>
                                <th>Departamento</th>
                                <th>Aprovador</th>
                                <th>Data de Baixa</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($Page->response as $sel)
                                <tr>
                                    <td data-order="{{$sel['id']}}">@include('layout.inc.buttons.show')</td>
                                    <td data-order="{{$sel['status_array']['text']}}">
                                        <span class="badge badge-{{$sel['status_array']['color']}}">{{$sel['status_array']['text']}}</span>
                                    </td>
                                    <td data-order="{{$sel['created_at_time']}}">{{$sel['created_at']}}</td>
                                    <td>
                                        @can('suppliers.edit')
                                            @if($sel['supplier_id'] != NULL)
                                                <a target="_blank" href="{{route('suppliers.edit', $sel['supplier_id'])}}">{{$sel['supplier_name']}}</a>
                                            @endif
                                        @else
                                            @can('suppliers.show')
                                                @if($sel['supplier_id'] != NULL)
                                                    <a target="_blank" href="{{route('suppliers.show', $sel['supplier_id'])}}">{{$sel['supplier_name']}}</a>
                                                @endif
                                            @else
                                                {{$sel['supplier_name']}}
                                            @endcan
                                        @endcan
                                        @if($sel['supplier_type'])
                                            @can('conveyors.edit')
                                                <a target="_blank" href="{{route('conveyors.edit', $sel['conveyor_id'])}}">{{$sel['conveyor_supplier_name']}}</a>
                                            @else
                                                @can('conveyors.show')
                                                    <a target="_blank" href="{{route('conveyors.show', $sel['conveyor_id'])}}">{{$sel['conveyor_supplier_name']}}</a>
                                                @else
                                                    {{$sel['conveyor_supplier_name']}}
                                                @endcan
                                            @endcan
                                        @else
                                            @can('suppliers.edit')
                                                <a target="_blank" href="{{route('suppliers.edit', $sel['supplier_id'])}}">{{$sel['conveyor_supplier_name']}}</a>
                                            @else
                                                @can('suppliers.show')
                                                    <a target="_blank" href="{{route('suppliers.show', $sel['supplier_id'])}}">{{$sel['conveyor_supplier_name']}}</a>
                                                @else
                                                    {{$sel['conveyor_supplier_name']}}
                                                @endcan
                                            @endcan
                                        @endif
                                    </td>
                                    <td>
                                        @can('expense_types.edit')
                                            <a target="_blank" href="{{route('expense_types.edit', $sel['expense_type_id'])}}">{{$sel['expense_type_name']}}</a>
                                        @else
                                            @can('expense_types.show')
                                                <a target="_blank" href="{{route('expense_types.show', $sel['expense_type_id'])}}">{{$sel['expense_type_name']}}</a>
                                            @else
                                                {{$sel['expense_type_name']}}
                                            @endcan
                                        @endcan
                                    </td>
                                    <td data-order="{{$sel['reference_time']}}">{{$sel['reference_formatted']}}</td>
                                    <td data-order="{{$sel['value']}}">{{$sel['value_formatted']}}</td>
                                    <td data-order="{{$sel['due_time']}}">{{$sel['due_formatted']}}</td>
                                    <td>{{$sel['owner_name']}}</td>
                                    <td>{{$sel['department_text']}}</td>
                                    <td>{{$sel['approver_name']}}</td>
                                    <td data-order="{{$sel['paid_at_time']}}">
                                        <span class="badge badge-{{$sel['paid_at_array']['color']}}">{{$sel['paid_at_array']['text']}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @include('layout.inc.loading')
            </div>
        @endif


    </div><!--/.main-content -->
@endsection


@section('script_content')

    <!-- Sample data to populate jsGrid demo tables -->
    @include('layout.inc.datatable.js')

    @include('layout.inc.sweetalert.js')

    <script>
        app.ready(function() {

            new select2Ajax( {
                el_select:'select[name=owner_id]',
                placeholder:'Selecione o Usuário',
                url: "{{route('ajax.human_resources.users.index')}}",
                value: ["{{(Request::has('owner_id') ? Request::get('owner_id') : "")}}"]
            })

            new select2Ajax( {
                el_select:'select[name=approver_id]',
                placeholder:'Selecione o Usuário',
                url: "{{route('ajax.human_resources.users.index')}}",
                value: ["{{(Request::has('approver_id') ? Request::get('approver_id') : "")}}"]
            })

            new select2Ajax( {
                el_select:'select[name=supplier_conveyor_id]',
                placeholder:'Selecione o Fornecedor/Transportador',
                url: "{{route('ajax.human_resources.supplier_conveyor.index')}}",
                value: ["{{(Request::has('supplier_conveyor') ? Request::get('supplier_conveyor') : "")}}"]
            })

            $('select[name=supplier_conveyor_id]').change(() => {
                const type = $('select[name=supplier_conveyor_id]').find(":selected").data('table');
                $('input[name=supplier_type]').val(null)
                if(type === "suppliers"){
                    $('input[name=supplier_type]').val("0")
                } else if(type === "conveyors"){
                    $('input[name=supplier_type]').val("1")
                }
            })

            const events = JSON.parse('<?php if($Page->auxiliar['calendar'] != NULL) echo $Page->auxiliar['calendar']; else echo '{}';?>');
            if(events.length > 0){

                const default_date = '<?php echo $Page->auxiliar['default_date']; ?>';

                //VISUALIZAÇÃO DO CALENDÁRIO
                $("button.change-view").click(function (e){
                    const calendar = $(this).data("calendar");
                    const $parent = $(this).closest("div.card")
                        .find("div.card-content")
                    if(calendar){
                        //SE VERDADEIRO, calendar ESTÁ ATIVO
                        $(this).html(`<i class="ti-calendar"></i> Visualizar Calendário`)
                        $($parent).find("div.calendar-results").hide();
                        $($parent).find("div.table-results").show();
                    } else {
                        //SENÃO, TABELA ESTÁ ATIVA
                        $(this).html(`<i class="ti-list"></i> Visualizar Tabela`)
                        $($parent).find("div.calendar-results").show();
                        $($parent).find("div.table-results").hide();
                    }
                    $(this).data("calendar", !calendar)
                })

                /*-----------------------------------------------------------------*/
                /*-----------------------------------------------------------------*/
                const calendar = $('#calendar');

                /* initialize the calendar
                -----------------------------------------------------------------*/

                calendar.fullCalendar({
                    header: false,
                    defaultDate: default_date,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar
                    navLinks: true, // can click day/week names to navigate views
                    eventLimit: true, // allow "more" link when too many events
                    events: events,
                    viewRender: function(view, element) {
                        $('#calendar-title').text( calendar.fullCalendar('getView').title );
                    },
                    // dayClick: function(date, jsEvent, view) {
                    //     $('#modal-add-event').modal('show');
                    // },
                    eventClick: function(date, jsEvent, view) {
                        const $parent = $('#modal-view-event div.modal-content')
                        $($parent).find('h5.modal-title')
                            .html(`${date.expense_type_name} <span class="${date.className[0]} ${date.className[1]}">${date.status_array["text"]}</span>`)

                        $($parent).find('b#due').html(date.due_formatted)
                        $($parent).find('b#supplier').html(date.supplier_name != null ? date.supplier_name : `-`)
                        $($parent).find('b#value').html(`R$ ${date.value_formatted}`)
                        $($parent).find('b#approver').html(date.approver_name != null ? date.approver_name : `-`)

                        $('#modal-view-event').modal('show');
                    }
                });

                /* handle change view
                -----------------------------------------------------------------*/

                $('[data-calendar-view]').on('click', function(){
                    var view = $(this).data('calendar-view');
                    calendar.fullCalendar('changeView', view);

                    makeViewActive($(this));
                });

                var makeViewActive = function(e) {
                    $(e).closest('.nav').find('.nav-link.active, .dropdown-item.active').removeClass('active');
                    $(e).addClass('active');
                    if ( $(e).hasClass('dropdown-item') ) {
                        $(e).closest('.dropdown').children('.nav-link').addClass('active');
                    }
                }

                /* handle caledar actions
                -----------------------------------------------------------------*/
                $('[data-calendar]').on('click', function(){
                    var action = $(this).data('calendar');

                    switch(action) {
                        case 'today':
                            calendar.fullCalendar('today');
                            break;

                        case 'next':
                            calendar.fullCalendar('next');
                            break;

                        case 'prev':
                            calendar.fullCalendar('prev');
                            break;
                    }
                });

                // // Once edit button clicked, close the event details modal and open edit modal
                // //
                // $('#open-modal-edit').on('click', function(){
                //     $('#modal-view-event').one('hidden.bs.modal', function () {
                //         $('#modal-edit-event').modal('show');
                //     });
                //     $('#modal-view-event').modal('hide');
                // });

            }

        });
    </script>

@endsection
