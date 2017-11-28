<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">EvenTicket</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li {{setActive('index')}}><a href="/">Inicio</a></li>
                <li {{setActive('events')}}><a href="{{route('client_events')}}">Eventos</a></li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Eventos <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="events.html">Culturales</a></li>
                        <li><a href="events.html">Deportivos</a></li>
                        <li><a href="events.html">Musicales</a></li>
                    </ul>
                </li>-->
                <!--<li><a href="contact.html">Contacto</a></li>-->
                <!--<li>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar un evento">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                    </form>
                </li>-->
                <li class="separator"></li>
                @include('layouts.navs.partials.user')
            </ul>
        </div>
    </div>
</nav>