<h6 class="text-uppercase mt-3">Dados de Endereço</h6>
<hr class="hr-sm mb-2">

<div class="form-row">
    <div class="form-group col-4">
        <label for="zip" class="col-form-label">CEP
            <a class="ml-2 text-info" href="#" data-toggle="modal" data-target="#modal-ceps"><i class="ti-search"></i> Consultar CEP</a>
        </label>
        {{Form::text('zip', old('zip', $Address->zip_formatted ?? ''), ['class'=>'form-control show-cep', 'placeholder'=>'CEP', 'maxlength'=>'16'])}}
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group col-3">
        {!! Html::decode(Form::label('state', 'Estado', array('class' => 'col-form-label require'))) !!}
        {{Form::select('state_id', [], old('state_id'), ['placeholder' => 'Escolha o Estado', 'class'=>'form-control select2_single','id' => 'select-state', 'required'])}}
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group col-5">
        {!! Html::decode(Form::label('city', 'Cidade', array('class' => 'col-form-label require'))) !!}
        {{Form::select('city_id', [], '', ['placeholder' => 'Escolha a Cidade', 'class'=>'form-control select2_single','id' => 'select-city', 'required'])}}
        <div class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        {!! Html::decode(Form::label('street', 'Logradouro', array('class' => 'col-form-label'))) !!}
        {{Form::text('street', old('street', $Address->street ?? ''), ['class'=>'form-control', 'placeholder'=>'Logradouro', 'maxlength'=>'125'])}}
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group col-2">
        {!! Html::decode(Form::label('number', 'Número', array('class' => 'col-form-label'))) !!}
        {{Form::text('number', old('number', $Address->number ?? ''), ['class'=>'form-control show-only-numbers', 'placeholder'=>'Número', 'maxlength'=>'30'])}}
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group col-4">
        {!! Html::decode(Form::label('complement', 'Complemento', array('class' => 'col-form-label'))) !!}
        {{Form::text('complement', old('complement', $Address->complement ?? ''), ['class'=>'form-control', 'placeholder'=>'Complemento', 'maxlength'=>'50', ])}}
        <div class="invalid-feedback"></div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-8">
        {!! Html::decode(Form::label('district', 'Bairro', array('class' => 'col-form-label'))) !!}
        {{Form::text('district', old('district', $Address->district ?? ''), ['class'=>'form-control', 'placeholder'=>'Bairro', 'maxlength'=>'72'])}}
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group col-2">
        {!! Html::decode(Form::label('latitude', 'Latitude', array('class' => 'col-form-label'))) !!}
        {{Form::text('latitude', old('latitude', $Address->latitude ?? ''), ['class'=>'form-control show-latitude', 'maxlength'=>'15'])}}
        <div class="invalid-feedback"></div>
    </div>
    <div class="form-group col-2">
        {!! Html::decode(Form::label('longitude', 'longitude', array('class' => 'col-form-label'))) !!}
        {{Form::text('longitude', old('longitude', $Address->longitude ?? ''), ['class'=>'form-control show-longitude', 'maxlength'=>'15'])}}
        <div class="invalid-feedback"></div>
    </div>
</div>
