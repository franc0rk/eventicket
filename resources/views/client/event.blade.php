@extends('layouts.app')
@section('content')
<div class="container" id="reactive">
    <h3>
        @include('layouts.partials.event_type_icons')
        {{$event->name}}
    </h3>
    <div class="col-xs-12 col-md-6">
        <p>{{$event->description}}</p>
        <p><strong><i class="fa fa-calendar"></i> <i class="fa fa-clock-o"></i> Fecha y hora:</strong> {{$event->date}}</p>
        <p><strong><i class="fa fa-map-marker"></i> Lugar:</strong> {{$event->place->name}}
            <br>{{ $event->place->address }}
        </p>
        <img class="img-responsive" src="{{ asset($event->image_cover) }}">
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="row">
            <div class="col-xs-12">
                <img class="img-responsive" src="{{ asset($event->place->image) }}">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5">
                <h5>Zona</h5>
                <select name="area" id="area" class="form-control" v-model="area">
                    <option value="0" disabled>Seleccionar zona</option>
                    @foreach($event->place->areas as $area)
                        <option value="{{$area->price}}">{{$area->name}} - ${{$area->price}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-2">
                <h5>Cantidad</h5>
                <input id="tickets" type="number" value="1" v-bind:min="1" v-bind:max="5" class="form-control text-center" v-model="tickets">
            </div>
            <div class="col-xs-3">
                <h5>Total</h5>
                <p id="total"><strong>@{{ area * tickets }}</strong></p>
            </div>
            <div class="col-xs-2">
                <h5 class="text-center">-</h5>
                <button id="reservationButton" class="btn btn-primary" v-on:click="showReservationModal">Reservar</button>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials.modal')
@include('layouts.partials.reservation_modal')
@endsection
@section('scripts')
    <script>

    </script>
    <script src="https://unpkg.com/vue"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                area: 0,
                tickets: 1,
            },
            methods: {
                showReservationModal: function() {
                    if(this.area == 0) { toastr.error('Seleccione una zona valida'); return;}
                    if(!(this.tickets > 0)) { toastr.error('Ingrese cantidad de boletos valida'); return;}
                        @auth
                        clearModal(true);
                        $('#show-modal').modal();

                        var reservation = {};
                        var area = $("#area option[value='"+this.area+"']").text();
                        area = area.substr(0, area.indexOf('- $'));

                        reservation.body = `
                            <p><strong>Evento:</strong> {{$event->name}}</p>
                            <p><strong>Zona:</strong> ${area}</p>
                            <p><strong>Boletos:</strong> ${this.tickets}</p>
                            <p><strong>Total a pagar:</strong> $ ${this.tickets*this.area}</p>
                        `;

                        $('#show-modal .modal-title').append(`<h4><i class="fa fa-book"></i> Confirmar reservación</h4>`);
                        $('#show-modal .modal-body').append(`${reservation.body}`);
                        $('#show-modal .modal-footer').append(`@include('layouts.partials.reservate_button')`);

                        $('#reservateButton').click(function() {
                            var data = {
                                user_id: '{{auth()->id()}}',
                                event_id: '{{$event->id}}',
                                tickets: $('#tickets').val(),
                                area: area,
                                total: $('#total').text()
                            };
                            axios.post('{{route('reservations.store')}}',data)
                                .then(function(success) {
                                    toastr.success('Reservación completada');
                                    $('#show-modal').modal('hide');
                                    $('#reservation-modal .modal-title').append(`<h4>
                                        <i class="fa fa-book"></i>
                                         Reservación completada
                                    </h4>`);
                                    $('#reservation-modal .modal-body').append(`<p> Tu reservación fue realizada correctamente.
                                        <br /><br />Se enviara un correo electronico en el que puedes ver las instrucciones
                                        para completar la compra de tus entradas al evento.
                                        <br /><br />
                                        Tambien puedes ver estas instrucciones en tu historial, te redireccionaremos a esta pagina ahora.
                                        <br /><br />
                                        Gracias por tu preferencia!</p>`);
                                    $('#reservation-modal').modal();
                                    setTimeout(function() {
                                        window.location.replace('{{ route('history') }}');
                                    }, 15000);
                                })
                                .catch(function (error) {
                                    $.each(error.response.data.errors, function(key,value) {
                                        toastr.error(value);
                                    });
                                });
                        });
                    @endauth
                    @guest
                        window.location.replace('../login');
                    @endguest
                }
            }
        });
    </script>
@endsection