<script>
    function showDeleteAttachmentMessage($el) {
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
                    removeDataAttachmentByAjax($el);
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

    function removeDataAttachmentByAjax($el) {
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
                if (json.status) {
                    swal(
                        "",
                        "<b>" + json.message + "</b>",
                        "success"
                    )
                    $($el).closest("div.media").parent().remove();
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

    //Modal de anexos aos itens
    app.ready(function() {

        //Modal de anexos aos itens - Ao mostrar o Modal
        $('#itemAttachments').on('show.bs.modal', function (event) {
            console.log('div#itemAttachments>show.bs.modal');
            const $btn = event.relatedTarget;
            $(this).find('input[name=type]').val($($btn).data('type'));
        })

        //Modal de anexos aos itens - Ao esconder o Modal
        $('#itemAttachments').on('hide.bs.modal', function (event) {
            console.log('#itemAttachments>hide.bs.modal');
            $(this).find('input[name=type]').val(null);
        })
    });
</script>