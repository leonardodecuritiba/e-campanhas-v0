@extends('layout.app')

@section('title', $Page->title)

@section('style_content')

@endsection

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.breadcrumb')

@endsection


@if(isset($Data))

@section('page_modals')


@endsection

@endif

@section('page_content')
    <!-- Main container -->
    <div class="main-content">

    @include('layout.inc.alerts')

    <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="card">
            @if(isset($Data))
                <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->getShortName()}}</strong></h4>
            @else
                <h4 class="card-title"><strong>Dados do {{$Page->name}}</strong></h4>
            @endif
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="informations-tab" data-toggle="tab" href="#informations" role="tab" aria-controls="informations" aria-selected="true">Informações</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="informations" role="tabpanel" aria-labelledby="informations-tab">

                        @if(isset($Data))
                        {{Form::model($Data,
                            array(
                                'route' => ['suppliers.update', $Data->id],
                                'method'=>'PATCH',
                                'data-provide'=> "validation",
                                'data-disable'=>'false'
                            )
                            )}}
                        @else
                            {{Form::open(array(
                                'route' => ['suppliers.store'],
                                'method'=>'POST',
                                'data-provide'=> "validation",
                                'data-disable'=>'false'
                            )
                            )}}
                        @endif
                        @include('pages.human_resources.suppliers.form.data')
                    {{Form::close()}}
                    </div>

                </div>
            </div>            
        </div>
    </div><!--/.main-content -->
@endsection


@section('script_content')

    @include('layout.inc.datatable.js')

    @include('layout.inc.sweetalert.js')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.validation.js')

    <!-- Jquery Maskmoney Plugin Js -->
    @include('layout.inc.maskmoney.js')

    <!-- Jquery InputMask Js -->
    @include('layout.inc.inputmask.js')

    <!-- Address Layout Js -->
    @include('layout.inc.address.js')

    <!-- Person Layout Js -->
    @include('layout.inc.person.js')

@endsection
