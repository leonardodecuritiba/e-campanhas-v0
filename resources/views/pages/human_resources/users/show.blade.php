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

            <h4 class="card-title"><strong>#{{$User->id}} - {{$User->short_description}} ({{$User->role_name_formatted}})</strong></h4>

            <div class="card-body">

                <h6 class="text-uppercase mt-3">Dados de Acesso</h6>
                <hr class="hr-sm mb-2">

                <div class="form-row">
                    <label class="col-2 col-form-label">ID</label>
                    <div class="col-10">
                        <p class="form-control-plaintext">{{$User->id}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <p class="form-control-plaintext">{{$User->getEmail()}}</p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Dados Pessoais</h6>
                <hr class="hr-sm mb-2">

                <div class="form-row">
                    <label class="col-2 col-form-label">Nome</label>
                    <div class="col-10">
                        <p class="form-control-plaintext">{{$User->name}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Perfil</label>
                    <div class="col-10">
                        <p class="form-control-plaintext">{{$User->role_name_formatted}}</p>
                    </div>
                </div>
        </div>

        </div>

    </div><!--/.main-content -->

@endsection


@section('script_content')

    @include('layout.inc.inputmask.js')

@endsection
