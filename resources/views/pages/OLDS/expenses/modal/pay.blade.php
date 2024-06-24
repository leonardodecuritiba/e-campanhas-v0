<div class="modal fade show" id="modal-pay">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dar Baixa</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            {{Form::open(array(
                'route' => ["expenses.pay", $Data->id],
                'method'=>'POST',
                'data-disable'=>'false'
            )
            )}}

            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-12">
                        {!! Html::decode(Form::label('paid_at', 'Data de Baixa', array('class' => 'col-form-label'))) !!}
                        {{Form::text('paid_at', date("d/m/Y"), ['placeholder'=>'Data de Baixa','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", 'required'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                    <button class="btn btn-label btn-primary"><label><i class="ti-check"></i></label> Salvar
                    </button>
                </div>

            </div>

            {{Form::close()}}
        </div>
    </div>
</div>