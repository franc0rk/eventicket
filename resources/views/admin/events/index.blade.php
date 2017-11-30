@extends('admin.template')
@section('admin_content')
    <h2><i class="fa fa-calendar-o"></i> Eventos</h2>
    <hr>
    <div class="search-bar">
        <div class="row">
            @include('layouts.partials.create_button')
            <div class="col-xs-10 text-rigth">
                <form action="{{route('events.index')}}" method="get">
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
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->name}}</td>
                        <td>{{$event->place->name}}</td>
                        <td>{{$event->date}}</td>
                        @include('layouts.partials.action_buttons')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 text-center">
            {{$events->appends(['search' => $search])->links()}}
        </div>
    </div>
    @include('layouts.partials.modal')
@endsection
@section('scripts')
    <script>
        var select_place = null;
        var select_event_type = null;
        /*Load Areas*/
        $('#search').on('input', function (event) {
            $.get('events/?search=' + event.target.value, function (response) {
                $('tbody').empty();
                $('.pagination').hide();
                response.data.forEach(function (event) {
                    var row = `
                        <tr>
                            <td>${event.id}</td>
                            <td>${event.name}</td>
                            <td>${event.place.name}</td>
                            <td>${event.date}</td>
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
            axios.get('events/'+id)
                .then(function(response) {
                    clearModal(false);
                    console.log(response.data);
                    var event = {};
                    event.id = response.data.id;
                    event.name = response.data.name;
                    event.description = response.data.description;
                    event.place = response.data.place.name;
                    event.date = response.data.date;
                    event.image_cover = response.data.image_cover;
                    event.image_thumbnail = response.data.image_thumbnail;
                    event.created_at = response.data.created_at;

                    event.body = `
                        <p><strong>Id:</strong> ${event.id}</p>
                        <p><strong>Nombre:</strong> ${event.name}</p>
                        <p><strong>Descripción:</strong> ${event.description}</p>
                        <p><strong>Lugar:</strong> ${event.place}</p>
                        <p><strong>Fecha del evento:</strong> ${event.date}</p>

                        <p>
                            <strong>Imagen miniatura:</strong>
                        </p>
                        <div class="text-center">
                                <img width="200px" heigth="200px" src="{{asset('${event.image_thumbnail}')}}" />
                        </div>
                        <p>
                            <strong>Imagen de portada:</strong>
                        </p>
                        <div class="text-center">
                                <img width="80%" heigth="80%"src="{{asset('${event.image_cover}')}}" />
                        </div>
                        <p><strong>Fecha de creacion:</strong> ${event.created_at}</p>

                    `;

                    $('.modal-title').append(`<h4><i class="fa fa-calendar-o"></i> ${event.name}</h4>`);
                    $('.modal-body').append(event.body)
                });

            $('#show-modal').modal();
        });

        /*Create an Area*/
        $('#createButton').on('click', function () {
            clearModal(true);

            $('.modal-title').append(`<h4><i class="fa fa-calendar-o"></i> Crear evento</h4>`);
            $('.modal-body').append(`@include('admin.events.form')`);
            $('.modal-footer').append(`@include('layouts.partials.store_button')`);

            select_event_type = $('#event_type');
            select_event_type.empty();

            axios.get('event_types_all')
                .then(function (response) {
                    response.data.forEach(function (event_type) {
                        var option = `<option value="${event_type.id}">${event_type.name}</option>`;
                        select_event_type.append(option);
                    });
                    select_event_type.selectize();
                });

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
                /*var data = {
                    event_type_id: select_event_type.val(),
                    place_id: select_place.val(),
                    name: $('#name').val(),
                    description: $('#description').val(),
                    date: $('#date').val(),
                    image_thumbnail: $('#thumbnail').val(),
                    image_cover: $('#cover').val()
                };*/

                var form_data = new FormData();
                $.each($('#thumbnail')[0].files, function(i, file) {
                    form_data.append('image_thumbnail', file);
                });
                $.each($('#cover')[0].files, function(i, file) {
                    form_data.append('image_cover', file);
                });

                form_data.append('event_type_id', select_event_type.val());
                form_data.append('place_id', select_place.val());
                form_data.append('state_id', select_place.val());
                form_data.append('name', $('#name').val());
                form_data.append('description', $('#description').val());
                form_data.append('date', $('#date').val());

                console.log(form_data);

                axios.post('events', form_data)
                    .then(function (response) {
                        console.log(response);
                        toastr.success('Evento creado');
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
            var event = {};
            axios.get('events/' + id)
                .then(function (response) {
                    event.id = response.data.id;
                    event.name = response.data.name;
                    event.description = response.data.description;
                    event.place_id = response.data.place_id;
                    event.event_type_id = response.data.event_type_id;
                    event.date = response.data.date;

                    clearModal(true);

                    $('.modal-title').append(`<h4><i class="fa fa-location-arrow"></i> Editar zona</h4>`);
                    $('.modal-body').append(`@include('admin.events.form')`);
                    $('.modal-footer').append(`@include('layouts.partials.store_button')`);

                    select_event_type = $('#event_type');
                    select_event_type.empty();

                    axios.get('event_types_all')
                        .then(function (response) {
                            response.data.forEach(function (event_type) {
                                var option = `<option value="${event_type.id}">${event_type.name}</option>`;
                                select_event_type.append(option);
                            });
                        });

                    select_place = $('#place');
                    select_place.empty();

                    axios.get('places_all')
                        .then(function (response) {
                            response.data.forEach(function (place) {
                                var option = `<option value="${place.id}">${place.name}</option>`;
                                select_place.append(option);
                            });
                            select_event_type.val(event.event_type_id);
                            select_place.val(event.place_id);
                            $('#name').val(event.name);
                            $('#description').val(event.description);
                            $('#date').val(moment(event.date).format('YYYY-MM-DDThh:mm'));
                            select_event_type.selectize();
                            select_place.selectize();
                        });

                    /*Update an Area*/
                    $('#storeButton').click(function () {

                        var data = {
                            event_type_id: select_event_type.val(),
                            place_id: select_place.val(),
                            name: $('#name').val(),
                            description: $('#description').val(),
                            date: $('#date').val(),
                            image_thumbnail: $('#thumbnail').val(),
                            image_cover: $('#cover').val()
                        }

                        axios.put('events/'+event.id, data)
                            .then(function (response) {
                                toastr.success('Evento actualizado');
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

        /*Delete an Event*/
        $('.deleteButton').on('click', function() {
            clearModal(true);
            $('#show-modal').modal();
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var area = {};
            axios.get('events/' + id)
                .then(function (response) {
                    area.id = response.data.id;
                    area.name = response.data.name;

                    $('.modal-title').append(`<h4><i class="fa fa-calendar-o"></i> Eliminar ${area.name}</h4>`);
                    $('.modal-body').append(`<p>¿Deseas eliminar este registro?</p>`);
                    $('.modal-footer').append(`@include('layouts.partials.destroy_button')`);

                    $('#destroyButton').click(function() {
                        axios.delete('events/' + id)
                            .then(function(response) {
                                toastr.error(`${response.data.name} fue eliminado`);
                                refreshPage();
                            });
                    });
                });
        });
    </script>
@endsection