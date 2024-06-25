<div class="modal fade show" id="modal-recurrency">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gerar Recorrência</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            {{Form::open(array(
                'route' => ["expenses.recurrency", $Data->id],
                'method'=>'POST',
                'data-disable'=>'false'
            )
            )}}

            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-12">
                        {!! Html::decode(Form::label('recurrency_reference', 'Mês Referência', array('class' => 'col-form-label'))) !!}
                        {{Form::text('recurrency_reference', (isset($Data) ? $Data->reference_formatted : ""), ['class'=>'form-control show-date-month-year','data-provide'=>"datepicker",'data-date-format'=>"mm/yyyy",'data-min-view-mode'=>"months",'data-start-view'=>"months",'data-language'=>"pt-BR", 'required'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        {!! Html::decode(Form::label('due_first', 'Data Primeiro Vencimento', array('class' => 'col-form-label'))) !!}
                        {{Form::text('due_first',date("d/m/Y"), ['placeholder'=>'Data Primeiro Vencimento','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", 'required'])}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        {!! Html::decode(Form::label('quantity', 'Quantidade', array('class' => 'col-form-label'))) !!}
                        {{Form::text('quantity', 1, ['class'=>'form-control show-only-numbers', 'required'])}}
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