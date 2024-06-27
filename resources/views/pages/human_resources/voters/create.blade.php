@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.defaultsubmenu',['entity'=>$Page->entity, 'removeds' => true])

@endsection

@section('page_content')
    <!-- Main container -->
    <div class="main-content">

        @include('layout.inc.alerts')

        <div class="card">

            <h4 class="card-title"><strong>Dados do {{$Page->name}}</strong></h4>

            {{Form::open(array(
                'route' => ['voters.store'],
                'method'=>'POST',
                'files'=>'true',
                'data-provide'=> "validation",
                'data-disable'=>'false'
            )
            )}}

            <div class="card-body">

                <h6 class="text-uppercase mt-3">Identificação</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <div class="form-group col-12">
                        {!! Html::decode(Form::label('image', 'Imagem <i class="fa fa-question-circle"
                            data-provide="tooltip"
                            data-placement="right"
                            data-tooltip-color="primary"
                            data-original-title="'.config('system.pictures.message').'"></i>', array('class' => 'col-form-label'))) !!}
                        <input name="image" type="file" data-provide="dropify" data-height="100">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-8">
                        {!! Html::decode(Form::label('name', 'Nome', array('class' => 'col-form-label'))) !!}
                        {{Form::text('name', old('name'), ['id'=>'name','placeholder'=>'Nome completo','class'=>'form-control','minlength'=>'3','maxlength'=>'191','required'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('surname', 'Apelido', array('class' => 'col-form-label'))) !!}
                        {{Form::text('surname', old('surname'), ['placeholder'=>'Apelido','class'=>'form-control','minlength'=>'3', 'maxlength'=>'191'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('cpf', 'CPF', array('class' => 'col-form-label'))) !!}
                        {{Form::text('cpf', old('cpf'), ['placeholder'=>'CPF','class'=>'form-control show-cpf','minlength'=>'3', 'maxlength'=>'16'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-2">
                        {!! Html::decode(Form::label('birthday', 'Data Nascimento', array('class' => 'col-form-label'))) !!}
                        <i class="fa fa-question-circle"
                           data-provide="tooltip"
                           data-placement="top"
                           data-tooltip-color="primary"
                           data-original-title="Caso não saiba a data de nascimento, insira a idade aproximada."></i>
                        {{Form::text('birthday',old("birthday"), ['placeholder'=>'Data Nascimento','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR"])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-2">
                        {!! Html::decode(Form::label('years_approximate', 'Idade Aproximada', array('class' => 'col-form-label'))) !!}
                        <i class="fa fa-question-circle"
                           data-provide="tooltip"
                           data-placement="top"
                           data-tooltip-color="primary"
                           data-original-title="Caso não saiba a data de nascimento, insira a idade aproximada."></i>
                        {{Form::number('years_approximate',old("years_approximate"), ['placeholder'=>'Idade Aprox.','class'=>'form-control','min'=>0, 'max'=>150])}}
                        <div class="invalid-feedback"></div>
                    </div>

                </div>

                @include('pages.human_resources.forms.address')

                <h6 class="text-uppercase mt-3">Contato</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('whatsapp', 'Whatsapp', array('class' => 'col-form-label'))) !!}
                        {{Form::text('whatsapp', old('whatsapp'), ['placeholder' => 'Telefone', 'class'=>'form-control show-whatsapp'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-8">
                        {!! Html::decode(Form::label('other_phones', 'Outros telefones', array('class' => 'col-form-label'))) !!}
                        {{Form::text('other_phones', old('other_phones'), ['placeholder' => 'Outros telefones', 'class'=>'form-control'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('email', 'Email', array('class' => 'col-form-label'))) !!}
                        {{Form::email('email', old('email'), ['placeholder' => 'Email', 'class'=>'form-control', 'maxlength'=>'191'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-8">
                        {!! Html::decode(Form::label('instagram', 'Instagram', array('class' => 'col-form-label'))) !!}
                        {{Form::text('instagram', old('instagram'), ['placeholder' => 'Instagram', 'class'=>'form-control', 'maxlength'=>'191'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Dados eleitorais</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <div class="form-group col-2">
                        {!! Html::decode(Form::label('voter_registration_zone', 'nº Zona Eleitoral', array('class' => 'col-form-label'))) !!}
                        {{Form::text('voter_registration_zone', old('voter_registration_zone'), ['placeholder' => 'nº Zona Eleitoral', 'class'=>'form-control', 'maxlength'=>'191'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-2">
                        {!! Html::decode(Form::label('voter_registration_session', 'nº Seção Eleitoral', array('class' => 'col-form-label'))) !!}
                        {{Form::text('voter_registration_session', old('voter_registration_session'), ['placeholder' => 'nº Seção Eleitoral', 'class'=>'form-control', 'maxlength'=>'191'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('location_of_operation', 'Regiões da cidade que tem influência', array('class' => 'col-form-label'))) !!}
                        {{Form::text('location_of_operation', old('location_of_operation'), ['placeholder' => 'Regiões da cidade que tem influência', 'class'=>'form-control', 'maxlength'=>'191'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('votes_estimate', 'Potencial de votos do eleitor', array('class' => 'col-form-label'))) !!}
                        {{Form::number('votes_estimate', old('votes_estimate'), ['placeholder' => 'Potencial de votos do eleitor', 'class'=>'form-control','min'=>0])}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-4">
                        {!! Html::decode(Form::label('votes_degree_certainty', 'Grau de certeza de voto', array('class' => 'col-form-label'))) !!}
                        <input type="hidden" name="votes_degree_certainty" class="text-primary ml-1 fw-500">
                        <div data-provide="slider" data-tooltips="true" data-min="0" data-max="10" data-value="0"
                             data-target="prev" class="mr-3 ml-3"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        {!! Html::decode(Form::label('social_history', 'Histórico Função Social ', array('class' => 'col-form-label'))) !!}
                        {{Form::textarea('social_history', old('social_history'), ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'16777'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <footer class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </footer>

            </div>

            {{Form::close()}}
        </div>

    </div><!--/.main-content -->

@endsection

@section('script_content')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.inputmask.js')

    @include('layout.inc.address.js')

@endsection
