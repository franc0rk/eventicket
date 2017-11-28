<li class="separator"><a href=""></a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        @if(Auth::user()->user_type_id == 2)
            <!--<li><a href="{{ route('profile') }}"><i class="fa fa-user"></i> Perfil</a></li>
            <li><a href="{{ route('history') }}"><i class="fa fa-list"></i> Historial</a></li>
            <li><a href="{{ route('configuration') }}"><i class="fa fa-cogs"></i> Configuracion</a></li>
            <li><a href="{{ route('help') }}"><i class="fa fa-info-circle"></i> Ayuda</a></li>-->
        @endif
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>