
<!-- Scripts -->
<script>
    var $_DATATABLE_OPTIONS_ = {
        "responsive": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pageLength": 10,
        // "scrollX": true,
        "order": [0, "DESC"]
    };

</script>
{{Html::script('assets/js/core.min.js', ['data-provide' => 'sweetalert'])}}
{{Html::script('assets/js/app.js')}}
{{Html::script('assets/js/script.min.js')}}
<script>

    var $_LOADING_ = {};
    var $_TABLE_ = {};

    function loadingCard(type, $this){
        var $field = $($this).closest('.card-content').next();
        if (type == 'show') {
            $_LOADING_ = $($field).addClass('reveal');
        } else {
            $_LOADING_ = $($field).removeClass('reveal');
        }
    }
</script>

<!-- Select2 -->
@include('layout.inc.select2.js')

{{--{{Html::script('assets/vendor/bootstrap-validator/pt_BR.js')}}--}}
@yield('script_content')
