@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_header-nav')

    @include('layout.inc.defaultsubmenu',['entity'=>$Page->entity, 'removeds' => true])

@endsection

@section('style_content')

@endsection

@section('page_content')

    <div class="main-content">

        <div class="card">
            <h4 class="card-title"><strong>{{count($Page->response)}}</strong> {{$Page->names}}</h4>

            <div class="card-content">
                <div class="card-body">

                    <table class="table table-striped table-bordered table-sm table-responsive-sm" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Whatsapp</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Patrocinador</th>
                            <th>Cadastrador</th>
                            <th>Cadastrado</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Whatsapp</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Patrocinador</th>
                            <th>Cadastrador</th>
                            <th>Cadastrado</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($Page->response as $sel)
                            <tr>
                                <td data-order="{{$sel['id']}}">@include('layout.inc.buttons.show')</td>
                                <td data-order="{{$sel['name']}}">
                                    @if($sel['surname'] != null)
                                        <p class="lh-1">{{$sel['surname']}}</p>
                                        <small>{{$sel['name']}}</small>
                                    @else
                                        <p class="lh-3">{{$sel['name']}}</p>
                                    @endif
                                </td>
                                <td>{{$sel['whatsapp_formatted']}}</td>
                                <td>{{$sel['email']}}</td>
                                <td>{{$sel['cpf_formatted']}}</td>
                                <td data-order="{{$sel['sponsor_id']}}">{{$sel['sponsor_id']}}</td>
                                <td data-order="{{$sel['register_id']}}">{{$sel['register_id']}}</td>
                                <td data-order="{{$sel['created_at_time']}}">{{$sel['created_at']}}</td>
                                <td>
                                    @include('layout.inc.buttons.edit')
                                    @include('layout.inc.buttons.delete')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @include('layout.inc.loading')
        </div>


    </div><!--/.main-content -->

@endsection


@section('script_content')

    <!-- Sample data to populate jsGrid demo tables -->
    @include('layout.inc.datatable.js')

    @include('layout.inc.sweetalert.js')

@endsection
