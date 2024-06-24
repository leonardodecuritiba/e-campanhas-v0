
<div class="modal fade show " id="addObservations">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar Observação</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => ['ajax.commons.observations.store'],
                            'method' => 'POST']) !!}
            {{Form::hidden('type', $type)}}
            {{Form::hidden('parent_id', $Data->id)}}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {!! Html::decode(Form::label('descriptions', 'Descrição *', array('class' => 'col-form-label'))) !!}
                            {{Form::textarea('descriptions', '', ['class'=>'form-control','rows'=>5,'minlength'=>'3', 'maxlength'=>'500', 'required'])}}
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