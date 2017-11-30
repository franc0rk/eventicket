@extends('admin.template')
@section('admin_content')
    <h2><i class="fa fa-location-arrow"></i> Zonas</h2>
    <hr>
    <div class="search-bar">
        <div class="row">
            @include('layouts.partials.create_button')
            <div class="col-xs-10 text-rigth">
                <form action="{{route('areas.index')}}" method="get">
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
                    <th>Lugar</th>
                    <th>Capacidad</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas as $area)
                    <tr>
                        <td>{{$area->id}}</td>
                        <td>{{$area->name}}</td>
                        <td>{{$area->place->name}}</td>
                        <td>{{$area->capacity}}</td>
                        @include('layouts.partials.action_buttons')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 text-center">
            {{$areas->appends(['search' => $search])->links()}}
        </div>
    </div>
    @include('layouts.partials.modal')
@endsection
@section('scripts')
    <script>
        var select_place = null;
        /*Load Areas*/
        $('#search').on('input', function (event) {
            $.get('areas/?search=' + event.target.value, function (response) {
                $('tbody').empty();
                $('.pagination').hide();
                response.data.forEach(function (area) {
                    var row = `
                        <tr>
                            <td>${area.id}</td>
                            <td>${area.name}</td>
                            <td>${area.place.name}</td>
                            <td>${area.capacity}</td>
                            @include('layouts.partials.action_buttons')
                        </tr>
                    `;
                    $('tbody').append(row);
                });
            });
        });

        /*Show an Area*/
        $('.showButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            axios.get('areas/'+id)
                .then(function(response) {
                    clearModal(false);
                    var area = {};
                    area.id = response.data.id;
                    area.name = response.data.name;
                    area.place = response.data.place.name;
                    area.capacity = response.data.capacity;
                    area.created_at = response.data.created_at;

                    area.body = `
                        <p><strong>Id:</strong> ${area.id}</p>
                        <p><strong>Nombre:</strong> ${area.name}</p>
                        <p><strong>Lugar:</strong> ${area.place}</p>
                        <p><strong>Capacidad:</strong> ${area.capacity}</p>
                        <p><strong>Fecha de creacion:</strong> ${area.created_at}</p>
                    `;

                    $('.modal-title').append(`<h4><i class="fa fa-location-arrow"></i> ${area.name}</h4>`);
                    $('.modal-body').append(area.body)
                });

            $('#show-modal').modal();
        });

        /*Create an Area*/
        $('#createButton').on('click', function () {
            clearModal(true);

            $('.modal-title').append(`<h4><i class="fa fa-location-arrow"></i> Crear zona</h4>`);
            $('.modal-body').append(`@include('admin.catalogs.areas.form')`);
            $('.modal-footer').append(`@include('layouts.partials.store_button')`);

            select_place = $('#place');
            select_place.empty();

            axios.get('places_all')
                .then(function (response) {
                    response.data.forEach(function (place) {
                        var option = `<option value="${place.id}">${place.name}</option>`;
                        select_place.append(option);
                    });
                    select_place.selectize();
                });

            $('#show-modal').modal();

            /* Store an Area */
            $('#storeButton').click(function () {
                var data = {
                    place_id: select_place.val(),
                    name: $('#name').val(),
                    capacity: $('#capacity').val()
                };

                console.log(data);
                axios.post('areas', data)
                    .then(function (response) {
                        console.log(response);
                        toastr.success('Zona creada');
                        $('#show-modal').modal('toggle');
                        refreshPage();
                    })
                    .catch(function (error) {
                        $.each(error.response.data.errors, function(key,value) {
                            toastr.error(value);
                        });
                    });
            });
        });

        /* Edit an Area */
        $('.editButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var area = {};
            axios.get('areas/' + id)
                .then(function (response) {
                    area.id = response.data.id;
                    area.name = response.data.name;
                    area.place_id = response.data.place_id;
                    area.capacity = response.data.capacity;

                    clearModal(true);

                    $('.modal-title').append(`<h4><i class="fa fa-location-arrow"></i> Editar zona</h4>`);
                    $('.modal-body').append(`@include('admin.catalogs.areas.form')`);
                    $('.modal-footer').append(`@include('layouts.partials.store_button')`);

                    select_place = $('#place');
                    select_place.empty();

                    axios.get('places_all')
                        .then(function (response) {
                            response.data.forEach(function (place) {
                                var option = `<option value="${place.id}">${place.name}</option>`;
                                select_place.append(option);
                            });
                            select_place.val(area.place_id);
                            $('#name').val(area.name);
                            $('#capacity').val(area.capacity);
                            select_place.selectize();
                        });

                    /*Update an Area*/
                    $('#storeButton').click(function () {
                        var data = {
                            place_id: select_place.val(),
                            name: $('#name').val(),
                            capacity: $('#capacity').val()
                        };
                        axios.put('areas/'+area.id, data)
                            .then(function (response) {
                                toastr.success('Zona actualizada');
                                $('#show-modal').modal('toggle');
                                refreshPage();
                            })
                            .catch(function (error) {
                                $.each(error.response.data.errors, function(key,value) {
                                    toastr.error(value);
                                });
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
            var area = {};
            axios.get('areas/' + id)
                .then(function (response) {
                    area.id = response.data.id;
                    area.name = response.data.name;

                    $('.modal-title').append(`<h4><i class="fa fa-location-arrow"></i> Eliminar ${area.name}</h4>`);
                    $('.modal-body').append(`<p>¿Deseas eliminar este registro?</p>`);
                    $('.modal-footer').append(`@include('layouts.partials.destroy_button')`);

                    $('#destroyButton').click(function() {
                        axios.delete('areas/' + id)
                            .then(function(response) {
                                toastr.error(`${response.data.name} fue eliminado`);
                                refreshPage();
                            });
                    });
                });
        });
    </script>
@endsection