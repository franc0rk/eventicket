@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top:30px;">
        <div class="col-xs-12 col-sm-3">
            <h2 class="text-center">Proximos eventos</h2>
        </div>
        <div class="col-xs-12 col-sm-9">
                    <div class="tab-content">
                        <div id="all-all" class="tab-pane active fade in">
                            @foreach($events as $event)
                            <div class="event well">
                                <div class="media">
                                    <a class="pull-left" href="{{route('client.events.show',$event->id)}}">
                                        <img class="media-object" src="{{$event->image_thumbnail}}" width="150" height="150">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$event->name}}</h4>
                                        <p>{{$event->description}}</p>
                                        <span><i class="fa fa-calendar"></i> {{$event->date}}</span>
                                        <span><i class="fa fa-map-marker"></i> {{$event->place->name}}</span>
                                        <p class="pull-right"><a href="{{route('client.events.show',$event->id)}} id="event" class="btn btn-primary">Reservar entradas</a></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-xs-12 text-center">
                            {{$events->links()}}
                        </div>
                    </div>
        </div>
    </div>
@endsection