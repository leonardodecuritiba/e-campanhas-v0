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

            <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->short_description}}</strong></h4>


            {{Form::model($Data,
                array(
                    'route' => ['groups.update', $Data->id],
                    'method'=>'PATCH',
                    'data-provide'=> "validation",
                    'data-disable'=>'false'
                )
                )}}
                @include('pages.human_resources.settings.groups.form.data')
            {{Form::close()}}

        </div>

    </div><!--/.main-content -->

@endsection

@section('script_content')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.validation.js')

@endsection
