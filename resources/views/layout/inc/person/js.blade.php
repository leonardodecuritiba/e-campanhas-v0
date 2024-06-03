<script>
    function toggleType($this, val) {

        var $parent = $($this).closest('div.form-row');
        var $div_pf = $($parent).find('div.section-pf');
        var $div_pj = $($parent).find('div.section-pj');

        if (val == "0") {
            // $('input[name="type"]#pf').prop('checked', true);
            $($div_pj).hide();
            $($div_pj).find('input').attr('required', false);
            $($div_pf).fadeIn('fast');
            $($div_pf).find('input').attr('required', true);
//                $('section.section-pj').find('input').val("");
        } else {
            $($div_pf).hide();
            $($div_pf).find('input').attr('required', false);
            $($div_pj).fadeIn('fast');
            $($div_pj).find('input').attr('required', true);
        }
    }

    $(document).ready(function () {
        $('input[name="type"]').change(function () {
            toggleType($(this), $(this).val());
        });

        toggleType($('input[name="type"]'), '{{isset($Data) ? $Data->type : 1}}');
    });

    function toggleIe($this, val) {

        var $parent = $($this).closest('div.form-row');
        var $input_ie = $($parent).find('input[name=ie]');

        if (val == "0") {
            $($input_ie)
                .attr("required", true)
                .attr("disabled", false);
        } else {
            $($input_ie)
                .val("")
                .attr("required", false)
                .attr("disabled", true);
        }
    }

    $(document).ready(function () {
        $('input[name="exemption_ie"]').change(function () {
            toggleIe($(this), $(this).prop( "checked" ));
        });

        toggleIe($('input[name="exemption_ie"]'), '{{isset($Data) ? $Data->exemption_ie : 0}}');
    });

</script>