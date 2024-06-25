@extends('layout.app')

@section('title', $Page->title)

@section('page_header-title',   $Page->title)

@section('page_content')
    <!-- Main container -->

    <div class="main-content">

        <div class="card">
            <h4 class="card-title"><strong>{{count($Page->response)}}</strong> {{$Page->names}}</h4>

            <div class="card-content">
                <div class="card-body">

                    <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cadastrado</th>
                            <th>Código</th>
                            <th>Descrição</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Cadastrado</th>
                            <th>Código</th>
                            <th>Descrição</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($Page->response as $sel)
                            <tr>
                                <td>{{$sel['id']}}</td>
                                <td data-order="{{$sel['created_at_time']}}">{{$sel['created_at']}}</td>
                                <td>{{$sel['name']}}</td>
                                <td>{{$sel['description']}}</td>
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


@endsection
