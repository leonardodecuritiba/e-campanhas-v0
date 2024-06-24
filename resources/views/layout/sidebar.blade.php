<!-- Sidebar -->
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-lg sidebar-expand-lg">
    <header class="sidebar-header">
        {{--<a class="logo-icon" href="{{route('index')}}"><img src="{{asset('assets/images/logo/logo.png')}}"--}}
                                                            {{--alt="logo icon"></a>--}}
        <span class="logo">
          <a href="{{route('index')}}">
              {{ config('app.name', 'Audite') }}
              {{ config('app.version') }}
          </a>
        </span>
    </header>

    <nav class="sidebar-navigation">
        <ul class="menu menu-xs">
            <li class="menu-category">Cadastros</li>
            <!--
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            | INTELIGÊNCIA
            |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
            !-->
            <li class="menu-item @if(Menu::isRoute(
            [
            'users.index','users.create','users.edit','users.show','users.removeds',
            'voters.index','voters.create','voters.edit','voters.show','voters.removeds',
            'groups.index','groups.create','groups.edit','groups.show','groups.removeds',
            'permissions.index',
            'roles.index','roles.create','roles.edit'
            ])) active open @endif">
                <a class="menu-link" href="#">
                    <span class="icon fa fa-plus-circle"></span>
                    <span class="title">Administrativo</span>
                    <span class="arrow"></span>
                </a>

                <ul class="menu-submenu">

                    @role('root')
                    <li class="menu-item @if(Menu::isRoute(['permissions.index'])) active @endif">
                        <a class="menu-link" href="{{route('permissions.index')}}">
                            <span class="icon ti-lock"></span>
                            <span class="title">Permissões</span>
                        </a>
                    </li>
                    <li class="menu-item @if(Menu::isRoute(['roles.index','roles.create','roles.edit'])) active @endif">
                        <a class="menu-link" href="{{route('roles.index')}}">
                            <span class="icon ti-bag"></span>
                            <span class="title">Roles</span>
                        </a>
                    </li>
                    @endrole

                    @can('users.menu')
                        <li class="menu-item @if(Menu::isRoute(['users.index','users.create','users.edit','users.show','users.removeds'])) active @endif">
                            <a class="menu-link" href="{{route('users.index')}}">
                                <span class="icon ti-user"></span>
                                <span class="title">Usuários</span>
                            </a>
                        </li>
                    @endcan

                    @can('voters.menu')
                        <li class="menu-item @if(Menu::isRoute(['voters.index','voters.create','voters.edit','voters.show','voters.removeds'])) active @endif">
                            <a class="menu-link" href="{{route('voters.index')}}">
                                <span class="icon ti-user"></span>
                                <span class="title">Eleitores</span>
                            </a>
                        </li>
                    @endcan

                    @can('groups.menu')
                        <li class="menu-item @if(Menu::isRoute(['groups.index','groups.create','groups.edit','groups.show','groups.removeds'])) active @endif">
                            <a class="menu-link" href="{{route('groups.index')}}">
                                <span class="icon ti-id-badge"></span>
                                <span class="title">Grupos</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
{{--            <li class="menu-item @if(Menu::isRoute(--}}
{{--            [--}}
{{--            'vehicles.index','vehicles.create','vehicles.edit',--}}
{{--            'conveyors.index','conveyors.create','conveyors.edit',--}}
{{--            'service_types.index','regions.index'--}}
{{--            ])) active open @endif">--}}
{{--                <a class="menu-link" href="#">--}}
{{--                    <span class="icon fa fa-plus-circle"></span>--}}
{{--                    <span class="title">Operacional</span>--}}
{{--                    <span class="arrow"></span>--}}
{{--                </a>--}}
{{--                <ul class="menu-submenu">--}}

{{--                    @can('vehicles.menu')--}}
{{--                        <li class="menu-item @if(Menu::isRoute(['vehicles.index','vehicles.create','vehicles.edit'])) active @endif">--}}
{{--                            <a class="menu-link" href="{{route('vehicles.index')}}">--}}
{{--                                <span class="icon ti-car"></span>--}}
{{--                                <span class="title">Veículos</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('conveyors.menu')--}}
{{--                        <li class="menu-item @if(Menu::isRoute(['conveyors.index','conveyors.create','conveyors.edit'])) active @endif">--}}
{{--                            <a class="menu-link" href="{{route('conveyors.index')}}">--}}
{{--                                <span class="icon ti-truck"></span>--}}
{{--                                <span class="title">Transportadoras</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('service_types.menu')--}}
{{--                        <li class="menu-item @if(Menu::isRoute(['service_types.index'])) active @endif">--}}
{{--                            <a class="menu-link" href="{{route('service_types.index')}}">--}}
{{--                                <span class="icon ti-receipt"></span>--}}
{{--                                <span class="title">Tipos de Serviço</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('regions.menu')--}}
{{--                        <li class="menu-item @if(Menu::isRoute(['regions.index'])) active @endif">--}}
{{--                            <a class="menu-link" href="{{route('regions.index')}}">--}}
{{--                                <span class="icon ti-map-alt"></span>--}}
{{--                                <span class="title">Regiões</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                </ul>--}}
{{--            </li>--}}

        </ul>
    </nav>

</aside>
<!-- END Sidebar -->
