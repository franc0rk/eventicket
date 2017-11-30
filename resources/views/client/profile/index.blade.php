@extends('client.profile.template')
@section('profile_content')
    <div class="container w100">
        <h3>Perfil</h3>
        <hr>
        <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Correo electronico: </strong> {{ auth()->user()->email }}</p>
        <p><strong>Telefono:</strong> {{ auth()->user()->phone }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ auth()->user()->birthday }}</p>
        <p><strong>Miembro desde:</strong> {{ auth()->user()->created_at }}</p>
        <p><strong>Ultima actualizacion del perfil:</strong> {{ auth()->user()->updated_at }}</p>
        <p><strong>Reservaciones totales: </strong>{{ auth()->user()->reservations->count() }} <a href="{{ route('history') }}">Ver historial</a></p>
        <p><a href="{{ route('configuration') }}">Editar perfil</a></p>
    </div>
@endsection