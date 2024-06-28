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
                    <div class="col-12" data-provide="photoswipe">
                        <a href="#">
                            <img class="avatar avatar-xxxl avatar-bordered"
                                 data-original-src="{{$Voter->link_download}}"
                                 src="{{$Voter->link_download}}" alt="">
                        </a>
                    </div>
                @endif
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    @if($Voter->sponsor)
                        <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">Patrocinador</label>
                        <div class="col-xl-10 col-lg-10 col-md-10 col-8">
                            <p class="form-control-plaintext text-primary">{{$Voter->sponsor->name}}</p>
                        </div>
                    @endif
                    <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">Nome</label>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->name"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">Apelido</label>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->surname"/></p>
                    </div>
                </div>

                <div class="form-row">
                    <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">CPF</label>
                    <div class="col-xl-2 col-lg-4 col-md-6 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->cpf_formatted"/></p>
                    </div>
                    @if($Voter->birthday != null)
                        <label class="col-xl-2 col-lg-4 col-md-4 col-4 col-form-label">Data Nascimento</label>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-8">
                            <p class="form-control-plaintext">{{$Voter->birthday_formatted}}
                                @if(!$Voter->death) - <span class="text-primary fw-500">{{$Voter->years_from_birthday}} anos</span> @endif
                            </p>
                        </div>
                    @else
                        <label class="col-xl-2 col-lg-4 col-md-4 col-5 col-form-label">Idade Aproximada</label>
                        <div class="col-xl-6 col-lg-2 col-md-2 col-7">
                            <p class="form-control-plaintext">{{$Voter->years_approximate}}</p>
                        </div>
                    @endif
                    @if($Voter->death)
                        <label class="col-xl-2 col-lg-2 col-md-4 col-4 col-form-label">Data Óbito</label>
                        <div class="col-xl-6 col-lg-4 col-md-4 col-8">
                            <p class="form-control-plaintext">{{$Voter->death_date_formatted}} - <span class="text-primary fw-500">{{$Voter->years_from_death_formatted}}</span></p>
                        </div>
                    @endif
                </div>

                <h6 class="text-uppercase mt-3">Contato</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">Whatsapp</label>
                    <div class="col-xl-2 col-lg-10 col-md-4 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->whatsapp_formatted"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-3 col-md-2 col-4 col-form-label">Outros telefones</label>
                    <div class="col-xl-6 col-lg-9 col-md-2 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->other_phones"/></p>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">Email</label>
                    <div class="col-xl-2 col-lg-10 col-md-4 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->email"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-2 col-md-2 col-4 col-form-label">Instagram</label>
                    <div class="col-xl-6 col-lg-10 col-md-2 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->instagram"/></p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Dados eleitorais</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-xl-2 col-lg-3 col-md-3 col-12 col-form-label">Local de Votação</label>
                    <div class="col-xl-4 col-lg-9 col-md-6 col-12 ">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->polling_place"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-3 col-md-2 col-5 col-form-label">Nº Zona Eleitoral</label>
                    <div class="col-xl-1 col-lg-2 col-md-2 col-7">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->voter_registration_zone"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-3 col-md-2 col-5 col-form-label">Nº Seção Eleitoral</label>
                    <div class="col-xl-1 col-lg-4 col-md-2 col-7">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->voter_registration_session"/></p>
                    </div>

                    <label class="col-xl-2 col-lg-4 col-md-2 col-12 col-form-label">Regiões da cidade que tem influência</label>
                    <div class="col-xl-10 col-lg-8 col-md-2 col-12">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->location_of_operation"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-4 col-md-2 col-6 col-form-label">Potencial de votos do eleitor</label>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-6">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->votes_estimate"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-4 col-md-2 col-6 col-form-label">Grau de certeza</label>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-6">
                        <p class="form-control-plaintext text-primary fw-500"><x-info-show :info="$Voter->votes_degree_certainty"/></p>
                    </div>
                </div>

                @role('registrar')
                    <div class="form-row">
                        <label class="col-xl-2 col-lg-3 col-md-2 col-12 col-form-label">Observações gerais do Cabo Eleitoral</label>
                        <div class="col-xl-10 col-lg-9 col-md-10 col-12">
                            <p class="form-control-plaintext"><x-info-show :info="$Voter->registrar_observations"/></p>
                        </div>
                    </div>
                @else
                    <div class="form-row">
                        <label class="col-xl-2 col-lg-3 col-md-2 col-12 col-form-label">Observações gerais da Coordenação</label>
                        <div class="col-xl-10 col-lg-9 col-md-10 col-12">
                            <p class="form-control-plaintext"><x-info-show :info="$Voter->admin_observations"/></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="col-xl-2 col-lg-3 col-md-2 col-12 col-form-label">Observações gerais do Cabo Eleitoral</label>
                        <div class="col-xl-10 col-lg-9 col-md-10 col-12">
                            <p class="form-control-plaintext"><x-info-show :info="$Voter->registrar_observations"/></p>
                        </div>
                    </div>
                @endrole
                <div class="form-row">
                    <label class="col-xl-2 col-lg-3 col-md-2 col-12 col-form-label">Histórico Função Social</label>
                    <div class="col-xl-10 col-lg-9 col-md-10 col-12">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->social_history"/></p>
                    </div>
                </div>

                <h6 class="text-uppercase mt-3">Endereço</h6>
                <hr class="hr-sm mb-2">
                <div class="form-row">
                    <label class="col-xl-1 col-lg-2 col-md-3 col-4 col-form-label">Logradouro</label>
                    <div class="col-xl-3 col-lg-5 col-md-4 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->address->full_street"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-2 col-md-3 col-4 col-form-label">Complemento</label>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-8">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->address->complement"/></p>
                    </div>
                    <label class="col-xl-1 col-lg-2 col-md-3 col-2 col-form-label">Bairro</label>
                    <div class="col-xl-3 col-lg-5 col-md-3 col-10">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->address->district"/></p>
                    </div>
                    <label class="col-xl-1 col-lg-2 col-md-3 col-2 col-form-label">CEP</label>
                    <div class="col-xl-1 col-lg-2 col-md-3 col-10">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->address->zip_formatted"/></p>
                    </div>
                    <label class="col-xl-1 col-lg-2 col-md-3 col-3 col-form-label">Cidade/UF</label>
                    <div class="col-xl-4 col-lg-4 col-md-5 col-9">
                        <p class="form-control-plaintext"><x-info-show :info="$Voter->address->city_uf"/></p>
                    </div>
                    <label class="col-xl-2 col-lg-3 col-md-3 col-4 col-form-label">Geolocalização</label>
                    <div class="col-xl-2 col-lg-3 col-md-2 col-8">
                        <p class="form-control-plaintext"><small><x-info-show :info="$Voter->address->geolocalization"/></small></p>
                    </div>
                </div>
            </div>

        </div>

    </div><!--/.main-content -->

@endsection


@section('script_content')

    @include('layout.inc.inputmask.js')

@endsection
