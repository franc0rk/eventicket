@extends('admin.template')
@section('admin_content')
    <h2><i class="fa fa-map"></i> Estados</h2>
    <hr>
    <div class="search-bar">
        <div class="row">
            @include('layouts.partials.create_button')
            <div class="col-xs-10 text-rigth">
                <form action="{{route('states.index')}}" method="get">
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
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($states as $state)
                    <tr>
                        <td>{{$state->id}}</td>
                        <td>{{$state->name}}</td>
                        @include('layouts.partials.action_buttons')
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 text-center">
            {{$states->appends(['search' => $search])->links()}}
        </div>
    </div>
    @include('admin.catalogs.states.show')
@endsection

@section('scripts')
    <script type="text/javascript">
        var select_state = null;
        /*Load States*/
        $('#search').on('input', function (event) {
            $.get('states/?search=' + event.target.value, function (response) {
                $('tbody').empty();
                $('.pagination').hide();
                response.data.forEach(function (state) {
                    var row = `
                        <tr>
                            <td>${state.id}</td>
                            <td>${state.name}</td>
                            @include('layouts.partials.action_buttons')
                        </tr>
                    `;
                    $('tbody').append(row);
                });
            });
        });
        /*Show a State*/
        $('.showButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            axios.get('states/'+id)
                .then(function(response) {
                    clearModal(false);
                    var state = {};
                    state.id = response.data.id;
                    state.name = response.data.name;
                    state.created_at = response.data.created_at;

                    state.body = `
                    <p><strong>Id:</strong> ${state.id}</p>
                    <p><strong>Nombre:</strong> ${state.name}</p>
                    <p><strong>Fecha de creacion:</strong> ${state.created_at}</p>
                `;

                    $('.modal-title').append(`<h4><i class="fa fa-map"></i> ${state.name}</h4>`);
                    $('.modal-body').append(state.body)
                });

            $('#show-modal').modal();
        });
        /*Create a State*/
        $('#createButton').on('click', function () {
            clearModal(true);

            $('.modal-title').append(`<h4><i class="fa fa-map"></i> Crear estado</h4>`);
            $('.modal-body').append(`@include('admin.catalogs.states.create')`);
            $('.modal-footer').append(`@include('layouts.partials.store_button')`);

            select_state = $('#state');
            select_state.empty();

            axios.get('mexico_states')
                .then(function (response) {
                    response.data.forEach(function (state) {
                        var option = `<option value="${state.region}">${state.region}</option>`;
                        select_state.append(option);
                    });
                    select_state.selectize();
                });

            $('#show-modal').modal();

            /* Store a State */
            $('#storeButton').click(function () {
                var data = {
                    name: select_state.val()
                };
                axios.post('states', data)
                    .then(function (response) {
                        console.log(response);
                        toastr.success('Estado creado');
                        $('#show-modal').modal('toggle');
                        refreshPage();
                    })
                    .catch(function (error) {
                        toastr.error(error.response.data.errors.name[0]);
                    });
            });
        });

        /* Edit a State */
        $('.editButton').on('click', function () {
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var state = {};
            axios.get('states/' + id)
                .then(function (response) {
                    state.id = response.data.id;
                    state.name = response.data.name;

                    clearModal(true);

                    $('.modal-title').append(`<h4><i class="fa fa-map"></i> Crear estado</h4>`);
                    $('.modal-body').append(`@include('admin.catalogs.states.create')`);
                    $('.modal-footer').append(`@include('layouts.partials.store_button')`);

                    select_state = $('#state');
                    select_state.empty();

                    axios.get('mexico_states')
                        .then(function (response) {
                            response.data.forEach(function (state) {
                                var option = `<option value="${state.region}">${state.region}</option>`;
                                select_state.append(option);
                            });
                            select_state.val(state.name);
                            select_state.selectize();
                        });

                    /*Update a State*/
                    $('#storeButton').click(function () {
                        var data = {
                            name: select_state.val()
                        };
                        axios.put('states/'+state.id, data)
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

        $('.deleteButton').on('click', function() {
            clearModal(true);
            $('#show-modal').modal();
            var id = parseInt($(this).parent().parent().children()[0].innerText);
            var state = {};
            axios.get('states/' + id)
                .then(function (response) {
                    state.id = response.data.id;
                    state.name = response.data.name;

                    $('.modal-title').append(`<h4><i class="fa fa-map"></i> Eliminar ${state.name}</h4>`);
                    $('.modal-body').append(`<p>¿Deseas eliminar este registro?</p>`);
                    $('.modal-footer').append(`@include('layouts.partials.destroy_button')`);

                    $('#destroyButton').click(function() {
                       axios.delete('states/' + id)
                           .then(function(response) {
                               toastr.error(`${response.data.name} fue eliminado`);
                               refreshPage();
                           });
                    });
                });
        });



    </script>
@endsection