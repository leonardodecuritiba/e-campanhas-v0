<a href="
@if(isset($field_edit_route))
        {{$field_edit_route}}
@else
    {{route($Page->entity.'.show',$sel['id'])}}
@endif
">
    {{$sel['id']}}
</a>
