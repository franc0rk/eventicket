@extends('client.profile.template')
@section('profile_content')
    <div class="container w100">
        <h3>Historial</h3>
        <hr>
        @if(auth()->user()->reservations->count() == 0)
            <p>No se encontraron reservaciones.</p>
        @endif
        @foreach(auth()->user()->reservations as $reservation)
        <div class="reservation">
            <h4><strong>{{ $reservation->created_at }}</strong> - Reservó {{ $reservation->tickets }} entradas para {{ $reservation->event->name }}</h4>
            <p>Detalles del evento:</p>
            <div class="event well">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{ $reservation->event->image_thumbnail }}" width="150" height="150">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $reservation->event->name }}</h4>
                        <p>{{ $reservation->event->description }}</p>
                        <span><i class="fa fa-calendar"></i> {{ $reservation->event->date }} |</span>
                        <span><i class="fa fa-map-marker"></i> {{ $reservation->event->place->name }}</span>
                        <p class="pull-right"></p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection