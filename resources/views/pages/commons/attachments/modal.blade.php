<div class="modal fade" id="itemAttachments">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-description" id="defaultModalLabel">Anexar</h4>
            </div>
            {!! Form::open(['route' => ['attachments.store'],
                            'files'=>true,
                            'method' => 'POST']) !!}
            {{Form::hidden('parent_id', $Data->id)}}
            {{Form::hidden('type', NULL)}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {!! Html::decode(Form::label('description', 'Descrição *', array('class' => 'control-label'))) !!}
                                {{Form::text('description', '', ['id'=>'description','class'=>'form-control','minlength'=>'3', 'maxlength'=>'100', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                {!! Html::decode(Form::label('link', 'Anexo *', array('class' => 'control-label'))) !!}
                                {{Form::file('link', ['class'=>'form-control','required'])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-link waves-effect" data-dismiss="modal">Fechar</a>
                <button type="submit" class="btn btn-success waves-effect">Enviar</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
