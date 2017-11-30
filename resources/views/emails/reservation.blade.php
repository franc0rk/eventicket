@extends('emails.template')
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h3>Hola {{ $reservation->user->name }}.</h3>
                <p>Realizaste una reservación para el evento: <strong>{{ $reservation->event->name }}</strong>.</p>
                <p>Sigue estas instrucciones para completar la compra de tus entradas:</p>
                <ol>
                    <li>Descarga el siguiente documento e imprimelo. <a href="{{route('client.reservations.show', $reservation->id)}}">Reservación {{$reservation->id}}</a></li>
                    <li>Acude a taquilla del lugar donde se realizara el evento para hacer el pago.</li>
                    <li>Listo!</li>
                </ol>
            </div>
        </div>
    </div>
@endsection