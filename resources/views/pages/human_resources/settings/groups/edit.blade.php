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

            <h4 class="card-title"><strong>#{{$Group->id}} - {{$Group->short_description}}</strong></h4>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="informations-tab" data-toggle="tab" href="#informations" role="tab" aria-controls="informations" aria-selected="true">Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="voters-tab" data-toggle="tab" href="#voters" role="tab" aria-controls="voters" aria-selected="true">Eleitores
                            @if($Group->voters->count() > 0)<span class="badge badge-pill badge-info">{{$Group->voters->count()}}</span> @endif
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="informations" role="tabpanel" aria-labelledby="informations-tab">
                        {{Form::model($Group,
                            array(
                                'route' => ['groups.update', $Group->id],
                                'method'=>'PATCH',
                                'data-provide'=> "validation",
                                'data-disable'=>'false'
                            )
                            )}}
                        @include('pages.human_resources.settings.groups.form.data')
                        {{Form::close()}}
                    </div>

                    <div class="tab-pane fade" id="voters" role="tabpanel" aria-labelledby="voters-tab">
                        <div class="card">
                            <div class="card-content">
                                <table class="table table-striped table-bordered table-responsive-sm" data-provide="datatables">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Adicionado em</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Email</th>
                                        <th>Whatsapp</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Adicionado em</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Email</th>
                                        <th>Whatsapp</th>
                                        <th>Ações</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($Group->voters as $voter)
                                        <tr>
                                            <td><a href="{{route('voters.show',$voter->id)}}" target="_blank">{{$voter->id}}</a></td>
                                            <td data-order="{{$voter->pivot->created_at_time_formatted}}">{{$voter->pivot->created_at_formatted}}</td>
                                            <td>{{$voter->name}}</td>
                                            <td>{{$voter->cpf_formatted}}</td>
                                            <td>{{$voter->email}}</td>
                                            <td>{{$voter->whatsapp_formatted}}</td>
                                            <td>
                                                @include('layout.inc.buttons.delete',
                                                    [
                                                        'sel'=>$voter,
                                                        'field_delete_route'=>route('voter.group.detach',['voter_id'=>$voter->id,'group_id'=>$Group->id]),
                                                        'field_delete'      => 'Eleitor'
                                                    ]
                                                )
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div><!--/.main-content -->

@endsection

@section('script_content')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.validation.js')

    @include('layout.inc.datatable.js')

    @include('layout.inc.sweetalert.js')

@endsection
