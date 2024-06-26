<div class="card-body">

    <h6 class="text-uppercase mt-3">Dados de Acesso</h6>
    <hr class="hr-sm mb-2">

    @if(isset($User))

        <div class="form-row">
            <label class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{$User->id}}</p>
            </div>
        </div>
        <div class="form-row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <p class="form-control-plaintext">{{$User->getEmail()}}</p>
            </div>
        </div>
        <div class="form-row pull-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#changePasswordUser">Alterar Senha</button>
        </div>
    @else

        <div class="form-row">
            <div class="form-group col-6">
                {!! Html::decode(Form::label('email', 'Email', array('class' => 'col-form-label require'))) !!}
                {{Form::email('email', '', ['id'=>'email','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required', 'autocomplete'=>'off'])}}
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group col-6">
                {!! Html::decode(Form::label('password', 'Senha', array('class' => 'col-form-label require'))) !!}
                {{Form::password('password', ['id'=>'password','placeholder'=>'Senha','class'=>'form-control','minlength'=>'3', 'maxlength'=>'20', 'required', 'autocomplete'=>'off'])}}
{{--                {{Form::text('password', '', ['id'=>'password','placeholder'=>'Senha','class'=>'form-control','minlength'=>'3', 'maxlength'=>'20', 'required'])}}--}}
                <div class="invalid-feedback"></div>
            </div>
        </div>

    @endif


    <h6 class="text-uppercase mt-3">Dados Pessoais</h6>
    <hr class="hr-sm mb-2">
    <div class="form-row">

        <div class="form-group col-6">
            {!! Html::decode(Form::label('name', 'Nome', array('class' => 'col-form-label require'))) !!}
            {{Form::text('name', old('name',(isset($User) ? $User->name : "")), ['id'=>'name','placeholder'=>'Nome','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        @if(Route::current()->getName() != 'users.my.profile')
            <div class="form-group col-6">
                {!! Html::decode(Form::label('role_id', 'Tipo de Usuário', array('class' => 'col-form-label require'))) !!}
                {{Form::select('role_id', $Page->auxiliar['roles'], Request::get('role_id',(isset($User) ? $User->getRoleId() : "")), ['placeholder' => 'Escolha o Tipo de Usuário', 'class'=>'form-control select2_single', 'required'])}}
                <div class="invalid-feedback"></div>
            </div>
       @endif
    </div>

</div>


<footer class="card-footer text-right">
    <button class="btn btn-primary" type="submit">Salvar</button>
</footer>
