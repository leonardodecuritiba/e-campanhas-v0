<div class="modal fade show" id="modal-justification">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Justificativa</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            {{Form::open(array(
                'route' => ["expenses.send-to-approve", $Data->id],
                'method'=>'POST',
                'data-disable'=>'false'
            )
            )}}

            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {!! Html::decode(Form::label('justification', 'Descreva uma Justificativa', array('class' => 'col-form-label'))) !!}
                        {!! Form::textarea('justification', "", ['class'=>'form-control','rows' => 3, 'minlength'=>'3', 'maxlength'=>'500']) !!}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                    <button class="btn btn-label btn-primary"><label><i class="ti-check"></i></label> Salvar</button>
                </div>

            </div>

            {{Form::close()}}

        </div>
    </div>
</div>