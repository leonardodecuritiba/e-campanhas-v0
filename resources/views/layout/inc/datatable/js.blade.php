<script>

    function checkRows( $this) {
        var rows = $($this).parents('.tab-pane, .card').find('table tr.selected');
        if (rows.length == 0) {
            swal(
                "Cancelado",
                "Você precisa selecionar um ou mais itens para continuar!",
                "error"
            )
            return false;
        }
        return rows;
    }

    function removeManyItens( $this, $url ) {
        var rows = checkRows($this);
        if(rows == false ){
            return false;
        }
        var $el = rows.first();

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
                    var ids = rows.map(function() {
                        return $(this).data("id");
                    }).get().join();
                    console.log(ids)
                    $.ajax({
                        url: $url,
                        type: 'post',
                        data: {"_method": 'delete', "_token": "{{ csrf_token() }}", "ids": "[" + ids + "]"},
                        dataType: "json",

                        beforeSend: function () {
                            loadingCard('show',$el);
                        },
                        error: function (xhr, textStatus) {
                            loadingCard('hide', $el);
                            console.log('xhr-error: ' + xhr);
                            console.log('textStatus-error: ' + textStatus);
                        },
                        success: function (json) {
                            loadingCard('hide', $el);
                            if(json){
                                swal(
                                    "",
                                    "<b>" + json.message + "</b>",
                                    "success"
                                )
                                var $_table_ = $($el).parents('table').DataTable();
                                $_table_
                                    .rows(rows)
                                    .remove()
                                    .draw();
                            } else {
                                swal(
                                    "",
                                    "<b>Erro!</b> Nenhuma alteração realizada",
                                    "error"
                                )
                            }
                        }
                    });
                } else {
                    swal(
                        "Cancelado",
                        "Nenhuma alteração realizada!",
                        //                    "<i class='em em-heart_eyes'></i>",
                        //                    "Ufa, <b>" + entity + "</b> está a salvo :)",
                        "error"
                    )
                }
            }
        );

        // $(anSelected).remove();
    }
</script>

{!! Html::script('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js') !!}
{!! Html::script('https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js') !!}