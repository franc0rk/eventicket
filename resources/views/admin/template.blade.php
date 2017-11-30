@extends('layouts.app')

@section('content')
<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row profile">
        <div class="col-md-3" style="margin: 0; padding: 0;">
            <div class="profile-sidebar">
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        Menú
                    </div>
                </div>
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li {{setActive('admin')}}>
                            <a href="{{route('admin_dashboard')}}">
                                Escritorio
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        <li {{setActive('admin/events')}}>
                            <a href="{{route('events.index')}}">
                                Eventos
                                <i class="fa fa-calendar-o"></i>
                            </a>
                        </li>
                        <li {{setActive('admin/reservations')}}>
                            <a href="{{route('reservations.index')}}">
                                Reservaciones
                                <i class="fa fa-book"></i>
                            </a>
                        </li>
                        <!--<li>
                            <a href="tickets.html">
                                <i class="fa fa-ticket"></i>
                                Boletos </a>
                        </li>-->
                        <li {{setActive('admin/configuration')}}>
                            <a href="{{ route('admin_configuration') }}">
                                Configuración
                                <i class="fa fa-cogs"></i>
                            </a>
                        </li>
                        <!--<li>
                            <a href="">
                                <i class="fa fa-info-circle"></i>
                                Ayuda </a>
                        </li>-->
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9" style="margin:0; padding: 0;">
            <div class="profile-content">
                @yield('admin_content')
            </div>
        </div>
    </div>
</div>
@endsection
