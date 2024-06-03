@extends('layout.app')

@section('title', $Page->title)

@section('style_content')

@endsection

@section('page_header-title',   $Page->title)

@section('page_modals')

    @if(isset($Data))

        @if($Data->canUnapprove() || $Data->canCancel())
            @include("pages.commons.expenses.modal.justification")
        @endif

        @if($Data->canAddObservations())
            @include('pages.commons.observations.modal', ["type" => "expenses"])
        @endif

        @if($Data->canAddAttachments())
            @include('pages.commons.attachments.modal', ["type" => "expenses"])
        @endif

        @if($Data->canPay())
            @include("pages.commons.expenses.modal.pay")
        @endif

        @if($Data->canGenerateRecurrency() || $Data->canDuplicate())
            @include("pages.commons.expenses.modal.recurrency")
        @endif

    @endif

    <!-- Jquery Validation Plugin Js -->

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
                <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->getShortName()}}</strong>
                    @if($Data->canDestroy())
                        <button class="btn btn-square btn-outline btn-danger mr-10 pull-right btn-rem"
                                data-id="expense-destroy"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Remover Despesa"
                                data-href="{{route("expenses.destroy", $Data->id)}}"><i class="fa fa-trash"></i></button>
                    @endif
                    <a class="btn btn-square btn-outline btn-secondary mr-10 pull-right"
                       target="_blank" href="{{route("expenses.print", $Data->id)}}"><i class="fa fa-print"></i></a>
                    @if($Data->canApprove())
                        <button class="btn btn-a btn-success btn-label mr-10 pull-right btn-send"
                                data-id="expense-approve"
                                data-href="{{route("expenses.approve", $Data->id)}}"><label><i class="ti-check-box"></i></label>Aprovar
                        </button>
                    @endif
                    @if($Data->canSendToApprove())
                        <button class="btn btn-a btn-info btn-label mr-10 pull-right btn-send"
                                data-id="expense-send-to-approve"
                                data-href="{{route("expenses.send-to-approve", $Data->id)}}"><label><i class="ti-share"></i></label>Enviar para Aprovação
                        </button>
                    @endif
                    @if($Data->canUnapprove())
                        <button class="btn btn-a btn-warning btn-label mr-10 pull-right"
                                data-id="expense-unapprove"
                                data-toggle="modal" data-target="#modal-justification"
                                data-href="{{route("expenses.unapprove", $Data->id)}}"><label><i class="ti-share-alt"></i></label>Reprovar
                        </button>
                    @endif
                    @if($Data->canCancel())
                        <button class="btn btn-a btn-danger btn-label mr-10 pull-right"
                                data-id="expense-cancel"
                                data-toggle="modal" data-target="#modal-justification"
                                data-href="{{route("expenses.cancel", $Data->id)}}"><label><i class="ti-na"></i></label>Cancelar
                        </button>
                    @endif
                    @if($Data->canPay())
                        <button class="btn btn-primary btn-label mr-10 pull-right"
                                data-toggle="modal" data-target="#modal-pay"><label><i class="ti-money"></i></label>Dar Baixa
                        </button>
                    @endif
                    @if($Data->canGenerateRecurrency())
                        <button class="btn btn-secondary btn-label mr-10 pull-right"
                                data-id="expense-recurrency"
                                data-toggle="modal" data-target="#modal-recurrency"
                                data-href="{{route("expenses.recurrency", $Data->id)}}"><label><i class="ti-layers-alt"></i></label>Gerar Recorrência
                        </button>
                    @endif
                    @if($Data->canDuplicate())
                        <button class="btn btn-secondary btn-label mr-10 pull-right"
                                data-id="expense-duplicate"
                                data-toggle="modal" data-target="#modal-recurrency"
                                data-href="{{route("expenses.duplicate", $Data->id)}}"><label><i class="ti-layers"></i></label>Duplicar
                        </button>
                    @endif
                    @if($Data->parent_id == NULL)
                        <span class="badge badge-primary badge-sm">Despesa Principal</span>
                    @else
                        <span class="badge badge-secondary badge-sm">Despesa Secundária</span>
                    @endif
                    @include('layout.inc.badge-status',['status'=>$Data->status_array])
                </h4>
            @else
                <h4 class="card-title"><strong>Dados da {{$Page->name}}</strong></h4>
            @endif
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(!isset($Page->tab) || $Page->tab =="data") active @endif" id="informations-tab" data-toggle="tab" href="#informations" role="tab" aria-controls="informations" aria-selected="true">Informações</a>
                    </li>

                    @if(isset($Data))

                        @include('pages.commons.logs.header')

                        @include('pages.commons.observations.header')

                        @include('pages.commons.attachments.header')

                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade @if(!isset($Page->tab) || $Page->tab =="data") show active @endif" id="informations" role="tabpanel" aria-labelledby="informations-tab">

                        @if(isset($Data))
                            {{Form::model($Data,
                                array(
                                    'route' => ['expenses.update', $Data->id],
                                    'method'=>'PATCH',
                                    'data-provide'=> "validation",
                                    'data-disable'=>'false'
                                )
                                )}}
                        @else
                            {{Form::open(array(
                                'route' => ['expenses.store'],
                                'method'=>'POST',
                                'data-provide'=> "validation",
                                'data-disable'=>'false'
                            )
                            )}}
                        @endif
                        @include('pages.commons.expenses.form.data')
                        {{Form::close()}}

                    </div>

                    @if(isset($Data))

                        @include("pages.commons.logs.body", ["Logs" => $Data->logs])

                        @include('pages.commons.observations.body',['Observations' => $Data->observations])

                        @include('pages.commons.attachments.body',['Attachments' => $Data->attachments])

                    @endif
                </div>

            </div>
        </div>

        @if(isset($Data) && $Data->children->count() > 0)
            <div class="card">
                <h4 class="card-title"><strong>{{$Data->children->count()}}</strong> {{$Page->names}} secudárias</h4>

                <div class="card-content">
                    <div class="card-body">

                        <table class="table table-striped table-bordered" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Autor</th>
                                <th>Fornecedor</th>
                                <th>Referência</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Data de Baixa</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Autor</th>
                                <th>Fornecedor</th>
                                <th>Referência</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Data de Baixa</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($Data->children as $sel)
                                <tr>
                                    <td data-order="{{$sel->id}}">@include('layout.inc.buttons.show')</td>
                                    <td data-order="{{$sel->status_array['text']}}">
                                        <span class="badge badge-{{$sel->status_array['color']}}">{{$sel->status_array['text']}}</span>
                                    </td>
                                    <td>
                                        {{$sel->owner->getName()}}
                                    </td>
                                    <td>
                                        @can('suppliers.edit')
                                            <a target="_blank" href="{{route('suppliers.edit', $sel->supplier_id)}}">{{$sel->supplier->getName()}}</a>
                                        @else
                                            @can('suppliers.show')
                                                <a target="_blank" href="{{route('suppliers.show', $sel->supplier_id)}}">{{$sel->supplier->getName()}}</a>
                                            @else
                                                {{$sel->supplier->getName()}}
                                            @endcan
                                        @endcan
                                    </td>
                                    <td data-order="{{$sel->reference_time}}">{{$sel->reference_formatted}}</td>
                                    <td data-order="{{$sel->value}}">{{$sel->value_formatted}}</td>
                                    <td data-order="{{$sel->due_time}}">{{$sel->due_formatted}}</td>
                                    <td data-order="{{$sel->paid_at_time}}">
                                        <span class="badge badge-{{$sel->paid_at_array['color']}}">{{$sel->paid_at_array['text']}}</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-square btn-outline btn-secondary"
                                           target="_blank" href="{{route("expenses.print", $sel->id)}}"><i class="fa fa-print"></i></a>
                                        @if($sel->canSendToApprove())
                                            <button class="btn btn-a btn-square  btn-info btn-label btn-send"
                                                    data-id="expense-send-to-approve"
                                                    data-href="{{route("expenses.send-to-approve", [$sel->id, true])}}"><label><i class="ti-share"></i></label>
                                            </button>
                                        @endif
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

    <!-- Jquery Maskmoney Plugin Js -->
    @include('layout.inc.maskmoney.js')

    <script>

        app.ready(function() {

            function SwalQuestion( title, text, callback ){

                swal({
                    title: title,
                    text: text,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-secondary',
                    buttonsStyling: false
                }).then(
                    function (isConfirm) {
                        if (typeof isConfirm.dismiss == 'undefined') {
                            return callback()
                        } else {
                            swal(
                                'Cancelado',
                                'Sua ação foi cancelada',
                                'error'
                            );
                        }
                    }
                );
            }

            new select2Ajax( {
                el_select:'select[name=supplier_id]',
                placeholder:'Selecione o Fornecedor',
                url: "{{route('ajax.human_resources.suppliers.index')}}",
                value: ["{{isset($Data) ? $Data->supplier_id : (Request::has('supplier_id') ? Request::get('supplier_id') : "")}}"]
            })

            new select2Ajax( {
                el_select:'select[name=conveyor_id]',
                placeholder:'Selecione o Transportador',
                url: "{{route('ajax.moviments.conveyors.index')}}",
                value: ["{{isset($Data) ? $Data->conveyor_id : (Request::has('conveyor_id') ? Request::get('conveyor_id') : "")}}"]
            })


            $('input[name="supplier_type"]').change(function () {
                if ($(this).prop('checked')) {
                    //conveyor_id
                    $('select[name=conveyor_id]').attr('required', true);
                    $('select[name=conveyor_id]').closest("div.form-group").show();

                    $('select[name=supplier_id]').attr('required', false);
                    $('select[name=supplier_id]').closest("div.form-group").hide();

                } else {
                    //supplier_id
                    $('select[name=supplier_id]').attr('required', true);
                    $('select[name=supplier_id]').closest("div.form-group").show();

                    $('select[name=conveyor_id]').attr('required', false);
                    $('select[name=conveyor_id]').closest("div.form-group").hide();

                }
            });

            @if(isset($Data))

                $('button.btn-rem').on('click', function(){
                    SwalQuestion( "Deseja remover esta despesa?",
                        "{{$Data->isMain() ? "Todas as despesas secundárias recorrentes serão removidas. " : ""}}Esta ação não poderá ser desfeita!", () => {
                        $(`<form action="{{route("expenses.destroy", $Data->id)}}" method="POST">
                        <input type="hidden" value="delete" name="_method">
                        <input type="hidden" value="{{csrf_token()}}" name="_token"></form>`).appendTo('body').submit();
                    })
                });

                $('button.btn-send').on('click', function(){
                    let t = "";
                    let m = "";
                    let h = $(this).data('href');
                    let target = $(this).data('id');
                    if(target == 'expense-approve'){
                        t = "Deseja aprovar esta despesa?";
                        m = "Despesa aprovada não permite inclusão/alteração! Deseja continuar?";
                    } else if(target == 'expense-send-to-approve') {
                        t = "Deseja enviar esta despesa para aprovação?";
                    } else if(target == 'expense-destroy') {
                        t = "Deseja remover esta despesa?";
                        m = "Esta ação não poderá ser desfeita!";
                    }
                    SwalQuestion( t, m, () => {
                        window.location.href = h;
                    })
                });

                @if(!$Data->isApproved())

                    $('#modal-justification').on('show.bs.modal', function (event) {
                        let $button = $(event.relatedTarget);
                        let href = $($button).data('href');
                        let $parent = $(this).find('div.modal-content');
                        let target = $($button).data('id');
                        let t = "";
                        if(target == 'expense-unapprove') {
                            t = "Reprovar Despesa";
                        } else if(target == 'expense-cancel') {
                            t = "Cancelar Aprovação de Despesa";
                        }

                        $($parent).find("h4.modal-title").html(t);
                        $($parent).find("form").attr("action", href);

                    });

                @endif


                $('#modal-recurrency').on('show.bs.modal', function (event) {
                    //
                    let $button = $(event.relatedTarget);
                    let href = $($button).data('href');
                    let target = $($button).data('id');
                    let $parent = $(this).find('div.modal-content');
                    let t = ""
                    if(typeof target !== "undefined"){
                        if(target == 'expense-duplicate') {
                            t = "Duplicar Despesa";
                            $($parent).find("input[name=quantity]").closest("div.form-row").hide();
                        } else if(target == 'expense-recurrency')  {
                            t = "Gerar Recorrência";
                            $($parent).find("input[name=quantity]").closest("div.form-row").show();
                        }

                        $($parent).find("h4.modal-title").html(t);
                        $($parent).find("form").attr("action", href);
                    }

                });


                @if($Data->supplier_type)
                    $('input[name="supplier_type"]').trigger("click");
                @endif

            @else

                @if(Request::has('supplier_type'))
                    $('input[name="supplier_type"]').trigger("click");
                @endif

            @endif

            $('input[name="supplier_type"]').trigger("change")

        })
    </script>

    <!-- Observations Js -->
    @include('layout.inc.observations.js')

    <!-- Sample data to populate jsGrid demo tables -->
    @include('layout.inc.datatable.js')

    <!-- Sample data to populate jsGrid demo tables -->
    @include('layout.inc.attachments.js')

    @include('layout.inc.inputmask.js')

@endsection
