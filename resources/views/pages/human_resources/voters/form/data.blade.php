<h6 class="text-uppercase mt-3">Identificação</h6>
<hr class="hr-sm mb-2">

@if(isset($Voter))
    <div class="form-row">
        @if($Voter->image)
            <div class="col-2" data-provide="photoswipe">
                <a href="#">
                    <img class="avatar avatar-xxxl avatar-bordered"
                         data-original-src="{{$Voter->link_download}}"
                         src="{{$Voter->link_download}}" alt="">
                </a>
            </div>
        @endif
    </div>
@endif

<div class="form-row">

    <div class="form-group col-xl-6 col-lg-6 col-md-5 col-12">
        {!! Html::decode(Form::label('name', 'Nome', array('class' => 'col-form-label require'))) !!}
        {{Form::text('name', old('name', isset($Voter) ? $Voter->name : ''), ['id'=>'name','placeholder'=>'Nome completo','class'=>'form-control','minlength'=>'3','maxlength'=>'191','required'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-3 col-lg-3 col-md-4 col-12">
        {!! Html::decode(Form::label('surname', 'Apelido', array('class' => 'col-form-label'))) !!}
        {{Form::text('surname', old('surname', isset($Voter) ? $Voter->surname : ''), ['placeholder'=>'Apelido','class'=>'form-control','minlength'=>'3', 'maxlength'=>'191'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-12">
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

    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">
        {!! Html::decode(Form::label('cpf', 'CPF', array('class' => 'col-form-label'))) !!}
        {{Form::text('cpf', old('cpf', isset($Voter) ? $Voter->cpf : ''), ['placeholder'=>'CPF','class'=>'form-control show-cpf','minlength'=>'3', 'maxlength'=>'16'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-12">
        {!! Html::decode(Form::label('hasnt_birthday', 'Sabe a Data Nascimento?', array('class' => 'col-form-label'))) !!}
        <div class="form-group">
            <input type="checkbox" data-provide="switchery" name="hasnt_birthday" data-size="small"> Não sei
        </div>
    </div>

    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-12 birthday">
        {!! Html::decode(Form::label('birthday', 'Data Nascimento', array('class' => 'col-form-label require'))) !!}
        <i class="fa fa-question-circle"
           data-provide="tooltip"
           data-placement="top"
           data-tooltip-color="primary"
           data-original-title="Caso não saiba a data de nascimento, marque como Não sei."></i>
        {{Form::text('birthday', old('birthday', isset($Voter) ? $Voter->birthday_formatted : ''), ['placeholder'=>'Data Nascimento','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", 'required'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-12 years_approximate" style="display: none;">
        {!! Html::decode(Form::label('years_approximate', 'Idade Aproximada', array('class' => 'col-form-label require'))) !!}
        {{Form::number('years_approximate', old('birthday', isset($Voter) ? $Voter->years_approximate : ''), ['placeholder'=>'Idade Aprox.','class'=>'form-control','min'=>0, 'max'=>150])}}
        <div class="invalid-feedback"></div>
    </div>

    @if(isset($Voter))

        <div class="form-group col-xl-2 col-lg-4 col-md-4 col-4">
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

        <div class="form-group col-xl-2 col-lg-4 col-md-4 col-8">
            {!! Html::decode(Form::label('death_date', 'Data Óbito', array('class' => 'col-form-label'))) !!}
            {{Form::text('death_date',$Voter->death_date_formatted,
                ['placeholder'=>'Data Óbito','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", ($Voter->death ? "required" : "disabled")])}}
            <div class="invalid-feedback"></div>
        </div>

    @endif

</div>

@include('pages.human_resources.forms.address', ['Address' => isset($Voter) ? $Voter->address : null])

<h6 class="text-uppercase mt-3">Contato</h6>
<hr class="hr-sm mb-2">

<div class="form-row">

    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">
        {!! Html::decode(Form::label('whatsapp', 'Whatsapp', array('class' => 'col-form-label'))) !!}
        {{Form::text('whatsapp', old('whatsapp', isset($Voter) ? $Voter->whatsapp : ''), ['placeholder' => 'Telefone', 'class'=>'form-control show-whatsapp'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-8 col-lg-8 col-md-8 col-12">
        {!! Html::decode(Form::label('other_phones', 'Outros telefones', array('class' => 'col-form-label'))) !!}
        {{Form::text('other_phones', old('other_phones', isset($Voter) ? $Voter->other_phones : ''), ['placeholder' => 'Outros telefones', 'class'=>'form-control'])}}
        <div class="invalid-feedback"></div>
    </div>

</div>

<div class="form-row">

    <div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">
        {!! Html::decode(Form::label('email', 'Email', array('class' => 'col-form-label'))) !!}
        {{Form::email('email', old('email', isset($Voter) ? $Voter->email : ''), ['placeholder' => 'Email', 'class'=>'form-control', 'maxlength'=>'191'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-8 col-lg-8 col-md-8 col-12">
        {!! Html::decode(Form::label('instagram', 'Instagram', array('class' => 'col-form-label'))) !!}
        {{Form::text('instagram', old('instagram', isset($Voter) ? $Voter->instagram : ''), ['placeholder' => 'Instagram', 'class'=>'form-control', 'maxlength'=>'191'])}}
        <div class="invalid-feedback"></div>
    </div>

</div>


<h6 class="text-uppercase mt-3">Dados eleitorais</h6>
<hr class="hr-sm mb-2">
<div class="form-row">

    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-12">
        {!! Html::decode(Form::label('polling_place', 'Local de Votação ', array('class' => 'col-form-label'))) !!}
        {{Form::select('polling_place', [], '', ['placeholder' => 'Escolha o Local de Votação', 'class'=>'form-control select2_single'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-12">
        {!! Html::decode(Form::label('voter_registration_zone', 'Nº Zona Eleitoral', array('class' => 'col-form-label'))) !!}
        {{Form::text('voter_registration_zone', old('voter_registration_zone', isset($Voter) ? $Voter->voter_registration_zone : ''), ['placeholder' => 'Nº Zona Eleitoral', 'class'=>'form-control', 'maxlength'=>'191'])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-12">
        {!! Html::decode(Form::label('voter_registration_session', 'Nº Seção Eleitoral', array('class' => 'col-form-label'))) !!}
        {{Form::text('voter_registration_session', old('voter_registration_session', isset($Voter) ? $Voter->voter_registration_session : ''), ['placeholder' => 'Nº Seção Eleitoral', 'class'=>'form-control', 'maxlength'=>'191'])}}
        <div class="invalid-feedback"></div>
    </div>

</div>
<div class="form-row">

    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-12">
        {!! Html::decode(Form::label('location_of_operation', 'Regiões da cidade que tem influência', array('class' => 'col-form-label'))) !!}
        {{Form::text('location_of_operation', old('location_of_operation', isset($Voter) ? $Voter->location_of_operation : ''), ['placeholder' => 'Regiões da cidade que tem influência', 'class'=>'form-control', 'maxlength'=>'191'])}}
        <div class="invalid-feedback"></div>
    </div>

</div>
<div class="form-row">

    <div class="form-group col-xl-4 col-lg-6 col-md-6 col-12">
        {!! Html::decode(Form::label('votes_estimate', 'Potencial de votos do eleitor', array('class' => 'col-form-label'))) !!}
        {{Form::number('votes_estimate', old('votes_estimate', isset($Voter) ? $Voter->votes_estimate : ''), ['placeholder' => 'Potencial de votos do eleitor', 'class'=>'form-control','min'=>0])}}
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group col-xl-4 col-lg-6 col-md-6 col-12">
        {!! Html::decode(Form::label('votes_degree_certainty', 'Grau de certeza de voto', array('class' => 'col-form-label require'))) !!}
        {{Form::select('votes_degree_certainty', range(0,10), old('votes_degree_certainty', isset($Voter) ? $Voter->votes_degree_certainty : ''), ['placeholder' => 'Escolha o Grau de certeza de voto', 'class'=>'form-control select2_single', 'required'])}}
        <div class="invalid-feedback"></div>
    </div>

</div>
@role('registrar')
    <div class="form-row">

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-12">
            {!! Html::decode(Form::label('registrar_observations', 'Observações gerais do Cabo Eleitoral ', array('class' => 'col-form-label'))) !!}
            {{Form::textarea('registrar_observations', old('registrar_observations', isset($Voter) ? $Voter->registrar_observations : ''), ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'65000'])}}
            <div class="invalid-feedback"></div>
        </div>

    </div>
@else
    <div class="form-row">

        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-12">
            {!! Html::decode(Form::label('admin_observations', 'Observações gerais da Coordenação ', array('class' => 'col-form-label'))) !!}
            {{Form::textarea('admin_observations', old('admin_observations', isset($Voter) ? $Voter->admin_observations : ''), ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'65000'])}}
            <div class="invalid-feedback"></div>
        </div>

    </div>
@endrole

<div class="form-row">

    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-12">
        {!! Html::decode(Form::label('social_history', 'Histórico Função Social ', array('class' => 'col-form-label'))) !!}
        {{Form::textarea('social_history', old('social_history', isset($Voter) ? $Voter->social_history : ''), ['class'=>'form-control','rows'=>5, 'minlength'=>'3', 'maxlength'=>'65000'])}}
        <div class="invalid-feedback"></div>

    </div>
</div>