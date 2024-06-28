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

            <h4 class="card-title"><strong>Dados do {{$Page->name}}</strong></h4>

            <div class="card-body">

                {{Form::open(array(
                    'route' => ['voters.store'],
                    'method'=>'POST',
                    'files'=>'true',
                    'data-provide'=> "validation",
                    'data-disable'=>'false'
                )
                )}}

                    @include('pages.human_resources.voters.form.data')

                    <footer class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </footer>

                {{Form::close()}}

            </div>

        </div>

    </div><!--/.main-content -->

@endsection

@section('script_content')

    <!-- Jquery Validation Plugin Js -->
    @include('layout.inc.inputmask.js')

    @include('pages.human_resources.voters.scripts.js')

    <script>
        const _STATE_ = {
            id: "24",
            text: "Santa Catarina"
        };
        const _CITY_ = {
            id: "835",
            text: "Balneário Camboriú"
        };
    </script>

    @include('layout.inc.address.js')

@endsection