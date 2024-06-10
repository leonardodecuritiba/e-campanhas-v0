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

            <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->name}}</strong></h4>

            {{Form::model($Data,
            array(
                'route' => ['voters.update', $Data->id],
                'method'=>'POST',
                'method'=>'PATCH',
                'data-provide'=> "validation",
                'data-disable'=>'false'
            )
            )}}
{{--                @include('pages.human_resources.users.form.data')--}}

                <div class="card-body">

                    <h6 class="text-uppercase mt-3">Identificação</h6>
                    <hr class="hr-sm mb-2">
                    <div class="form-row">
                        <div class="form-group col-8">
                            {!! Html::decode(Form::label('name', 'Nome', array('class' => 'col-form-label'))) !!}
                            {{Form::text('name', $Data->name, ['id'=>'name','placeholder'=>'Nome completo','class'=>'form-control','minlength'=>'3','maxlength'=>'191','required'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('surname', 'Apelido', array('class' => 'col-form-label'))) !!}
                            {{Form::text('surname', $Data->surname, ['placeholder'=>'Apelido','class'=>'form-control','minlength'=>'3', 'maxlength'=>'191'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('cpf', 'CPF', array('class' => 'col-form-label'))) !!}
                            {{Form::text('cpf', $Data->cpf, ['placeholder'=>'CPF','class'=>'form-control show-cpf','minlength'=>'3', 'maxlength'=>'16'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            {!! Html::decode(Form::label('birthday', 'Data Nascimento', array('class' => 'col-form-label'))) !!}
                            <i class="fa fa-question-circle"
                               data-provide="tooltip"
                               data-placement="top"
                               data-tooltip-color="primary"
                               data-original-title="Caso não saiba a data de nascimento, insira a idade aproximada."></i>
                            {{Form::text('birthday', $Data->birthday_formatted, ['placeholder'=>'Data Nascimento','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR"])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-2">
                            {!! Html::decode(Form::label('years_approximate', 'Idade Aproximada', array('class' => 'col-form-label'))) !!}
                            <i class="fa fa-question-circle"
                               data-provide="tooltip"
                               data-placement="top"
                               data-tooltip-color="primary"
                               data-original-title="Caso não saiba a data de nascimento, insira a idade aproximada."></i>
                            {{Form::number('years_approximate',$Data->years_approximate, ['placeholder'=>'Idade Aprox.','class'=>'form-control','min'=>0, 'max'=>150])}}
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
                                <input type="checkbox" data-provide="switchery" name="death" data-size="small" @if($Data->death) checked @endif> Sim
                            </div>
                        </div>
                        <div class="form-group col-2">
                            {!! Html::decode(Form::label('death_date', 'Data Óbito', array('class' => 'col-form-label'))) !!}
                            {{Form::text('death_date',$Data->death_date_formatted,
                                ['placeholder'=>'Data Óbito','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", ($Data->death ? "required" : "disabled")])}}
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            {!! Html::decode(Form::label('image', 'Imagem <i class="fa fa-question-circle"
                                data-provide="tooltip"
                                data-placement="right"
                                data-tooltip-color="primary"
                                data-original-title="'.config('system.pictures.message').'"></i>', array('class' => 'col-form-label'))) !!}
                            <input name="image" type="file" data-provide="dropify">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <h6 class="text-uppercase mt-3">Contato</h6>
                    <hr class="hr-sm mb-2">
                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('whatsapp', 'Whatsapp', array('class' => 'col-form-label'))) !!}
                            {{Form::text('whatsapp', $Data->whatsapp_formatted, ['placeholder' => 'Telefone', 'class'=>'form-control show-whatsapp'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-8">
                            {!! Html::decode(Form::label('other_phones', 'Outros telefones', array('class' => 'col-form-label'))) !!}
                            {{Form::text('other_phones', $Data->other_phones, ['placeholder' => 'Outros telefones', 'class'=>'form-control'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('email', 'Email', array('class' => 'col-form-label'))) !!}
                            {{Form::email('email', $Data->email, ['placeholder' => 'Email', 'class'=>'form-control', 'maxlength'=>'191'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-8">
                            {!! Html::decode(Form::label('instagram', 'Instagram', array('class' => 'col-form-label'))) !!}
                            {{Form::text('instagram', $Data->instagram, ['placeholder' => 'Instagram', 'class'=>'form-control', 'maxlength'=>'191'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <h6 class="text-uppercase mt-3">Dados eleitorais</h6>
                    <hr class="hr-sm mb-2">
                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('voter_registration_zone', 'Tit. eleitor zona', array('class' => 'col-form-label'))) !!}
                            {{Form::text('voter_registration_zone', $Data->voter_registration_zone, ['placeholder' => 'Tit. eleitor zona', 'class'=>'form-control', 'maxlength'=>'191'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-8">
                            {!! Html::decode(Form::label('voter_registration_session', 'Tit. eleitor seção', array('class' => 'col-form-label'))) !!}
                            {{Form::text('voter_registration_session', $Data->voter_registration_session, ['placeholder' => 'Tit. eleitor zona', 'class'=>'form-control', 'maxlength'=>'191'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('votes_estimate', 'Estimativa de votos', array('class' => 'col-form-label'))) !!}
                            {{Form::number('votes_estimate', $Data->votes_estimate, ['placeholder' => 'Estimativa de votos', 'class'=>'form-control','min'=>0])}}
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col-4">
                            {!! Html::decode(Form::label('votes_degree_certainty', 'Grau de certeza', array('class' => 'col-form-label'))) !!}
                            <input type="hidden" name="votes_degree_certainty" class="text-primary ml-1 fw-500">
                            <div data-provide="slider" data-tooltips="true" data-min="0" data-max="10" data-value="{{$Data->votes_degree_certainty}}" data-target="prev" class="mr-3 ml-3"></div>
                        </div>
                        <div class="form-group col-2">
                            {!! Html::decode(Form::label('electoral_campaigner', 'Cabo Eleitoral?', array('class' => 'col-form-label'))) !!}
                            <div class="form-group">
                                <input type="checkbox" data-provide="switchery" name="electoral_campaigner" data-size="small" @if($Data->electoral_campaigner) checked @endif> Sim
                            </div>
                        </div>
                        <div class="form-group col-2">
                            {!! Html::decode(Form::label('supporter', 'Apoiador?', array('class' => 'col-form-label'))) !!}
                            <div class="form-group">
                                <input type="checkbox" data-provide="switchery" name="supporter" data-size="small" @if($Data->supporter) checked @endif> Sim
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            {!! Html::decode(Form::label('social_history', 'Histórico Função Social ', array('class' => 'col-form-label'))) !!}
                            {{Form::textarea('social_history', $Data->social_history, ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'16777'])}}
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

    @include('layout.inc.inputmask.js')

    <script>

        app.ready(function() {

            $('input[name="death"]').change(function () {
                const $input_death_date = $(this).closest('div.card-body').find('input[name=death_date]');
                if ($(this).prop('checked')) {
                    //HABILITAR E REQUIRED
                    $($input_death_date).val("").attr("required", true).attr("disabled", false);
                } else {
                    //DESABILITAR E NÃO REQUIRED
                    $($input_death_date).val("").attr("required", false).attr("disabled", true);

                }
            });

        });
    </script>


@endsection
