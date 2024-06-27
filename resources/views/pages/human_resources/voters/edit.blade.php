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

                        <h6 class="text-uppercase mt-3">Identificação</h6>
                        <hr class="hr-sm mb-2">
                        <div class="form-row">
                            @if($Voter->image)
                                <div class="col-2" data-provide="photoswipe">
                                    <a href="#">
                                        <img style="max-width: 240px;" class="avatar avatar-xxxl avatar-bordered"
                                             data-original-src="{{$Voter->link_download}}"
                                             src="{{$Voter->link_download}}" alt="">
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                {!! Html::decode(Form::label('name', 'Nome', array('class' => 'col-form-label require'))) !!}
                                {{Form::text('name', $Voter->name, ['id'=>'name','placeholder'=>'Nome completo','class'=>'form-control','minlength'=>'3','maxlength'=>'191','required'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-3">
                                {!! Html::decode(Form::label('surname', 'Apelido', array('class' => 'col-form-label'))) !!}
                                {{Form::text('surname', $Voter->surname, ['placeholder'=>'Apelido','class'=>'form-control','minlength'=>'3', 'maxlength'=>'191'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-3">
                                {!! Html::decode(Form::label('image', 'Foto <i class="fa fa-question-circle"
                                    data-provide="tooltip"
                                    data-placement="right"
                                    data-tooltip-color="primary"
                                    data-original-title="'.config('system.pictures.message').'"></i>', array('class' => 'col-form-label'))) !!}
                                <div class="input-group file-group">
                                    <input type="text" class="form-control file-value" placeholder="Choose file..." readonly="">
                                    <input name="image" type="file" multiple="">
                                    <span class="input-group-append">
                                            <button class="btn btn-light file-browser" type="button"><i class="fa fa-upload"></i></button>
                                        </span>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                {!! Html::decode(Form::label('cpf', 'CPF', array('class' => 'col-form-label'))) !!}
                                {{Form::text('cpf', $Voter->cpf, ['placeholder'=>'CPF','class'=>'form-control show-cpf','minlength'=>'3', 'maxlength'=>'16'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-2">
                                {!! Html::decode(Form::label('birthday', 'Data Nascimento', array('class' => 'col-form-label'))) !!}
                                <i class="fa fa-question-circle"
                                   data-provide="tooltip"
                                   data-placement="top"
                                   data-tooltip-color="primary"
                                   data-original-title="Caso não saiba a data de nascimento, insira a idade aproximada."></i>
                                {{Form::text('birthday', $Voter->birthday_formatted, ['placeholder'=>'Data Nascimento','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR"])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-2">
                                {!! Html::decode(Form::label('years_approximate', 'Idade Aproximada', array('class' => 'col-form-label'))) !!}
                                <i class="fa fa-question-circle"
                                   data-provide="tooltip"
                                   data-placement="top"
                                   data-tooltip-color="primary"
                                   data-original-title="Caso não saiba a data de nascimento, insira a idade aproximada."></i>
                                {{Form::number('years_approximate',$Voter->years_approximate, ['placeholder'=>'Idade Aprox.','class'=>'form-control','min'=>0, 'max'=>150])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-2">
                                {!! Html::decode(Form::label('death', 'Óbito?', array('class' => 'col-form-label'))) !!}
                                <i class="fa fa-question-circle"
                                   data-provide="tooltip"
                                   data-placement="top"
                                   data-tooltip-color="primary"
                                   data-original-title="Em caso de óbito, preencha a data de óbito!"></i>
                                <div class="form-group">
                                    <input type="checkbox" data-provide="switchery" name="death" data-size="small"
                                           @if($Voter->death) checked @endif> Sim
                                </div>
                            </div>
                            <div class="form-group col-2">
                                {!! Html::decode(Form::label('death_date', 'Data Óbito', array('class' => 'col-form-label'))) !!}
                                {{Form::text('death_date',$Voter->death_date_formatted,
                                    ['placeholder'=>'Data Óbito','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", ($Voter->death ? "required" : "disabled")])}}
                                <div class="invalid-feedback"></div>
                            </div>

                        </div>

                        @include('pages.human_resources.forms.address', ['Address' => $Voter->address])

                        <h6 class="text-uppercase mt-3">Contato</h6>
                        <hr class="hr-sm mb-2">
                        <div class="form-row">
                            <div class="form-group col-4">
                                {!! Html::decode(Form::label('whatsapp', 'Whatsapp', array('class' => 'col-form-label'))) !!}
                                {{Form::text('whatsapp', $Voter->whatsapp_formatted, ['placeholder' => 'Telefone', 'class'=>'form-control show-whatsapp'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-8">
                                {!! Html::decode(Form::label('other_phones', 'Outros telefones', array('class' => 'col-form-label'))) !!}
                                {{Form::text('other_phones', $Voter->other_phones, ['placeholder' => 'Outros telefones', 'class'=>'form-control'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                {!! Html::decode(Form::label('email', 'Email', array('class' => 'col-form-label'))) !!}
                                {{Form::email('email', $Voter->email, ['placeholder' => 'Email', 'class'=>'form-control', 'maxlength'=>'191'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-8">
                                {!! Html::decode(Form::label('instagram', 'Instagram', array('class' => 'col-form-label'))) !!}
                                {{Form::text('instagram', $Voter->instagram, ['placeholder' => 'Instagram', 'class'=>'form-control', 'maxlength'=>'191'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <h6 class="text-uppercase mt-3">Dados eleitorais</h6>
                        <hr class="hr-sm mb-2">
                        <div class="form-row">
                            <div class="form-group col-6">
                                {!! Html::decode(Form::label('polling_place', 'Local de Votação ', array('class' => 'col-form-label require'))) !!}
                                {{Form::select('polling_place', [], '', ['placeholder' => 'Escolha o Local de Votação', 'class'=>'form-control select2_single', 'required'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-3">
                                {!! Html::decode(Form::label('voter_registration_zone', 'nº Zona Eleitoral', array('class' => 'col-form-label'))) !!}
                                {{Form::text('voter_registration_zone', $Voter->voter_registration_zone, ['placeholder' => 'nº Zona Eleitoral', 'class'=>'form-control', 'maxlength'=>'191'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-3">
                                {!! Html::decode(Form::label('voter_registration_session', 'nº Seção Eleitoral', array('class' => 'col-form-label'))) !!}
                                {{Form::text('voter_registration_session', $Voter->voter_registration_session, ['placeholder' => 'nº Seção Eleitoral', 'class'=>'form-control', 'maxlength'=>'191'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                {!! Html::decode(Form::label('location_of_operation', 'Regiões da cidade que tem influência', array('class' => 'col-form-label'))) !!}
                                {{Form::text('location_of_operation', $Voter->location_of_operation, ['placeholder' => 'Regiões da cidade que tem influência', 'class'=>'form-control', 'maxlength'=>'191'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                {!! Html::decode(Form::label('votes_estimate', 'Potencial de votos do eleitor', array('class' => 'col-form-label'))) !!}
                                {{Form::number('votes_estimate', $Voter->votes_estimate, ['placeholder' => 'Potencial de votos do eleitor', 'class'=>'form-control','min'=>0])}}
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-4">
                                {!! Html::decode(Form::label('votes_degree_certainty', 'Grau de certeza de voto', array('class' => 'col-form-label require'))) !!}
                                {{Form::select('votes_degree_certainty', range(0,10), $Voter->votes_degree_certainty, ['placeholder' => 'Escolha o Grau de certeza de voto', 'class'=>'form-control select2_single', 'required'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        @role('registrar')
                            <div class="form-row">
                                <div class="form-group col-12">
                                    {!! Html::decode(Form::label('registrar_observations', 'Observações gerais do Cabo Eleitoral ', array('class' => 'col-form-label'))) !!}
                                    {{Form::textarea('registrar_observations', $Voter->registrar_observations, ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'65000'])}}
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        @else
                            <div class="form-row">
                                <div class="form-group col-12">
                                    {!! Html::decode(Form::label('admin_observations', 'Observações gerais da Coordenação ', array('class' => 'col-form-label'))) !!}
                                    {{Form::textarea('admin_observations', $Voter->admin_observations, ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'65000'])}}
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        @endrole
                        <div class="form-row">
                            <div class="form-group col-12">
                                {!! Html::decode(Form::label('social_history', 'Histórico Função Social ', array('class' => 'col-form-label'))) !!}
                                {{Form::textarea('social_history', $Voter->social_history, ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'65000'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

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
                                    <table class="table table-striped table-bordered table-responsive-sm"
                                           data-provide="datatables">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Adicionado em</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Adicionado em</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($Voter->groups as $group)
                                            <tr>
                                                <td><a href="{{route('groups.show',$group->id)}}"
                                                       target="_blank">{{$group->id}}</a></td>
                                                <td data-order="{{$group->pivot->created_at_time_formatted}}">{{$group->pivot->created_at_formatted}}</td>
                                                <td>{{$group->description}}</td>
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
