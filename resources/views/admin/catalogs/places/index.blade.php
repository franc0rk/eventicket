@extends('admin.template')
@section('admin_content')
    <div class="catalog-title">
        <h1><i class="fa fa-map-marker"></i> Lugares</h1>
        <hr>
    </div>
    <div class="search-bar">
        <div class="row">
            @include('layouts.partials.create_button')
            <div class="col-xs-10 text-rigth">
                <form action="{{route('places.index')}}" method="get">
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
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($places as $place)
                    <tr>
                        <td>{{$place->id}}</td>
                        <td>{{$place->name}}</td>
                        <td>{{$place->state->name}}</td>
                        @include('layouts.partials.action_buttons')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 text-center">
            {{$places->appends(['search' => $search])->links()}}
        </div>
    </div>
    @include('layouts.partials.modal')
@endsection
@section('scripts')
    <script>
        var select_state = null;
        /*Load States*/
        $('#search').on('input', function (event) {
            $.get('places/?search=' + event.target.value, function (response) {
                $('tbody').empty();
                $('.pagination').hide();
                console.log(response);
                response.data.forEach(function (place) {
                    var row = `
                        <tr>
                            <td>${place.id}</td>
                            <td>${place.name}</td>
                            <td>${place.state.name}</td>
                            @include('layouts.partials.action_buttons')
                        </tr>
                    `;
                    $('tbody').append(row);
                });
            });
        });

        /*Show a Place*/
        $('.showButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            axios.get('places/'+id)
                .then(function(response) {
                    clearModal(false);
                    var place = {};
                    place.id = response.data.id;
                    place.name = response.data.name;
                    place.state = response.data.state.name;
                    place.created_at = response.data.created_at;

                    place.body = `
                        <p><strong>Id:</strong> ${place.id}</p>
                        <p><strong>Nombre:</strong> ${place.name}</p>
                        <p><strong>Estado:</strong> ${place.state}
                        <p><strong>Fecha de creacion:</strong> ${place.created_at}</p>
                    `;

                    $('.modal-title').append(`<h4><i class="fa fa-map-marker"></i> ${place.name}</h4>`);
                    $('.modal-body').append(place.body)
                });

            $('#show-modal').modal();
        });

        /*Create a State*/
        $('#createButton').on('click', function () {
            clearModal(true);

            $('.modal-title').append(`<h4><i class="fa fa-map-marker"></i> Crear lugar</h4>`);
            $('.modal-body').append(`@include('admin.catalogs.places.form')`);
            $('.modal-footer').append(`@include('layouts.partials.store_button')`);

            select_state = $('#state');
            select_state.empty();

            axios.get('states_all')
                .then(function (response) {
                    response.data.forEach(function (state) {
                        var option = `<option value="${state.id}">${state.name}</option>`;
                        select_state.append(option);
                    });
                    select_state.selectize();
                });

            $('#show-modal').modal();

            /* Store a Place */
            $('#storeButton').click(function () {
                var data = {
                    state_id: select_state.val(),
                    name: $('#name').val()
                };

                console.log(data);
                axios.post('places', data)
                    .then(function (response) {
                        console.log(response);
                        toastr.success('Lugar creado');
                        $('#show-modal').modal('toggle');
                        refreshPage();
                    })
                    .catch(function (error) {
                        toastr.error(error.response.data.errors.name[0]);
                    });
            });
        });

        /* Edit a Place */
        $('.editButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var place = {};
            axios.get('places/' + id)
                .then(function (response) {
                    place.id = response.data.id;
                    place.name = response.data.name;
                    place.state_id = response.data.state_id;

                    clearModal(true);

                    $('.modal-title').append(`<h4><i class="fa fa-map"></i> Editar lugar</h4>`);
                    $('.modal-body').append(`@include('admin.catalogs.places.form')`);
                    $('.modal-footer').append(`@include('layouts.partials.store_button')`);

                    select_state = $('#state');
                    select_state.empty();

                    axios.get('states_all')
                        .then(function (response) {
                            response.data.forEach(function (state) {
                                var option = `<option value="${state.id}">${state.name}</option>`;
                                select_state.append(option);
                            });
                            select_state.val(place.state_id);
                            $('#name').val(place.name);
                            select_state.selectize();
                        });

                    /*Update a State*/
                    $('#storeButton').click(function () {
                        var data = {
                            state_id: select_state.val(),
                            name: $('#name').val()
                        };
                        axios.put('places/'+place.id, data)
                            .then(function (response) {
                                console.log(response);
                                toastr.success('Estado actualizado');
                                $('#show-modal').modal('toggle');
                                refreshPage();
                            })
                            .catch(function (error) {
                                toastr.error(error.response.data.errors.name[0]);
                            });
                    });

                    $('#show-modal').modal();
                });
        });

        /*Delete a Place*/
        $('.deleteButton').on('click', function() {
            clearModal(true);
            $('#show-modal').modal();
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var place = {};
            axios.get('places/' + id)
                .then(function (response) {
                    place.id = response.data.id;
                    place.name = response.data.name;

                    $('.modal-title').append(`<h4><i class="fa fa-map"></i> Eliminar ${place.name}</h4>`);
                    $('.modal-body').append(`<p>¿Deseas eliminar este registro?</p>`);
                    $('.modal-footer').append(`@include('layouts.partials.destroy_button')`);

                    $('#destroyButton').click(function() {
                        axios.delete('places/' + id)
                            .then(function(response) {
                                toastr.error(`${response.data.name} fue eliminado`);
                                refreshPage();
                            });
                    });
                });
        });
    </script>
@endsection