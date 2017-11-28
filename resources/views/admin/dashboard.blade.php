@extends('admin.template')
@section('admin_content')
<h3>Escritorio</h3>
<hr>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="{{route('events.index')}}"><i class="fa fa-calendar-o"></i> Eventos</a></h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="{{route('reservations.index')}}"><i class="fa fa-book"></i> Reservaciones</a></h3>
            </div>
        </div>
    </div>
    <!--<div class="col-xs-12 col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="tickets.html"><i class="fa fa-ticket"></i> Boletos</a></h3>
            </div>
        </div>
    </div>-->
    <div class="col-xs-12 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="{{route('admin_configuration')}}"><i class="fa fa-cogs"></i> Configuración</a></h3>
            </div>
        </div>
    </div>
</div>
<h4 style="display:none;">Ultimas actividades</h4>
<ul style="display:none" class="list-group">
    <li class="list-group-item">
        <p class="log-p">
            <i class="fa fa-book"></i><strong> Usuario de prueba</strong> realizó una reservacion al evento <strong>Tigres vs Necaxa</strong>
            <br />
            <span class="log-date">
                                <i class="fa fa-calendar"></i> 25/Septiembre/2017
                                <i class="fa fa-clock-o"></i> 19:37
                            </span>
        </p>
    </li>

    <li class="list-group-item">
        <p class="log-p">
            <i class="fa fa-book"></i><strong> Usuario de prueba2</strong> realizó una reservacion al evento <strong>Tigres vs Necaxa</strong>
            <br />
            <span class="log-date">
                                <i class="fa fa-calendar"></i> 25/Septiembre/2017
                                <i class="fa fa-clock-o"></i> 19:03
                            </span>
        </p>
    </li>

    <li class="list-group-item">
        <p class="log-p">
            <i class="fa fa-calendar-o"></i><strong> Usuario administrador</strong> agrego el evento <strong>Northside Festival</strong>
            <br />
            <span class="log-date">
                                <i class="fa fa-calendar"></i> 20/Septiembre/2017
                                <i class="fa fa-clock-o"></i> 13:00
                            </span>
        </p>
    </li>

    <li class="list-group-item">
        <p class="log-p">
            <i class="fa fa-cogs"></i><strong> Usuario administrador</strong> agrego el usuario <strong>Usuario de prueba</strong>
            <br />
            <span class="log-date">
                                <i class="fa fa-calendar"></i> 20/Septiembre/2017
                                <i class="fa fa-clock-o"></i> 12:43
                            </span>
        </p>
    </li>

    <li class="list-group-item">
        <p class="log-p">
            <i class="fa fa-ticket"></i><strong> Usuario administrador</strong> agrego <strong>50</strong> boletos al evento <strong>Tigres vs Necaxa</strong>  en la zona <strong>Preferente Sur</strong>
            <br />
            <span class="log-date">
                                <i class="fa fa-calendar"></i> 19/Septiembre/2017
                                <i class="fa fa-clock-o"></i> 14:55
                            </span>
        </p>
    </li>

    <li class="list-group-item">
        <p class="log-p">
            <i class="fa fa-calendar-o"></i><strong> Usuario administrador</strong> agrego el evento <strong>Tigres vs Necaxa</strong>
            <br />
            <span class="log-date">
                                <i class="fa fa-calendar"></i> 19/Septiembre/2017
                                <i class="fa fa-clock-o"></i> 14:52
                            </span>
        </p>
    </li>
</ul>
</div>
@endsection