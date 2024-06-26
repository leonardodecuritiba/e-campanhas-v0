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

            <h4 class="card-title"><strong>#{{$Voter->id}} - {{$Voter->name}}</strong></h4>

            <div class="card-body">
                <h6 class="text-uppercase mt-3">Identificação</h6>
                @if($Voter->image)
                    <div class="col-2" data-provide="photoswipe">
                        <a href="#">
                            <img style="max-width: 240px;" class="img-fluid" data-original-src="{{$Voter->link_download}}" src="{{$Voter->link_download}}" alt="">
                        </a>
                    </div>
                @endif
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    @if($Voter->sponsor)
                        <label class="col-2 col-form-label">Patrocinador</label>
                        <div class="col-10">
                            <p class="form-control-plaintext text-primary">{{$Voter->sponsor->name}}</p>
                        </div>
                    @endif
                    <label class="col-2 col-form-label">Nome</label>
                    <div class="col-4">
                        <p class="form-control-plaintext">{{$Voter->name}}</p>
                    </div>
                    <label class="col-2 col-form-label">Apelido</label>
                    <div class="col-4">
                        <p class="form-control-plaintext">{{$Voter->surname}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">CPF</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->cpf_formatted}}</p>
                    </div>
                    @if($Voter->birthday != null)
                        <label class="col-1 col-form-label">Data Nascimento</label>
                        <div class="col-2">
                            <p class="form-control-plaintext">{{$Voter->birthday_formatted}}
                                @if(!$Voter->death) - <span class="text-primary fw-500">{{$Voter->years_from_birthday}} anos</span> @endif
                            </p>
                        </div>
                    @else
                        <label class="col-1 col-form-label">Idade Aproximada</label>
                        <div class="col-1">
                            <p class="form-control-plaintext">{{$Voter->years_approximate}}</p>
                        </div>
                    @endif
                    @if($Voter->death)
                        <label class="col-1 col-form-label">Data Óbito</label>
                        <div class="col-2">
                            <p class="form-control-plaintext">{{$Voter->death_date_formatted}} - <span class="text-primary fw-500">{{$Voter->years_from_death_formatted}}</span></p>
                        </div>
                    @endif
                </div>

                <h6 class="text-uppercase mt-3">Contato</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-2 col-form-label">Whatsapp</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->whatsapp_formatted}}</p>
                    </div>
                    <label class="col-2 col-form-label">Outros telefones</label>
                    <div class="col-6">
                        <p class="form-control-plaintext">{{$Voter->other_phones}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->email}}</p>
                    </div>
                    <label class="col-2 col-form-label">Instagram</label>
                    <div class="col-6">
                        <p class="form-control-plaintext">{{$Voter->instagram}}</p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Dados eleitorais</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-1 col-form-label">nº Zona Eleitoral</label>
                    <div class="col-1">
                        <p class="form-control-plaintext">{{$Voter->voter_registration_zone}}</p>
                    </div>
                    <label class="col-1 col-form-label">nº Seção Eleitoral</label>
                    <div class="col-1">
                        <p class="form-control-plaintext">{{$Voter->voter_registration_session}}</p>
                    </div>
                    <label class="col-2 col-form-label">Regiões da cidade que tem influência</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->location_of_operation}}</p>
                    </div>
                    <label class="col-2 col-form-label">Grau de certeza</label>
                    <div class="col-2">
                        <p class="form-control-plaintext text-primary fw-500">{{$Voter->votes_degree_certainty}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Potencial de votos do eleitor</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->votes_estimate}}</p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-2 col-form-label">Histórico Função Social</label>
                    <div class="col-10">
                        <p class="form-control-plaintext">{{$Voter->social_history}}</p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Endereço</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-1 col-form-label">Logradouro</label>
                    <div class="col-4">
                        <p class="form-control-plaintext">{{$Voter->address->full_street}}</p>
                    </div>
                    <label class="col-1 col-form-label">Complemento</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->address->complement}}</p>
                    </div>
                    <label class="col-1 col-form-label">Bairro</label>
                    <div class="col-3">
                        <p class="form-control-plaintext">{{$Voter->address->district}}</p>
                    </div>
                    <label class="col-1 col-form-label">CEP</label>
                    <div class="col-1">
                        <p class="form-control-plaintext">{{$Voter->address->zip_formatted}}</p>
                    </div>
                    <label class="col-1 col-form-label">Cidade/UF</label>
                    <div class="col-5">
                        <p class="form-control-plaintext">{{$Voter->address->city_uf}}</p>
                    </div>
                    <label class="col-1 col-form-label">Geolocalização</label>
                    <div class="col-2">
                        <p class="form-control-plaintext">{{$Voter->address->geolocalization}}</p>
                    </div>
                </div>
            </div>

        </div>

    </div><!--/.main-content -->

@endsection


@section('script_content')

    @include('layout.inc.inputmask.js')

@endsection
