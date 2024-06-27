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
                'route' => ['users.store'],
                'method'=>'POST',
                'data-provide'=> "validation",
                'data-disable'=>'false',
                'autocomplete'=>'off'
            )
            )}}
                @include('pages.human_resources.users.form.data')
            {{Form::close()}}
        </div>

    </div><!--/.main-content -->

@endsection

@section('script_content')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.inputmask.js')

@endsection
