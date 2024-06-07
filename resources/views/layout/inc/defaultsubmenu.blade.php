<a class="nav-link  @if(Route::currentRouteName() == $entity.'.index') active @endif" href="{{route($entity.'.index')}}">LISTAR</a>
<a class="nav-link  @if(in_array(Route::currentRouteName(), [$entity.'.create', $entity.'.edit', $entity.'.show'] )) active @endif" href="{{route($entity.'.create')}}">CADASTRO</a>
@if(isset($removeds) && $removeds)
    <a class="nav-link  @if(Route::currentRouteName() == $entity.'.removeds') active @endif" href="{{route($entity.'.removeds')}}">REMOVIDOS</a>
@endif