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

            <h4 class="card-title"><strong>#{{$Data->id}} - {{$Data->name}}</strong></h4>

            <div class="card-body">

                <h6 class="text-uppercase mt-3">Identificação</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-2 col-form-label">Nome</label>
                    <div class="col-4">
                        <p class="form-control-plaintext">{{$Data->name}}</p>
                    </div>
                    <label class="col-2 col-form-label">Apelido</label>
                    <div class="col-4">
                        <p class="form-control-plaintext">{{$Data->surname}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">CPF</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Data->cpf_formatted}}</p>
                    </div>
                    @if($Data->birthday != null)
                        <label class="col-1 col-form-label">Data Nascimento</label>
                        <div class="col-2">
                            <p class="form-control-plaintext">{{$Data->birthday_formatted}}
                                @if(!$Data->death) - <span class="text-primary fw-500">{{$Data->years_from_birthday}} anos</span> @endif
                            </p>
                        </div>
                    @else
                        <label class="col-1 col-form-label">Idade Aproximada</label>
                        <div class="col-1">
                            <p class="form-control-plaintext">{{$Data->years_approximate}}</p>
                        </div>
                    @endif
                    @if($Data->death)
                        <label class="col-1 col-form-label">Data Óbito</label>
                        <div class="col-2">
                            <p class="form-control-plaintext">{{$Data->death_date_formatted}} - <span class="text-primary fw-500">{{$Data->years_from_death_formatted}}</span></p>
                        </div>
                    @endif
                </div>

                <h6 class="text-uppercase mt-3">Contato</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-2 col-form-label">Whatsapp</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Data->whatsapp_formatted}}</p>
                    </div>
                    <label class="col-2 col-form-label">Outros telefones</label>
                    <div class="col-6">
                        <p class="form-control-plaintext">{{$Data->other_phones}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Data->email}}</p>
                    </div>
                    <label class="col-2 col-form-label">Instagram</label>
                    <div class="col-6">
                        <p class="form-control-plaintext">{{$Data->instagram}}</p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Dados eleitorais</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-2 col-form-label">Tit. eleitor zona</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Data->voter_registration_zone}}</p>
                    </div>
                    <label class="col-2 col-form-label">Tit. eleitor seção</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Data->voter_registration_session}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Estimativa de votos</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Data->votes_estimate}}</p>
                    </div>
                    <label class="col-2 col-form-label">Grau de certeza</label>
                    <div class="col-2">
                        <p class="form-control-plaintext text-primary fw-500">{{$Data->votes_degree_certainty}}</p>
                    </div>
                    <label class="col-1 col-form-label">Cabo Eleitoral</label>
                    <div class="col-1">
                        <label class="switch">
                            <input type="checkbox" @if($Data->electoral_campaigner) checked @endif>
                            <span class="switch-indicator"></span>
                        </label>
                    </div>
                    <label class="col-1 col-form-label">Apoiador</label>
                    <div class="col-1">
                        <label class="switch">
                            <input type="checkbox" @if($Data->supporter) checked @endif>
                            <span class="switch-indicator"></span>
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Histórico Função Social</label>
                    <div class="col-10">
                        <p class="form-control-plaintext">{{$Data->social_history}}</p>
                    </div>
                </div>

            </div>

        </div>

    </div><!--/.main-content -->

@endsection


@section('script_content')

    @include('layout.inc.inputmask.js')

@endsection