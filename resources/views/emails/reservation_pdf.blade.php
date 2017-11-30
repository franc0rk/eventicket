@extends('emails.template')
@section('body')
    <div style="height: 60px; background-color: #2c3e50"></div>
    <div style="height: 30px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="over">Datos de reservación</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Usuario</th>
                            <th>Evento</th>
                            <th>Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ $reservation->event->name }}</td>
                            <td>{{ $reservation->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            <div class="row">
                <div class="col-xs-6">
                    <h4>Boletos</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Zona</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $reservation->area }}</td>
                                <td>{{ $reservation->tickets }}</td>
                                <td>$ {{ ($reservation->total/$reservation->tickets) }}</td>
                                <td>$ {{ $reservation->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@endsection