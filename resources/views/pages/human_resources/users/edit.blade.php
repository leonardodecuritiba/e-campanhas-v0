@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.defaultsubmenu',['entity'=>$Page->entity, 'removeds' => true])

@endsection

@section('page_modals')

    <div class="modal modal-fill" id="changePasswordUser" tabindex="-1" role="dialog" aria-labelledby="changePassword"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePassword">Alterar Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{Form::open(
                array(
                    'route' => 'users.change.password',
                    'method'=>'POST',
                    'class'=>'form-horizontal'
                )
                )}}
                <div class="modal-body">
                    {{Form::hidden('id', $Data->id)}}
                    {{--<div class="text-right">--}}
                    {{--<img src="{{asset('assets/images/logo/logo.png')}}"--}}
                    {{--alt="logo icon">--}}
                    {{--</div>--}}
                    <div class="form-group{{ $errors->has('user_password') ? ' has-error' : '' }}">
                        {!! Html::decode(Form::label('user_password', 'Nova Senha *', array('class' => 'col-md-4 control-label'))) !!}
                        <div class="col-md-12">
                            {{Form::password('user_password', ['class'=>'form-control','minlength'=>'6', 'required'])}}
                            @if ($errors->has('user_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('user_password_confirmation') ? ' has-error' : '' }}">
                        {!! Html::decode(Form::label('user_password_confirmation', 'Confirmar Senha *', array('class' => 'col-md-4 control-label'))) !!}
                        <div class="col-md-12">
                            {{Form::password('user_password_confirmation', ['class'=>'form-control','minlength'=>'6', 'required'])}}
                            @if ($errors->has('user_password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection

@section('page_content')

    <!-- Main container -->
    <div class="main-content">

    @include('layout.inc.alerts')

        <div class="card">

            <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->short_description}} ({{$Data->role_name}})</strong></h4>

            {{Form::model($Data,
            array(
                'route' => ['users.update', $Data->id],
                'method'=>'PATCH',
                'data-provide'=> "validation",
                'data-disable'=>'false'
            )
            )}}
                @include('pages.human_resources.users.form.data')
            {{Form::close()}}
        </div>


    </div><!--/.main-content -->
@endsection


@section('script_content')

    @include('layout.inc.inputmask.js')

@endsection
