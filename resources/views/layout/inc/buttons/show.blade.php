<a href="
@if(isset($field_edit_route))
        {{$field_edit_route}}
@else
    @can($Page->entity.'.edit')
        {{route($Page->entity.'.edit',$sel['id'])}}
    @else
        {{route($Page->entity.'.show',$sel['id'])}}
    @endcan
@endif
">
    {{$sel['id']}}
</a>
