@extends('layouts.azia')
@section('css')
    <style>
        .dt_icons i {font-size: 1.4em}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Asistencia</h2>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            <a href="{{ route('asistence.create') }}" class="btn btn-primary">Crear Nueva Asistencia</a>
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
        <div class="col-2">
            <div class="form-group">
                <label>Filtrar por Docente</label>
                <select id="user" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($teachers as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} {{ $t->lastname }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <button class="btn btn-danger mt-4" id="pdf">PDF</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tbl_data" class="table dataTable no-footer" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th>Profesor</th>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
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
                'url': '/horarios/asistencia/dt',
                'type' : 'get',
                'data': function(d) {
                    d.teacher = $('#user').val();
                }
            },
            'columns': [
                {
                    data: 'user.name',
                },
                {
                    data: 'date',
                },
                {
                    data: 'entry',
                },
                {
                    data: 'exit',
                },
                {
                    data: 'id'
                },
            ],
            'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).find("td:eq(4)").html('<a href="/horarios/asistencia/'+ aData['id'] +'/edit" class="dt_icons"><i class="typcn typcn-edit"></i></a> &nbsp; <a href="#" class="dt_icons deleteAsistence"><i class="typcn typcn-trash"></i></a>');
                    $(nRow).find("td:eq(1)").text(moment(aData['date']).format("DD/MM/YYYY"));
                    $(nRow).find("td:eq(0)").text(aData['user']['name'] + ' ' + aData['user']['lastname']);
            }
        });
        $('#user').on('change', function() {
            tbl_data.ajax.reload();
        });
        $('body').on('click', '.deleteAsistence', function(e) {
            e.preventDefault();
            let data = tbl_data.row( $(this).parents('tr') ).data();

            if (confirm('¿Desea Eliminar esta Asistencia?')) {
                $.ajax({
                    type: 'post',
                    url: '/horarios/asistencia/delete',
                    data: {
                        _token: '{{ csrf_token() }}',
                        asistence_id: data['id'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response == true) {
                            $('#messages').html('<div class="alert alert-success">Asistencia Eliminada con éxito</div>');
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

        $('#pdf').click(function(){
            let profesor = $('#user').val();
            let url = '/horarios/asistencia/pdf?teacher=' + profesor;
            $(location).attr('href',url);
        });
    </script>
@endsection