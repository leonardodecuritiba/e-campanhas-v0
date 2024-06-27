<div class="modal fade show" id="modal-groups">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar Grupo</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                {{Form::open(array(
                    'route' => ['voter.group.attach'],
                    'method'=>'POST',
                    'data-disable'=>'false'
                    )
                )}}
                {{Form::hidden('voter_id', $voter_id)}}

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Html::decode(Form::label('group_id', 'Grupo', array('class' => 'col-form-label require'))) !!}
                            {{Form::select('group_id', [], "", ['placeholder' => 'Escolha o Grupo', 'class'=>'form-control select2_single', 'required'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                    <button class="btn btn-label btn-primary"><label><i class="ti-check"></i></label> Adicionar
                    </button>
                </div>

                {{Form::close()}}
            </div>

        </div>
    </div>
</div>
