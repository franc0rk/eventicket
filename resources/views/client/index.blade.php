@extends('layouts.app')

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="myCarousel" data-slide-to="0" class="active"></li>
            @foreach($banner_events as $key => $event)
            <li data-target="#myCarousel" data-slide-to="{{ $key + 1 }}"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <a href="#"><img src="{{asset('img/eventicket_welcome.jpg')}}"></a>
            </div>
            @foreach($banner_events as $key => $event)
            <div class="item">
                <div class="carousel-caption">
                    <h2>{{$event->name}}</h2>
                    <p>{{$event->description}}</p>
                </div>
                <a href="{{route('client.events.show',$event->id)}}"><img src="{{asset($event->image_cover)}}"></a>
            </div>
            @endforeach
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
            <form action="{{route('client.events.index')}}" method="get">
                @include('layouts.partials.searcher')
            </form>
            <div id="events_found"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#search').on('input', function (event) {
            if($('#search').val() !== '') {
                $.get('events/?search=' + event.target.value, function (response) {
                    $('#events_found').empty();
                    response.data.forEach(function (event) {
                        console.log(event);
                        var row = `
                        <div class="row" style="cursor: pointer" onclick="window.location.replace('events/'+${event.id})">
                            <div class="col-xs-12">
                                <div class="col-sm-3">
                                    <img src="${event.image_thumbnail}" class="img-responsive">
                                </div>
                                <div class="col-sm-9">
                                    <p><strong>${event.name}</strong></p>
                                    <p>${event.description}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    `;
                        $('#events_found').append(row);
                    });
                });
            } else {
                $('#events_found').empty();
            }
        });
    </script>
@endsection