<script>
    $_INPUT_STATE_ = 'select#select-state';
    $_INPUT_CITY_ = 'select#select-city';

    app.ready(function () {

        $($_INPUT_STATE_).select2({
            placeholder: 'Escolha o Estado',
            minimumInputLength: 0,
            ajax: {
                url: `{{route('ceps.get.states')}}`,
                dataType: 'json',
                delay: 100,
                cache: true,
                processResults: function (json) {
                    return {
                        results: json.data
                    };
                },
            }
        });

        $($_INPUT_STATE_).change(function () {
            $($_INPUT_CITY_).empty();
            $($_INPUT_CITY_).append("<option value=''>Escolha a Cidade</option>");
            if ($($_INPUT_STATE_).val() == "") {
                return false;
            }

            $.ajax({
                url: '{{route('ceps.get.cities')}}',
                data: {state_id: $($_INPUT_STATE_).val()},
                type: 'GET',
                dataType: "json",
                beforeSend: function (xhr, textStatus) {
                    loadingCard('show', $_INPUT_STATE_);
                },
                error: function (xhr, textStatus) {
                    console.log('xhr-error: ' + xhr.responseText);
                    console.log('textStatus-error: ' + textStatus);
                    loadingCard('hide', $_INPUT_STATE_);
                },
                success: function (json) {
                    $(json.data).each(function (i, v) {
                        $($_INPUT_CITY_).append(
                            new Option(v.text, v.id, false, false)
                        );
                    });
                }
            });
        })

        if(typeof _STATE_ !== 'undefined' ){
            if (_STATE_.id !== '') {
                $($_INPUT_STATE_).append(
                    new Option(_STATE_.text, _STATE_.id, true, true)
                ).trigger('change');
            }

            if (_CITY_.id !== '') {
                $($_INPUT_CITY_).append(
                    new Option(_CITY_.text, _CITY_.id, true, true)
                ).trigger('change');
            }
        }
    });
</script>