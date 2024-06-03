<div class="card-body">

    @if(isset($Data))
        <div class="form-row">
            <div class="col-2">
                <h6>Data Lançamento</h6>
                <p>{{$Data->created_at_formatted}}</p>
            </div>
            <div class="col-2">
                <h6>Autor</h6>
                <p>{{$Data->owner->getName()}}</p>
            </div>
            @if(!$Data->isMain())
                <div class="col-2">
                    <h6>Despesa Principal</h6>
                    <b class="text-black-50"><a href="{{route("expenses.edit",$Data->parent_id)}}" target="_blank">{{$Data->parent->getName()}}</a></b>
                </div>
            @endif
            @if($Data->approver_id != NULL)
                <div class="col-2">
                    <h6>Aprovador</h6>
                    <p>{{$Data->approver->getName()}}</p>
                </div>
            @endif
            <div class="col-2">
                <h6>Data de Baixa</h6>
                <b class="text-{{$Data->paid_at_array['color']}}">{{$Data->paid_at_array['text']}}</b>
            </div>
        </div>
    @endif
    <div class="form-row">

        <div class="form-group col-2">
            {!! Html::decode(Form::label('supplier_type', 'Tipo Fornecedor', array('class' => 'col-form-label'))) !!}
            <div class="form-group">
                <input type="checkbox" data-provide="switchery" name="supplier_type" data-size="small"> Transportador
            </div>
        </div>
        <div class="form-group col-5">
            {!! Html::decode(Form::label('supplier_id', 'Fornecedor', array('class' => 'col-form-label'))) !!}
            {{Form::select('supplier_id',[], old('supplier_id', Request::get('supplier_id')), [ 'class'=>'form-control select2_single', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-5">
            {!! Html::decode(Form::label('conveyor_id', 'Transportador', array('class' => 'col-form-label'))) !!}
            {{Form::select('conveyor_id',[], old('conveyor_id', Request::get('conveyor_id')), [ 'class'=>'form-control select2_single', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-5">
            {!! Html::decode(Form::label('expense_type_id', 'Tipo de Despesa', array('class' => 'col-form-label'))) !!}
            {{Form::select('expense_type_id', $Page->auxiliar['expense_types'], isset($Data) ? $Data->expense_type_id : old('expense_type_id', Request::get('expense_type_id')), ['placeholder' => 'Tipo de Despesa', 'class'=>'form-control select2_single', 'required'])}}

            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-3">
            {!! Html::decode(Form::label('department_id', 'Departamento', array('class' => 'col-form-label'))) !!}
            {{Form::select('department_id', $Page->auxiliar['departments'], isset($Data) ? $Data->department_id : old('department_id', Request::get('department_id')), ['placeholder' => 'Departamento', 'class'=>'form-control select2_single', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group col-3">
            {!! Html::decode(Form::label('reference', 'Mês Referência', array('class' => 'col-form-label'))) !!}
            {{Form::text('reference', (isset($Data) ? $Data->reference_formatted : ""), ['class'=>'form-control show-date-month-year','data-provide'=>"datepicker",'data-date-format'=>"mm/yyyy",'data-min-view-mode'=>"months",'data-start-view'=>"months",'data-language'=>"pt-BR", 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-3">
            {!! Html::decode(Form::label('value', 'Valor', array('class' => 'col-form-label'))) !!}
            {{Form::text('value', (isset($Data) ? $Data->value_formatted : ""), ['class'=>'form-control show-price', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-3">
            {!! Html::decode(Form::label('due', 'Data Vencimento', array('class' => 'col-form-label'))) !!}
            {{Form::text('due', (isset($Data) ? $Data->due_formatted : Request::get('due',"")), ['placeholder'=>'Data Vencimento','class'=>'form-control show-date','data-provide'=>"datepicker",'data-language'=>"pt-BR", 'required'])}}
            <div class="invalid-feedback"></div>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            {!! Html::decode(Form::label('observation', 'Observações', array('class' => 'col-form-label'))) !!}
            {!! Form::textarea('observation', isset($Data) ? $Data->observation : Request::get('observation', ""), ['class'=>'form-control','rows' => 3, 'minlength'=>'3', 'maxlength'=>'500']) !!}
            <div class="invalid-feedback"></div>
        </div>
    </div>

</div>

@if(!isset($Data) || !$Data->isApproved())
    <footer class="card-footer text-right">
        <button class="btn btn-primary" type="submit">Salvar</button>
    </footer>
@endif

