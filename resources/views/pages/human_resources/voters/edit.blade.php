@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.defaultsubmenu',['entity'=>$Page->entity, 'removeds' => true])

@endsection

@section('page_modals')

    @include('pages.human_resources.voters.modal.groups', ['voter_id' => $Voter->id])

    @include('pages.human_resources.modal.cep')

@endsection

@section('page_content')

    <!-- Main container -->
    <div class="main-content">

        @include('layout.inc.alerts')

        <div class="card">

            <h4 class="card-title"><strong>#{{$Voter->id}} - {{$Voter->name}}</strong></h4>

            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="informations-tab" data-toggle="tab" href="#informations"
                           role="tab" aria-controls="informations" aria-selected="true">Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="associations-tab" data-toggle="tab" href="#associations" role="tab"
                           aria-controls="associations" aria-selected="true">Associações</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="informations" role="tabpanel"
                         aria-labelledby="informations-tab">

                        {{Form::model($Voter,
                        array(
                            'route' => ['voters.update', $Voter->id],
                            'method'=>'PATCH',
                            'files'=>'true',
                            'data-provide'=> "validation",
                            'data-disable'=>'false'
                        )
                        )}}

                            @include('pages.human_resources.voters.form.data')

                            <footer class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Salvar</button>
                            </footer>

                        {{Form::close()}}

                    </div>

                    <div class="tab-pane fade" id="associations" role="tabpanel" aria-labelledby="associations-tab">

                        <div class="card">

                            <div class="card-content">

                                <h4 class="card-title"><strong>Grupos</strong>
                                    <button class="btn btn-float btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modal-groups"><i class="ti-plus"></i></button>
                                </h4>

                                <div class="card-body">
                                    <table class="table table-striped table-bordered table-sm table-responsive-sm"
                                           data-provide="datatables">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descrição</th>
                                            <th>Adicionado em</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descrição</th>
                                            <th>Adicionado em</th>
                                            <th>Ações</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($Voter->groups as $group)
                                            <tr>
                                                <td><a href="{{route('groups.show',$group->id)}}"
                                                       target="_blank">{{$group->id}}</a></td>
                                                <td>{{$group->description}}</td>
                                                <td data-order="{{$group->pivot->created_at_time_formatted}}">{{$group->pivot->created_at_formatted}}</td>
                                                <td>
                                                    @include('layout.inc.buttons.delete',
                                                        [
                                                            'sel'=>$group,
                                                            'field_delete_route'=>route('voter.group.detach',['voter_id'=>$Voter->id,'group_id'=>$group->id]),
                                                            'field_delete'      => 'Eleitor'
                                                        ]
                                                    )
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div><!--/.main-content -->
@endsection

@section('script_content')

    @include('layout.inc.inputmask.js')

    <script>
        const _POOLING_PLACE_ = '{{$Voter->polling_place}}'
    </script>

    @include('pages.human_resources.voters.scripts.js')

    @if($Voter->years_approximate != null)
        <script>
            app.ready(function () {
                $('input[name="hasnt_birthday"]').trigger("click");
            });
        </script>
    @endif

    <script>

        app.ready(function () {

            $('#group_id').select2({
                dropdownParent: $('#modal-groups'),
                placeholder: 'Selecione..',
                ajax: {
                    url: `{{route('voters.availableGroups', $Voter->id)}}`,
                    dataType: 'json',
                    delay: 100,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.description,
                                    id: item.id
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3
            });

        });
    </script>

    @include('layout.inc.datatable.js')

    @include('layout.inc.sweetalert.js')

    <script>
        const _STATE_ = {
            id: "{{$Voter->address->state_id}}",
            text: "{{$Voter->address->state->name}}"
        };
        const _CITY_ = {
            id: "{{$Voter->address->city_id}}",
            text: "{{$Voter->address->city->name}}"
        };
    </script>
    
    @include('layout.inc.address.js')

@endsection
