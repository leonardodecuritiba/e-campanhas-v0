
<!-- Select2 -->
{{Html::script('bower_components/select2/dist/js/select2.js')}}
{{Html::script('bower_components/select2/dist/js/i18n/pt-BR.js')}}
<script>
    $.fn.select2.defaults.set('language', 'pt-BR');
    app.ready(function() {
        $(".select2_single").select2({
            width: 'resolve'
        });
    });

    class select2Ajax {
        el_select;
        url;
        placeholder;
        constructor( configs ) {

            let {el_select, url, placeholder, value} = configs;
            this.el_select = el_select; //ELEMENTO SELECT QUE FARÁ ESCOLHA DOS VALORES A SEREM DEFINIDOS NO TAGSINPUT
            this.placeholder = placeholder; //ELEMENTO SELECT QUE FARÁ ESCOLHA DOS VALORES A SEREM DEFINIDOS NO TAGSINPUT
            this.url = url; //ELEMENTO SELECT É OBRIGATÓRIO?
            this.value = value; //VALORES

            $(this.el_select).select2({
                placeholder: this.placeholder,
                minimumInputLength: 2,
                ajax: {
                    delay: 250,
                    url: this.url,
                    data: function (params) {
                        return {
                            query: params.term
                        }
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.data
                        };
                    }
                },
                templateSelection: function(container) {
                    if(container.table !== undefined){
                        $(container.element).attr("data-table", container.table);
                    }
                    return container.text;
                }
            });

            const $this = $(this.el_select)

            //ATUALIZAR LISTA DOS ITENS SELECIONADOS
            if(this.value.length > 0){
                $.ajax({
                    url: this.url,
                    data: {ids : this.value},
                    type: 'GET',
                    dataType: "json",
                    beforeSend: function (xhr, textStatus) {
                        loadingCard('show', $this);
                    },
                    error: function (xhr, textStatus) {
                        console.log('xhr-error: ' + xhr.responseText);
                        console.log('textStatus-error: ' + textStatus);
                        loadingCard('hide', $this);
                    },
                    complete(){
                        loadingCard('hide',$this);
                    },
                    success: (json) => this.selectItem( json )
                });
            }

        }
        selectItem( json ){
            $.each(json.data, (i, data) => {
                const newOption = new Option(data.text, data.id, true, true);
                $(this.el_select).append(newOption).trigger('change');
            })

        }


    }
</script>
