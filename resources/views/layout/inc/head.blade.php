<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

<!-- Bootstrap Core Css -->
{{Html::style('assets/css/core.min.css')}}

<!-- Waves Effect Css -->
{{Html::style('assets/css/app.min.css')}}

<!-- Animation Css -->
{{Html::style('assets/css/style.min.css')}}

<!-- Favicons -->
<link rel="apple-touch-icon" href="{{asset('assets/img/apple-touch-icon.png')}}">
<link rel="icon" href="{{asset('icon.png')}}">

<style>
    .material-icons {
        font-size: 20px !important;
    }
    .hidex {
        display: none !important;
    }
    .help-block {
        color: #ff0000;
    }
    .btn-a {
        color: white !important;
    }
    .header-info {
        margin: 10px 0 !important;
        padding: 0 30px !important;;
    }
    .header {
        margin-bottom: 0 !important;
    }
    h1.header-title {
        margin-bottom: 0 !important;
    }
    .header-action .nav-link {
        padding: 0rem 1rem 0rem;
    }

    .badge a {
        color: #ffffff ;
    }
    .badge a:hover {
        color: #4d5259 !important;
    }
    .form-control {
        border-color: #cacaca !important;
    }
    .select2-container .select2-selection--single {
        border-color: #cacaca !important;
    }
    .noUi-handle {
        background-color:#e4e7ea !important;
        border-color: #cacaca !important;
    }
    .noUi-horizontal {
        background: #e4e7ea !important;
    }
    label.require::after, label.required::after {
        content: '* Obrigatório' !important;
        font-size: 11px !important;
    }
</style>
<!-- Select2 -->
@include('layout.inc.select2.css')

<!--WaitMe Css-->
@yield('style_content')
