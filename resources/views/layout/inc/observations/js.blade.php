<script>

    function showDeleteObservationMessage($el) {
        swal({
            title: "Você tem certeza?",
            text: "Esta ação será irreversível!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim! ",
            cancelButtonText: "Não, cancelar! "
        }).then(
            function (isConfirm) {
                if (typeof isConfirm.dismiss == 'undefined') {
                    removeDataObservationByAjax($el);
                } else {
                    swal(
                        "Cancelado",
                        "Nenhuma alteração realizada!",
                        "error"
                    )
                }
            }
        );
    }

    function removeDataObservationByAjax($el) {
        $.ajax({
            url: $($el).data('href'),
            type: 'post',
            data: {"_method": 'delete', "_token": "<?php echo e(csrf_token()); ?>"},
            dataType: "json",

            beforeSend: function () {
                loadingCard('show', $el);
            },
            complete: function (xhr, textStatus) {
                loadingCard('hide', $el);
            },
            error: function (xhr, textStatus) {
                loadingCard('hide', $el);
                console.log('xhr-error: ' + xhr);
                console.log('textStatus-error: ' + textStatus);
            },
            success: function (json) {
                console.log(json);
                if (json.status) {
                    swal(
                        "",
                        "<b>" + json.message + "</b>",
                        "success"
                    )
                    let $body = $($el).closest("div.body");
                    $($el).closest("blockquote").remove();
                    if($($body).find("blockquote").length == 0){
                        $($body).html("<i>Sem observações</i>")
                    }
                } else {
                    swal(
                        "",
                        "<b>Erro!</b> Nenhuma alteração realizada",
                        "error"
                    )
                }
            }
        });
    }

    $(document).ready(function () {

        $('#addObservations form').on('submit', function (e) {
            e.preventDefault();
            let $form = this;
            if($($form).valid()){
                $.ajax({
                    url: $($form).attr('action'),
                    data: $($form).serialize(),
                    type: 'POST',
                    beforeSend: function (xhr, textStatus) {
                        loadingCard('show',$form);
                    },
                    error: function (xhr, textStatus) {
                        console.log('xhr-error: ' + xhr.responseText);
                        console.log('textStatus-error: ' + textStatus);
                        loadingCard('hide',$form);
                    },
                    success: function (data) {
                        loadingCard('hide',$form);
                        $('div#observations div.observations-list').html(data)
                        $('#addObservations').modal("hide")
                        swal(
                            "",
                            "Observação adicionada com sucesso!",
                            "success"
                        )
                    }
                });
                return true;
            }

        })

        $('#addObservations').on('hide.bs.modal', function () {
            $(this).find('textarea[name=descriptions]').val("");
        })

    });
</script>