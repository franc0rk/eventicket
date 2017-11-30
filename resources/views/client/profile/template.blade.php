@extends('layouts.app')
@section('content')
    <div class="container-fluid" style="margin:0; padding: 0;">
        <div class="row profile">
            <div class="col-md-3" style="margin:0; padding: 0;">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li {{ setActive('profile') }}>
                                <a href="{{ route('profile') }}">
                                    Perfil
                                    <i class="fa fa-user"></i>
                                </a>
                            </li>
                            <li {{ setActive('history') }}>
                                <a href="{{ route('history') }}">
                                    Historial
                                    <i class="fa fa-list"></i>
                                </a>
                            </li>
                            <li {{setActive('configuration') }}>
                                <a href="{{ route('configuration') }}">
                                    Configuración
                                    <i class="fa fa-cogs"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9" style="padding:0; margin: 0;">
                <div class="profile-content">
                    @yield('profile_content')
                </div>
            </div>
        </div>
    </div>
@endsection