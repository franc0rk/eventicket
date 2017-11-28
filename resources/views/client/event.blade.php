@extends('layouts.app')
@section('content')
<div class="container">
    <h3>
        @if($event->event_type == 1) <i class="fa fa-users"></i>
        @elseif($event->event_type == 2) <i class="fa fa-music"></i>
        @else <i class="fa fa-futbol-o"></i>
        @endif
        {{$event->name}}
    </h3>
    <div class="col-xs-12 col-md-6">
        <p>{{$event->description}}</p>
        <p><strong><i class="fa fa-calendar"></i> <i class="fa fa-clock-o"></i> Fecha y hora:</strong> {{$event->date}}</p>
        <p><strong><i class="fa fa-map-marker"></i> Lugar:</strong> {{$event->place->name}}</p>
        <img class="img-responsive" src="{{$event->image_cover}}">
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="col-xs-5">
                <h5>Zona</h5>
                <select name="area" id="area" class="form-control">
                    @foreach($event->place->areas as $area)
                        <option value="{{$area->id}}">{{$area->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-2">
                <h5>Cantidad</h5>
                <input id="tickets" type="number" value="1" min="1" max="5" class="form-control text-center">
            </div>
            <div class="col-xs-3">
                <h5>Precio unitario</h5>
                <p class="price"><strong>$ 1200.00</strong></p>
            </div>
            <div class="col-xs-2">
                <h5 class="text-center">-</h5>
                <button id="reservationButton" class="btn btn-primary">Reservar</button>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials.modal')
@endsection
@section('scripts')
    <script>
        $('#reservationButton').on('click', function() {
            clearModal(true);
            $('#show-modal').modal();

            var reservation = {};
            reservation.tickets = $('#tickets').val();
            reservation.total = reservation.tickets*1200;

            reservation.body = `
            <p><strong>Evento:</strong> {{$event->name}}</p>
            <p><strong>Zona:</strong> ${$('#area').val()}</p>
            <p><strong>Boletos:</strong> ${reservation.tickets}</p>
            <p><strong>Total a pagar:</strong> ${reservation.total}</p>
        `;

            $('.modal-title').append(`<h4><i class="fa fa-book"></i> Confirmar reservación</h4>`);
            $('.modal-body').append(`${reservation.body}`);
            $('.modal-footer').append(`@include('layouts.partials.reservate_button')`);

            $('#reservateButton').click(function() {
                var data = {
                    user_id: '{{auth()->id()}}',
                    event_id: '{{$event->id}}',
                    tickets: $('#tickets').val()
                }
                axios.post('{{route('reservations.store')}}',data)
                    .then(function(success) {
                        toastr.success('Reservación completada');
                        refreshPage();
                    })
                    .catch(function (error) {
                        $.each(error.response.data.errors, function(key,value) {
                            toastr.error(value);
                        });
                    });
            });
        });
    </script>
@endsection