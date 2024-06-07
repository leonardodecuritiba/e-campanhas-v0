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

    <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="card">
            <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->short_name}} ({{$Data->role_name}})</strong></h4>

            <div class="card-body">

                <h6 class="text-uppercase mt-3">Dados de Acesso</h6>
                <hr class="hr-sm mb-2">

                <div class="form-row">
                    <label class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{$Data->id}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{$Data->getEmail()}}</p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Dados Pessoais</h6>
                <hr class="hr-sm mb-2">

                <div class="form-row">
                    <label class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{$Data->name}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{$Data->role_name}}</p>
                    </div>
                </div>
        </div>


    </div><!--/.main-content -->
@endsection


@section('script_content')

    @include('layout.inc.inputmask.js')

@endsection
