@extends('admin.template')
@section('admin_content')
    <h2>
        <i class="fa fa-cogs"></i>
        Configuración
    </h2>
    <hr>
    <div class="row">
        <!--<div class="col-xs-12 col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="#"><i class="fa fa-user"></i> Usuarios</a></h3>
                </div>
            </div>
        </div>-->
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="{{ route('states.index') }}"><i class="fa fa-map"></i> Estados</a></h3>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="{{ route('places.index') }}"><i class="fa fa-map-marker"></i> Lugares</a></h3>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="{{ route('areas.index') }}"><i class="fa fa-location-arrow"></i> Zonas</a></h3>
                </div>
            </div>
        </div>
    </div>
@endsection