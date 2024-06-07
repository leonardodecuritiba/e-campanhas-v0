@extends('layout.app')

@section('title', $Page->title)

@section('style_content')

@endsection

@section('page_header-title',   $Page->title)

@section('page_modals')


    @if(isset($Data))
        {{--VISUALIZAR ANTES DE ADICIONAR VOID--}}
        <div class="modal fade show " id="modal-entities">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Itens</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        {{Form::open(array(
                            'route' => ['ajax.human_resources.settings.groups.attach', $Data->id],
                            'id' => 'add-entity',
                            'method'=>'POST',
                            'data-alert'=>1,
                            'data-disable'=>'true'
                            )
                        )}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Html::decode(Form::label('voter_id', 'Eleitores *', array('class' => 'col-form-label'))) !!}
                                    {{Form::select('voter_id', $Page->auxiliar["voters"], "", ['placeholder' => 'Escolha o Eleitor', 'class'=>'form-control select2_single', 'required'])}}
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                            <button class="btn btn-label btn-primary"><label><i class="ti-check"></i></label> Salvar
                            </button>
                        </div>


                        {{Form::close()}}
                    </div>

                </div>
            </div>
        </div>

    @endif

@endsection


@section('page_header-nav')

    @include('layout.inc.breadcrumb')

@endsection

@section('page_content')
    <!-- Main container -->
    <div class="main-content">


    @include('layout.inc.alerts')

    <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="card">
            @if(isset($Data))
                <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->getShortName()}}</strong></h4>
            @else
                <h4 class="card-title"><strong>Dados do {{$Page->name}}</strong></h4>
            @endif
            <div class="card-body">
                @if(isset($Data))
                    {{Form::model($Data,
                        array(
                            'route' => ['groups.update', $Data->id],
                            'method'=>'PATCH',
                            'data-provide'=> "validation",
                            'data-disable'=>'false'
                        )
                        )}}
                    @else
                        {{Form::open(array(
                            'route' => ['groups.store'],
                            'method'=>'POST',
                            'data-provide'=> "validation",
                            'data-disable'=>'false'
                        )
                        )}}
                    @endif
                    @include('pages.human_resources.settings.groups.form.data')
                {{Form::close()}}
            </div>
        </div>

        @if(0 && isset($Data))

            <div class="card">
                <h4 class="card-title"><strong>{{count($Data->voters)}}</strong> Eleitores Associados
                    <button class="btn btn-info btn-label pull-right"
                            type="button"
                            data-toggle="modal" data-target="#modal-voters">
                        <label><i class="ti-plus"></i></label>Associar Eleitor
                    </button>
                </h4>

                <div class="card-content">
                    <div class="card-body">

                        <table class="table table-striped table-bordered table-voters" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Documento</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Documento</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($Data->voters as $sel)
                                <tr>
                                    <td>{{$sel['id']}}</td>
                                    <td>{{$sel['short_description']}}</td>
                                    <td>{{$sel['short_document']}}</td>
                                    <td>
                                        <button data-href="{{route('ajax.human_resources.settings.groups.dettach',[$Data->id, $sel->id])}}"
                                                data-refresh="0"
                                                data-alert="1"
                                                class="btn btn-square btn-outline  btn-xs btn-danger "
                                                onclick="showDetachTableMessage(this)"
                                                type="button"><i
                                                    class="fa fa-trash"></i></button>

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

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.validation.js')
    @if(isset($Data))
        <script>

            function detachDataTableByAjax($el) {

                if($($el).data('refresh')){
                    window.location.href = $($el).data('href');
                    return false;
                }

                $.ajax({
                    url: $($el).data('href'),
                    type: 'post',
                    data: {"_method": 'post', "_token": "{{csrf_token()}}"},
                    dataType: "json",

                    beforeSend: function () {
                        loadingCard('show',$el);
                    },
                    complete: function (xhr) {
                        loadingCard('hide', $el);
                        var json = xhr.responseJSON;
                        if($($el).data('alert')){
                            swal(
                                "",
                                json.text,
                                json.message
                            )
                        }
                    },
                    error: function (xhr, textStatus) {
                        console.log('xhr-error: ' + xhr);
                        console.log('textStatus-error: ' + textStatus);
                    },
                    success: function (json) {
                        loadingCard('hide', $el);
                        console.log(json)
                        if(json.status){
                            console.log(json.data);
                            var $_table_ = $($el).closest('table').DataTable();
                            $_table_
                                .row($($el).closest('tr'))
                                .remove()
                                .draw();
                        }
                    }
                });
            }

            function showDetachTableMessage($el) {
                var entity = $($el).data('entity');

                if($($el).data('alert')){
                    swal({
                        title: "Você tem certeza?",
                        text: "Esta ação será irreversível!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
    //            confirmButtonText: "<i class='em em-triumph'></i> Sim! ",
    //            cancelButtonText: "<i class='em em-cold_sweat'></i> Não, cancele por favor! ",
                        confirmButtonText: "Sim! ",
                        cancelButtonText: "Não, cancelar! "
                    }).then(
                        function (isConfirm) {
                            if (typeof isConfirm.dismiss == 'undefined') {
                                detachDataTableByAjax($el);
                            } else {
                                swal(
                                    "Cancelado",
                                    "Nenhuma alteração realizada!",
                                    //                    "<i class='em em-heart_eyes'></i>",
                                    //                    "Ufa, <b>" + entity + "</b> está a salvo :)",
                                    "error"
                                )
                            }
                        }
                    );
                } else {
                    detachDataTableByAjax($el);
                }

            }


            $(document).ready(function(){
                $('form#add-entity').on("submit",(function(event){
                    event.preventDefault();
                    var $el = $(this);
                    $.ajax({
                        url: $($el).attr('action'),
                        data: {entity_id : $($el).find('select[name=entity_id]').val(), "_token": "{{csrf_token()}}"},
                        type: 'POST',
                        dataType: "json",

                        beforeSend: function () {
                            loadingCard('show',$el);
                        },
                        complete: function (xhr) {
                            loadingCard('hide', $el);
                            var json = xhr.responseJSON;
                            if($($el).data('alert')){
                                swal(
                                    "",
                                    json.text,
                                    json.message
                                )
                            }
                        },
                        error: function (xhr, textStatus) {
                            console.log('xhr-error: ' + xhr);
                            console.log('textStatus-error: ' + textStatus);
                        },
                        success: function (json) {
                            loadingCard('hide',$el);
                            if(json.status){
                                console.log(json);
                                $($el).closest('div.modal').modal("hide");
                                var t = $('table.table-entities').DataTable();
                                var entity = json.data;
                                var url_dettach = ("{{route('ajax.human_resources.settings.groups.dettach',[$Data->id, "__ID__"])}}").replace("__ID__",entity.pivot.entity_id);
                                    t.row.add( [
                                        entity.pivot.entity_id,
                                        entity.short_description,
                                        entity.short_document,
                                        '<button data-href="' + url_dettach + '"'+
                                        'data-refresh="0" data-alert="1" class="btn btn-square btn-outline btn-xs btn-danger"' +
                                        'onclick="showDetachTableMessage(this)"' +
                                        'type="button"><i class="fa fa-trash"></i></button>',

                                    ] ).draw( false );
                                $($el).closest('div.modal').modal("hide");
                            }
                        }
                    });
                }));
            })
        </script>
    @endif
@endsection
