@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top:30px;">
        <div class="col-xs-12 col-sm-3">
            <h2 class="text-center">Proximos eventos</h2>
            <form action="{{route('client.events.index')}}">
                <input class="btn btn-success" type="submit" value="Filtrar"/>
                <h5>Tipo de evento</h5>
                <ul class="list-unstyled">
                @foreach($event_types as $event_type)
                    <li><input type="checkbox" id="event_type_{{$event_type->id}}" name="event_type_{{$event_type->id}}" {{  array_key_exists('event_type_'.$event_type->id, session('values')) ? 'checked' : ''}}> {{ $event_type->name }}</li>
                @endforeach
            </ul>
            <h5>Estado</h5>
            <ul class="list-unstyled">
                @foreach($states as $state)
                <li><input type="checkbox" id="state_{{$state->id}}" name="state_{{$state->id}}" {{  array_key_exists('state_'.$state->id, session('values')) ? 'checked' : ''}}> {{ $state->name }}</li>
                @endforeach
            </ul>
            <input class="btn btn-success" type="submit" value="Filtrar"/>
            </form>
        </div>
        <div class="col-xs-12 col-sm-9">
                    <div class="tab-content">
                        <div id="all-all" class="tab-pane active fade in">
                            @if($events->count() == 0)
                                <p>No se encontraron eventos.</p>
                            @endif
                            @foreach($events as $event)
                            <div class="event well">
                                <div class="media">
                                    <a class="pull-left" href="{{route('client.events.show',$event->id)}}">
                                        <img class="media-object" src="{{asset($event->image_thumbnail)}}" width="150" height="150">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            @include('layouts.partials.event_type_icons')
                                            {{$event->name}}
                                        </h4>
                                        <p>{{$event->description}}</p>
                                        <span><i class="fa fa-calendar"></i> {{$event->date}}</span>
                                        <span><i class="fa fa-map-marker"></i> {{$event->place->name}}</span>
                                        <p class="pull-right"><a href="{{route('client.events.show',$event->id)}}" id="event" class="btn btn-primary">Reservar entradas</a></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
        </div>
    </div>
@endsection