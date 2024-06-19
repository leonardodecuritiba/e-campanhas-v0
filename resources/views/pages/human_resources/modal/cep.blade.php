<div class="modal fade show" id="modal-ceps">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pesquisar endereço por CEP</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Este recurso está indisponível no momento!
                </div>
{{--                {{Form::open(array(--}}
{{--                    'route' => ['voter.group.attach'],--}}
{{--                    'method'=>'POST',--}}
{{--                    'data-disable'=>'false'--}}
{{--                    )--}}
{{--                )}}--}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Html::decode(Form::label('checkzip', 'CEP', array('class' => 'col-form-label'))) !!}
                            {{Form::text('checkzip', '', ['class'=>'form-control show-cep', 'placeholder'=>'CEP', 'maxlength'=>'16'])}}
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                    <button class="btn btn-label btn-info"><label><i class="ti-search"></i></label> Buscar
                    </button>
                </div>

{{--                {{Form::close()}}--}}
            </div>

        </div>
    </div>
</div>
