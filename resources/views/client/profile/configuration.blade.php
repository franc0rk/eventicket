@extends('client.profile.template')
@section('profile_content')
    <div class="container w100">
        <h3>Configuración</h3>
        <hr>
        <ul class="list-unstyled">
            <li><button id="editUser" class="btn btn-link"><i class="fa fa-user"></i> Editar perfil</button></li>
            <li><button id="editPassword" class="btn btn-link"><i class="fa fa-key"></i> Cambiar contraseña</button></li>
            <li><button id="deleteUser" class="btn btn-link"><i class="fa fa-close"></i> Eliminar mi cuenta</button></li>
        </ul>
    </div>
    @include('layouts.partials.modal')
@endsection
@section('scripts')
    <script>
        /* Edit Profile */
        $('#editUser').on('click', function() {
            var id = parseInt({{ auth()->user()->id }});
            var user = {};
            axios.get('users/' + id)
                .then(function (response) {
                    user.id         = response.data.id;
                    user.first_name = response.data.first_name;
                    user.last_name  = response.data.last_name;
                    user.email      = response.data.email;
                    user.phone      = response.data.phone;
                    user.birthday   = response.data.birthday;

                    clearModal(true);

                    $('.modal-title').append(`<h4><i class="fa fa-user"></i> Editar perfil</h4>`);
                    $('.modal-body').append(`@include('client.profile.form')`);
                    $('.modal-footer').append(`@include('layouts.partials.store_button')`);

                    $('#first_name').val(user.first_name);
                    $('#last_name').val(user.last_name);
                    $('#email').val(user.email);
                    $('#phone').val(user.phone);
                    $('#birthday').val(user.birthday);

                    $('#show-modal').modal();

                    /*Update profile*/
                    $('#storeButton').click(function () {
                        console.log('clikoe')
                        var data = {
                            first_name: $('#first_name').val(),
                            last_name: $('#last_name').val(),
                            email: $('#email').val(),
                            phone: $('#phone').val(),
                            birthday: $('#birthday').val()
                        };
                        axios.put('users/'+user.id, data)
                            .then(function (response) {
                                console.log(response);
                                toastr.success('Perfil actualizado');
                                setTimeout(function(){refreshPage();}, 2000);
                            })
                            .catch(function (error) {
                                $.each(error.response.data.errors, function(key,value) {
                                    toastr.error(value);
                                });
                            });
                    });

                });

        });

        /* Edit Password */
        $('#editPassword').on('click', function() {
            var id = parseInt({{ auth()->user()->id }});
            var user = {};

            clearModal(true);

            $('.modal-title').append(`<h4><i class="fa fa-user"></i> Editar perfil</h4>`);
            $('.modal-body').append(`@include('client.profile.form_password')`);
            $('.modal-footer').append(`@include('layouts.partials.store_button')`);

            $('#first_name').val(user.first_name);
            $('#last_name').val(user.last_name);
            $('#email').val(user.email);
            $('#phone').val(user.phone);
            $('#birthday').val(user.birthday);

            $('#show-modal').modal();

            /*Update profile*/
            $('#storeButton').click(function () {
                var data = {
                    current_password      : $('#current_password').val(),
                    password              : $('#password').val(),
                    password_confirmation : $('#password_confirmation').val()
                };
                axios.put('users_password/'+id, data)
                    .then(function (response) {
                        console.log(response);
                        toastr.success('Contraseña actualizada');
                        setTimeout(function(){refreshPage();}, 2000);
                    })
                    .catch(function (error) {
                        $.each(error.response.data.errors, function(key,value) {
                            toastr.error(value);
                        });
                    });
            });

        });

        /*Delete account*/
        $('#deleteUser').on('click', function() {
            clearModal(true);
            $('#show-modal').modal();
            var id = parseInt({{ auth()->user()->id }});
            var user = {};
            axios.get('users/' + id)
                .then(function (response) {
                    user.id = response.data.id;
                    user.name = response.data.first_name + ' ' + response.data.last_name;

                    $('.modal-title').append(`<h4><i class="fa fa-user"></i> Eliminar ${user.name}</h4>`);
                    $('.modal-body').append(`<p>¿Deseas eliminar tu cuenta para siempre?</p>`);
                    $('.modal-footer').append(`@include('layouts.partials.destroy_button')`);

                    $('#destroyButton').click(function() {
                        axios.delete('users/' + id)
                            .then(function(response) {
                                console.log(response.data);
                                toastr.error(`${response.data.name} fue eliminado`);
                                window.location.replace('{{ route('login')}}');
                            });
                    });
                });
        });
    </script>
@endsection