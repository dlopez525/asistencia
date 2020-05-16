@extends('layouts.azia')
@section('css')
    <style>
        .dt_icons i {font-size: 1.4em}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Usuarios</h2>
            <div class="az-content-label mg-b-5">Basic DataTable</div>
            <p class="mg-b-20">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Crear Nuevo Usuario</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12" id="messages">
            @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tbl_data" class="table dataTable no-footer" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let tbl_data = $("#tbl_data").DataTable({
            'pageLength' : 15,
            'bLengthChange' : false,
            'lengthMenu': false,
            'language': {
                'url': '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json'
            },
            "order": [[ 0, "asc" ]],
            'searching': false,
            'processing': false,
            'serverSide': true,
            'ajax': {
                'url': '/configuracion/usuarios/dt',
                'type' : 'get',
            },
            'columns': [
                {
                    data: 'lastname',
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role.role'
                },
                {
                    data: 'id'
                }
            ],
            'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).find("td:eq(4)").html('<a href="/configuracion/usuarios/'+ aData['id'] +'/edit" class="dt_icons"><i class="typcn typcn-edit"></i></a> &nbsp; <a href="#" class="dt_icons deleteUser"><i class="typcn typcn-trash"></i></a>');
            }
        });
        $('body').on('click', '.disableUser', function(e) {
            e.preventDefault();
            let data = tbl_data.row( $(this).parents('tr') ).data();
            if (confirm('¿Desea Deshabilitar este Usuario?')) {
                $.ajax({
                    type: 'post',
                    url: '/configuracion/usuarios/disable',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: data['id'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response == true) {
                            $('#messages').html('<div class="alert alert-success">Usuario Desahabilitado con éxito</div>');
                            tbl_data.ajax.reload();
                        } else {
                            $('#messages').html('<div class="alert alert-danger">Ooops! Ocurrió un error</div>');
                        }

                    },
                    error: function(response) {
                        // toastr.error(response.responseText);
                        console.log(response.responseText)
                    }
                });
            }
        });
        $('body').on('click', '.enableUser', function(e) {
            e.preventDefault();
            let data = tbl_data.row( $(this).parents('tr') ).data();
            if (confirm('¿Desea Habilitar este Usuario?')) {
                $.ajax({
                    type: 'post',
                    url: '/configuracion/usuarios/enable',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: data['id'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response == true) {
                            $('#messages').html('<div class="alert alert-success">Usuario Habilitado con éxito</div>');
                            tbl_data.ajax.reload();
                        } else {
                            $('#messages').html('<div class="alert alert-danger">Ooops! Ocurrió un error</div>');
                        }

                    },
                    error: function(response) {
                        // toastr.error(response.responseText);
                        console.log(response.responseText)
                    }
                });
            }
        });
        $('body').on('click', '.deleteUser', function(e) {
            e.preventDefault();
            let data = tbl_data.row( $(this).parents('tr') ).data();

            if (confirm('¿Desea Eliminar este Usuario?')) {
                $.ajax({
                    type: 'post',
                    url: '/configuracion/usuarios/delete',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: data['id'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response == true) {
                            $('#messages').html('<div class="alert alert-success">Usuario Eliminado con éxito</div>');
                            tbl_data.ajax.reload();
                        } else {
                            $('#messages').html('<div class="alert alert-danger">Ooops! Ocurrió un error</div>');
                        }

                    },
                    error: function(response) {
                        // toastr.error(response.responseText);
                        console.log(response.responseText)
                    }
                });
            }
        });
    </script>
@endsection