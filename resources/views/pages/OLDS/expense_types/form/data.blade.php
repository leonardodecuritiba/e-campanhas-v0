<div class="card-body">

    <div class="form-row">
        <div class="form-group col-md-4">
            {!! Html::decode(Form::label('code', 'Código', array('class' => 'col-form-label'))) !!}
            {{Form::text('code', Request::get('code',(isset($Data) ? $Data->code : "")), ['placeholder'=>'Código','class'=>'form-control','minlength'=>'3', 'maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-8">
            {!! Html::decode(Form::label('description', 'Nome', array('class' => 'col-form-label'))) !!}
            {{Form::text('description', Request::get('description',(isset($Data) ? $Data->description : "")), ['placeholder'=>'Descrição','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100'])}}
            <div class="invalid-feedback"></div>
        </div>
    </div>

</div>

<footer class="card-footer text-right">
    <button class="btn btn-primary" type="submit">Salvar</button>
</footer>


