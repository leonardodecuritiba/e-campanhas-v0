<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'Audite') }} - @yield('title')</title>

    @include('layout.inc.head')

</head>

<body>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
    </div>
</div>

@include('layout.sidebar')
@include('layout.topbar')

<main class="main-container">

    @include('layout.inc.modal.change-password')

    @yield('page_modals')

    @if($Page->has_menu)

        <header class="header bg-ui-general">

            <div class="header-info">
                <h1 class="header-title">
                    <strong>@yield('page_header-title')</strong>
                </h1>
                <div class="pull-right">
                    @if($Page->create_option)
                        <button onclick="window.location.href='{{route($Page->entity.'.create')}}'" class="btn btn-outline btn-purple ">
                            {{trans('pages.view.CREATE', [ 'name' => $Page->name ])}}
                        </button>
                    @endif
                    @if(isset($Page->import_option) && $Page->import_option)
                        <button onclick="window.location.href='{{route($Page->entity.'.import')}}'" class="btn btn-outline btn-brown ">
                            {{trans('pages.view.IMPORT', [ 'name' => $Page->names ])}}
                        </button>
                    @endif
                        @if(isset($Page->import_xml_option) && $Page->import_xml_option)
                        <button onclick="window.location.href='{{route($Page->entity.'.import-xml')}}'" class="btn btn-outline btn-info">
                            {{trans('pages.view.IMPORT', [ 'name' => "XML Manifesto" ])}}
                        </button>
                    @endif
                </div>

            </div>

            <div class="header-action">
                <nav class="nav">
                    @yield('page_header-nav')
                </nav>
            </div>

            <div class="header-action">
                <nav class="nav">
                    @yield('page_header-nav2')
                </nav>
            </div>
        </header><!--/.header -->

    @endif


    @yield('page_content')

    @include('layout.inc.footer')

</main>

<!-- Global quickview -->
<div id="qv-global" class="quickview" data-url="../assets/data/quickview-global.html">
    <div class="spinner-linear">
        <div class="line"></div>
    </div>
</div>
<!-- END Global quickview -->

@include('layout.inc.foot')

@if(strpos(Route::currentRouteName(), "show") !== false)
    <script>
        app.ready(function() {
            $('input, button, select, textarea').attr("disabled",true);
        });
    </script>
@endif

</body>
</html>
