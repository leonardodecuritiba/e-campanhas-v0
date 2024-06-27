<script>
    app.ready(function () {

        $('input[name="death"]').change(function () {
            const $input_death_date = $(this).closest('div.card-body').find('input[name=death_date]');
            if ($(this).prop('checked')) {
                //HABILITAR E REQUIRED
                $($input_death_date).val("").attr("required", true).attr("disabled", false);
            } else {
                //DESABILITAR E NÃO REQUIRED
                $($input_death_date).val("").attr("required", false).attr("disabled", true);
            }
        });

    });
</script>