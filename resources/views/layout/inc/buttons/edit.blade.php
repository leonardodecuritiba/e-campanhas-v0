<a href="{{(isset($field_edit_route) ? $field_edit_route : route($Page->entity.'.edit',$sel['id']))}}"
   class="btn btn-square btn-outline btn-xs btn-success"
   data-toggle="tooltip"
   data-placement="top"
   title="Editar"
   id="{{$sel['id']}}"
><i class="ti ti-pencil"></i>
</a>
