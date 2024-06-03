<!-- Bootstrap Tags Input Plugin Js -->
{{--{{Html::script('bower_components/adminbsb-materialdesign/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}--}}

<script>

    class selectTagsInputAjax {
        el_tags;
        el_input;
        el_select_required;
        values;
        Select2;
        placeholder;
        url_ajax;
        constructor( configs ) {
            let {el_tags, el_input, el_select, el_select_required, values, placeholder, url_ajax} = configs;
            this.el_tags = el_tags; //ELEMENTO INPUT DO TIPO TAGS (A SER MOSTRADO NO LAYOUT)
            this.el_input = el_input; //ELEMENTO INPUT COM ARRAY A SER ENVIADO VIA FORMULÁRIO (SERÁ HIDDEN)
            this.el_select = el_select; //ELEMENTO SELECT QUE FARÁ ESCOLHA DOS VALORES A SEREM DEFINIDOS NO TAGSINPUT
            this.el_select_required = el_select_required; //ELEMENTO SELECT É OBRIGATÓRIO?
            this.values = JSON.parse(values); //ARRAY COM OS VALORES A SEREM PRÉ-PREENCHIDOS
            this.placeholder = placeholder; //ARRAY COM OS VALORES A SEREM PRÉ-PREENCHIDOS
            this.url_ajax = url_ajax; //ARRAY COM OS VALORES A SEREM PRÉ-PREENCHIDOS

            this.Select2 = new select2Ajax( {
                el_select:this.el_select,
                placeholder:this.placeholder,
                url:this.url_ajax,
                value:[]
            })

            this.array_values = [] //ARRAY COM VALORES A SEREM ARMAZENADOS PARA POSTERIOR POST
            this.array_values["id"] = [];
            this.array_values["text"] = [];


            //AO SELECIONAR O ITEM, POPULAR A LISTA DE TAGS INPUT
            $(this.el_select).on('select2:select', (e) => { this.selectItem( e ) });

            //AO REMOVER O ITEM, POPULAR A LISTA DE TAGS INPUT
            $(this.el_tags).on('beforeItemRemove', (e) => { this.unselectItem( e ) });
            $(this.el_tags).prev().find("input").prop("readonly", true);

            const $this = $(this.el_select)

            //ATUALIZAR LISTA DOS ITENS SELECIONADOS
            if(this.values.length > 0){
                $.ajax({
                    url: this.url_ajax,
                    data: {ids : this.values},
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
                    success: (json) => this.updateItem( json )
                });
            }
        }

        //FUNÇÃO PARA ATUALIZAÇÃO DOS ID
        updateInputId( ) {
            if(!jQuery.isEmptyObject(this.array_values["id"])){
                $( this.el_input ).val(JSON.stringify( this.array_values["id"] ));
            } else {
                $( this.el_input ).val("");
            }
            if(this.el_select_required){
                $(this.el_select).attr("required", (this.array_values["id"].length <= 0));
            }
        }

        //FUNÇÃO PARA SELECIONAR UM ITEM
        selectItem( e ) {
            const data = {
                id: e.params.data.id,
                text: e.params.data.text
            };
            if(data.id !== ""){

                //PROCURAR NO ARRAY DOS VALORES JÁ DEFINIDOS PARA SABER SE O ITEM JÁ EXISTE
                var pos = $.inArray(data.id, this.array_values["id"]);

                //SE NÃO EXISTIR, ADICIONE
                if(pos === -1){

                    //VERIFICAR SE A OPÇÃO TODAS, FOI SELECIONADA, SE SIM, REMOVER TODAS E ADICIONAR A NOVA OPÇÃO
                    if($.inArray("-1", this.array_values["id"]) === -1){
                        //ATUALIZAR O ELEMENTO TAGS INPUT
                        this.insertItem(data);
                    }

                }

                this.updateInputId();
                $(this.el_select).val("").trigger("change");
            }
        }

        //FUNÇÃO PARA LIMPAR LISTA
        clear(  ) {
            this.array_values["id"]=[];
            this.array_values["text"]=[];
            $(this.el_tags).tagsinput('removeAll');
        }

        //FUNÇÃO PARA SELECIONAR UM ITEM
        insertItem( data ) {
            this.array_values["id"].push(data.id);
            this.array_values["text"].push(data.text);
            $(this.el_tags).tagsinput('add', data );
            // $(this.el_tags).tagsinput('add', { id: 'tag id', label: 'tag lable' } );
        }

        //FUNÇÃO PARA DESELECIONAR UM ITEM
        unselectItem( e ) {
            var data = e.item;
            // Do some processing here
            var pos = $.inArray(data.id, this.array_values["id"]);
            if(pos !== -1){
                this.array_values["id"].splice(pos, 1);
                this.array_values["text"].splice(pos, 1);
                this.updateInputId();
            }
        }

        //FUNÇÃO PARA ATUALIZAR UM ITEM
        updateItem( json ) {
            $.each(json.data, (i, data) => {
                this.insertItem( data );
                this.updateInputId();
            })
        }

    }

</script>