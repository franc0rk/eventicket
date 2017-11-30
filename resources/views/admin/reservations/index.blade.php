@extends('admin.template')
@section('admin_content')
    <h2><i class="fa fa-book"></i> Reservaciones</h2>
    <hr>
    <div class="search-bar">
        <div class="row">
                <div class="col-xs-12 text-rigth">
                <form action="{{route('reservations.index')}}" method="get">
                    @include('layouts.partials.searcher')
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Evento</th>
                    <th>Boletos</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->id}}</td>
                        <td>{{$reservation->user->name}}</td>
                        <td>{{$reservation->event->name}}</td>
                        <td>{{$reservation->tickets}}</td>
                        <td>{{$reservation->created_at}}</td>
                        @include('layouts.partials.action_buttons_without_edit')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 text-center">
            {{$reservations->appends(['search' => $search])->links()}}
        </div>
    </div>
    @include('layouts.partials.modal')
@endsection
@section('scripts')
    <script>
        /*Load Reservations*/
        $('#search').on('input', function (event) {
            $.get('reservations/?search=' + event.target.value, function (response) {
                $('tbody').empty();
                $('.pagination').hide();
                response.data.forEach(function (reservation) {
                    var row = `
                        <tr>
                            <td>${reservation.id}</td>
                            <td>${reservation.user.first_name} ${reservation.user.last_name}</td>
                            <td>${reservation.event.name}</td>
                            <td>${reservation.tickets}</td>
                            <td>${reservation.created_at}</td>
                            @include('layouts.partials.action_buttons_without_edit')
                        </tr>
                    `;
                    $('tbody').append(row);
                });
            });
        });

        /*Show a Reservation*/
        $('.showButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            axios.get('reservations/'+id)
                .then(function(response) {
                    clearModal(false);
                    var reservation = {};
                    reservation.id = response.data.id;
                    reservation.user = response.data.user.first_name + ' ' + response.data.user.last_name;
                    reservation.event = response.data.event.name;
                    reservation.tickets = response.data.tickets;
                    reservation.created_at = response.data.created_at;

                    reservation.body = `
                        <p><strong>Id:</strong> ${reservation.id}</p>
                        <p><strong>Usuario:</strong> ${reservation.user}</p>
                        <p><strong>Evento:</strong> ${reservation.event}</p>
                        <p><strong>Boletos:</strong> ${reservation.tickets}</p>
                        <p><strong>Fecha:</strong> ${reservation.created_at}</p>
                    `;

                    $('.modal-title').append(`<h4><i class="fa fa-book"></i> Reservación ${reservation.id}</h4>`);
                    $('.modal-body').append(reservation.body)
                });

            $('#show-modal').modal();
        });

        /*Delete a Reservation*/
        $('.deleteButton').on('click', function() {
            clearModal(true);
            $('#show-modal').modal();
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var reservation = {};
            axios.get('reservations/' + id)
                .then(function (response) {
                    reservation.id = response.data.id;

                    $('.modal-title').append(`<h4><i class="fa fa-book"></i> Eliminar ${reservation.id}</h4>`);
                    $('.modal-body').append(`<p>¿Deseas eliminar este registro?</p>`);
                    $('.modal-footer').append(`@include('layouts.partials.destroy_button')`);

                    $('#destroyButton').click(function() {
                        axios.delete('reservations/' + id)
                            .then(function(response) {
                                toastr.error(`Reservación ${response.data.id} fue eliminada`);
                                refreshPage();
                            });
                    });
                });
        });
    </script>
@endsection