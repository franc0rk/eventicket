@extends('layouts.app')

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <a href="#"><img src="../../img/evento1.jpg"></a>
            </div>

            <div class="item">
                <a href="#"><img src="../../img/evento2.jpg"></a>
            </div>

            <div class="item">
                <a href="#"><img src="../../img/evento3.jpg"></a>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container">
        <div class="col-xs-12">
            <h2 class="text-center">Buscar un evento</h2>
            <input id="search_event" name="search_event" type="text" class="form-control text-center" placeholder="Ingresa palabras claves del evento aquí">
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="col-xs-12 col-sm-3">
            <h2 class="text-center">Proximos eventos</h2>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#all" data-toggle="tab">Todos</a></li>
                <li><a data-toggle="tab" href="#mty">Monterrey</a></li>
                <li><a data-toggle="tab" href="#gdl">Guadalajara</a></li>
                <li><a data-toggle="tab" href="#cdmx">Ciudad de México</a></li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="tab-content">
                <div id="all" class="tab-pane active fade in">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#all-all">Todos</a></li>
                        <li><a data-toggle="tab" href="#all-culturales">Culturales</a></li>
                        <li><a data-toggle="tab" href="#all-deportivos">Deportivos</a></li>
                        <li><a data-toggle="tab" href="#all-musicales">Musicales</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="all-all" class="tab-pane active fade in">
                            <div class="event well">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="../../img/santa-lucia.jpg" width="150" height="150">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Festival Internacional de Santa Lucia</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium esse, officiis deleniti sit iusto incidunt sunt officia facilis, odit natus temporibus quibusdam? Iusto iure blanditiis, quidem vero esse tempore obcaecati.</p>
                                        <span><i class="fa fa-calendar"></i> 28 Septiembre 2017 |</span>
                                        <span><i class="fa fa-map-marker"></i> Paseo Santa Lucia</span>
                                        <p class="pull-right"><button onclick="reservation()" class="btn btn-primary">Reservar entradas</button></p>
                                    </div>
                                </div>
                            </div>
                            <!--Event2-->
                            <div class="event well">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="../../img/tigres.jpg" width="150" height="150">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Tigres vs Necaxa</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium esse, officiis deleniti sit iusto incidunt sunt officia facilis, odit natus temporibus quibusdam? Iusto iure blanditiis, quidem vero esse tempore obcaecati.</p>
                                        <span><i class="fa fa-calendar"></i> 30 Septiembre 2017 |</span>
                                        <span><i class="fa fa-map-marker"></i> Estadio Universitario</span>
                                        <p class="pull-right"><button onclick="reservation()" class="btn btn-primary">Reservar entradas</button></p>
                                    </div>
                                </div>
                            </div>
                            <!--Event3-->
                            <div class="event well">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="../../img/northside.jpg" width="150" height="150">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Northside Festival</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium esse, officiis deleniti sit iusto incidunt sunt officia facilis, odit natus temporibus quibusdam? Iusto iure blanditiis, quidem vero esse tempore obcaecati.</p>
                                        <span><i class="fa fa-calendar"></i> 28 Octubre 2017 |</span>
                                        <span><i class="fa fa-map-marker"></i> Parque Fundidora</span>
                                        <p class="pull-right"><button onclick="reservation()" class="btn btn-primary">Reservar entradas</button></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="all-culturales" class="tab-pane fade"></div>
                        <div id="all-deportivos" class="tab-pane fade"></div>
                        <div id="all-musicales" class="tab-pane fade"></div>
                    </div>
                </div>
                <div id="mty" class="tab-pane fade">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#">Todos</a></li>
                        <li><a data-toggle="tab" href="#">Culturales</a></li>
                        <li><a data-toggle="tab" href="#">Deportivos</a></li>
                        <li><a data-toggle="tab" href="#">Musicales</a></li>
                    </ul>
                </div>
                <div id="gdl" class="tab-pane fade">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#">Todos</a></li>
                        <li><a data-toggle="tab" href="#">Culturales</a></li>
                        <li><a data-toggle="tab" href="#">Deportivos</a></li>
                        <li><a data-toggle="tab" href="#">Musicales</a></li>
                    </ul>
                </div>
                <div id="cdmx" class="tab-pane fade">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#">Todos</a></li>
                        <li><a data-toggle="tab" href="#">Culturales</a></li>
                        <li><a data-toggle="tab" href="#">Deportivos</a></li>
                        <li><a data-toggle="tab" href="#">Musicales</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection