@extends('layout.app')
@section('title', $Page->title)
@section('style_content')
@endsection

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.breadcrumb')

@endsection

@section('page_content')
    <!-- Main container -->
    <div class="main-content">

        @include('layout.inc.alerts')

        <div class="card">
            @if(isset($Role))
                <h4 class="card-title"><strong>#{{$Role->id}} - {{$Role->getShortName()}}</strong></h4>
            @else
                <h4 class="card-title"><strong>Dados do {{$Page->name}}</strong></h4>
            @endif
            <div class="card-body">
                {{Form::model($Role,
                    array(
                        'route' => ['roles.update', $Role->id],
                        'method'=>'PATCH',
                        'data-provide'=> "validation",
                        'data-disable'=>'false'
                    )
                    )}}            
                    <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Html::decode(Form::label('name', 'Nome', array('class' => 'col-form-label'))) !!}
                                {{Form::text('name', old('name',(isset($Role) ? $Role->name : "")), ['placeholder'=>'Descrição','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'disabled'])}}
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                {!! Html::decode(Form::label('permissions', 'Escolha as Permissões', array('class' => 'col-form-label'))) !!}
                                {{Form::select('permissions[]', $Page->auxiliar['permissions'], Request::get('permissions'), [ 'class'=>'form-control select2_single', 'multiple'=>"multiple"])}}
                                <div class="invalid-feedback"></div>
                            </div>

                        </div>
                    </div>

                    <footer class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </footer>

                {{Form::close()}}
            </div>
        </div>

    </div><!--/.main-content -->
@endsection


@section('script_content')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.validation.js')

@endsection
