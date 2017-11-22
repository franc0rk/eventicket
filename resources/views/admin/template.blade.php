@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="dashboard.html">
                                <i class="fa fa-dashboard"></i>
                                Escritorio </a>
                        </li>
                        <li>
                            <a href="events.html">
                                <i class="fa fa-calendar-o"></i>
                                Eventos </a>
                        </li>
                        <li>
                            <a href="reservations.html">
                                <i class="fa fa-book"></i>
                                Reservaciones </a>
                        </li>
                        <li>
                            <a href="tickets.html">
                                <i class="fa fa-ticket"></i>
                                Boletos </a>
                        </li>
                        <li>
                            <a href="{{ route('admin_configuration') }}">
                                <i class="fa fa-cogs"></i>
                                Configuracion </a>
                        </li>
                        <li>
                            <a href="help.html">
                                <i class="fa fa-info-circle"></i>
                                Ayuda </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                @yield('admin_content')
            </div>
        </div>
    </div>
</div>
@endsection
