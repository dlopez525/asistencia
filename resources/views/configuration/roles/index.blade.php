@extends('layouts.azia')
@section('css')
    <style>
        .dt_icons i {font-size: 1.4em}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Roles</h2>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear Nuevo Rol</a>
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
                'url': '/configuracion/roles/dt',
                'type' : 'get',
            },
            'columns': [
                {
                    data: 'role',
                },
                {
                    data: 'id'
                }
            ],
            'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).find("td:eq(1)").html('<a href="/configuracion/roles/'+ aData['id'] +'/edit" class="dt_icons"><i class="typcn typcn-edit"></i></a> &nbsp; <a href="#" class="dt_icons deleteRole"><i class="typcn typcn-trash"></i></a>');
            }
        });
        $('body').on('click', '.deleteRole', function(e) {
            e.preventDefault();
            let data = tbl_data.row( $(this).parents('tr') ).data();

            if (confirm('¿Desea Eliminar este Rol?')) {
                $.ajax({
                    type: 'post',
                    url: '/configuracion/roles/delete',
                    data: {
                        _token: '{{ csrf_token() }}',
                        role_id: data['id'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response == true) {
                            $('#messages').html('<div class="alert alert-success">Rol Eliminado con éxito</div>');
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