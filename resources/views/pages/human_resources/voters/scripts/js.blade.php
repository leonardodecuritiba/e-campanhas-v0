<script>
    app.ready(function () {
        if(typeof _POOLING_PLACE_ !== 'undefined' && _POOLING_PLACE_ !== '' )
        {
            $('#polling_place').append(
                new Option(_POOLING_PLACE_, _POOLING_PLACE_, true, true)
            ).trigger('change');
        }
        $('#polling_place').select2({
            placeholder: 'Selecione..',
            ajax: {
                url: `{{route('polling_places.index')}}`,
                dataType: 'json',
                delay: 100,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return item;
                        })
                    };
                },
                cache: true
            }
        });

    });
</script>
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


<script>
    app.ready(function () {

        $('input[name="hasnt_birthday"]').change(function () {
            const $parent = $(this).closest('div.form-row');
            if ($(this).prop('checked')) {
                //HABILITAR E REQUIRED
                $($parent).find('div.birthday').hide();
                $('input[name=birthday]').attr("required", false);
                $($parent).find('div.years_approximate').show();
                $('input[name=years_approximate]').attr("required", true);
            } else {
                //DESABILITAR E NÃO REQUIRED
                $($parent).find('div.birthday').show();
                $('input[name=birthday]').attr("required", true);
                $($parent).find('div.years_approximate').hide();
                $('input[name=years_approximate]').attr("required", false);
            }
        });

    });
</script>