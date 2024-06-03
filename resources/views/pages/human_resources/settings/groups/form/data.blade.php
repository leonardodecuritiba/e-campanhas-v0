<div class="card-body">

    <div class="form-row">
        <div class="form-group col-md-12">
            {!! Html::decode(Form::label('description', 'Nome', array('class' => 'col-form-label'))) !!}
            {{Form::text('description', old('description',(isset($Data) ? $Data->description : "")), ['placeholder'=>'Descrição','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100'])}}
            <div class="invalid-feedback"></div>
        </div>
    </div>

</div>

<footer class="card-footer text-right">
    <button class="btn btn-primary" type="submit">Salvar</button>
</footer>


