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
            <h4 class="card-title"><strong>{{count($Page->response)}}</strong> {{$Page->names}}</h4>

            <div class="card-content">
                <div class="card-body">

                    <table class="table table-striped table-bordered table-sm table-responsive-sm" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Eleitores</th>
{{--                            <th>Clientes</th>--}}
                            <th>Cadastrador</th>
                            <th>Cadastrado</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Eleitores</th>
{{--                            <th>Clientes</th>--}}
                            <th>Cadastrador</th>
                            <th>Cadastrado</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($Page->response as $sel)
                            <tr>
                                <td data-order="{{$sel['id']}}">@include('layout.inc.buttons.show')</td>
                                <td>{{$sel['description']}}</td>
                                <td>{{$sel['count_voters']}}</td>
{{--                                <td>{{$sel['n_clients']}}</td>--}}
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
