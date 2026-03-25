@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )

@if (config('adminlte.use_route_url', false))
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<li class="nav-item dropdown user-menu">

    {{-- Botón toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=128"
             class="user-image img-circle elevation-2"
             alt="{{ Auth::user()->name }}">
        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
    </a>

    {{-- Dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        {{-- Header --}}
        <li class="user-header bg-primary">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ffffff&color=0D6EFD&size=128"
                 class="img-circle elevation-2"
                 alt="{{ Auth::user()->name }}">
            <p>
                {{ Auth::user()->name }}
                <small class="d-block">{{ Auth::user()->email }}</small>
            </p>
        </li>

        {{-- Mi Perfil (solo aprendices role 3) --}}
        @if(Auth::user()->role === 3)
            <li class="user-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('mi.perfil') }}" class="btn btn-default btn-flat btn-block text-left">
                            <i class="fas fa-user-circle mr-2 text-primary"></i> Mi Perfil
                        </a>
                    </div>
                </div>
            </li>
        @endif

        {{-- Footer: Logout --}}
        <li class="user-footer">
            <a class="btn btn-default btn-flat btn-block"
               href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red mr-1"></i>
                Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display:none;">
                {{ csrf_field() }}
            </form>
        </li>

    </ul>
</li>
