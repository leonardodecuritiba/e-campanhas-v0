
<!-- Bootstrap Select Css -->
{{Html::style('bower_components/select2/dist/css/select2.css')}}
<style>
    span.select2-container{
        width: 100% !important;
    }

    select.form-control:not([size]):not([multiple]) {
        height: 36px;
    }
    .select2-container .select2-selection--single {
        border-color: #ebebeb;
        height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #8b95a5;
        padding-left: 15px;
        line-height: 36px;
    }

    .select2-selection__arrow {

        color: #ebebeb;
        margin-top: 4px;
    }

     .select2-selection__choice {
         background-color: #465161!important;
         border: 0 !important;

         color: white !important;
         height: 24px !important;

         line-height: 24px !important;
         border-radius: 12px !important;
         padding: 0 0.75rem !important;
         font-size: 0.875rem !important;
     }
    .select2-selection__choice__remove {
        margin-right: 8px !important;
        cursor: pointer  !important;;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: white !important;
    }
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: 1px solid #ced4da !important;
    }

</style>
