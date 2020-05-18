@extends('layouts.azia')
@section('css')
    <style>
        .dt_icons i {font-size: 1.4em; display: none;}
    </style>
    @if (auth()->user()->role_id != 2)
    <style>
        .dt_icons i {font-size: 1.4em; display: block;}
    </style>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Horarios</h2>
        </div>
    </div>
    @if (auth()->user()->role_id != 2)
        <div class="row">
            <div class="col mb-4">
                <a href="{{ route('shedules.create') }}" class="btn btn-primary">Crear Nuevo Horario</a>
            </div>
        </div>
    @endif
    <input type="hidden" id="role" value="{{ auth()->user()->role_id}}">
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
        @if (auth()->user()->role_id != 2)    
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
        @endif
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
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Curso</th>
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
                'url': '/horarios/horario/dt',
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
                    data: 'l',
                },
                {
                    data: 'm',
                },
                {
                    data: 'mi',
                },
                {
                    data: 'j',
                },
                {
                    data: 'v',
                },
                {
                    data: 'time_from',
                },
                {
                    data: 'time_to',
                },
                {
                    data: 'course',
                },
                {
                    data: 'id'
                },
            ],
            'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).find("td:eq(9)").html('<a href="/horarios/horario/'+ aData['id'] +'/edit" class="dt_icons"><i class="typcn typcn-edit"></i></a> &nbsp; <a href="#" class="dt_icons deleteSchedule"><i class="typcn typcn-trash"></i></a>');
                    $(nRow).find("td:eq(0)").text(aData['user']['name'] + ' ' + aData['user']['lastname']);
                    if (aData['l'] == 1) {
                        $(nRow).find("td:eq(1)").html('<span class="text-success tx-24 text-center typcn typcn-input-checked"></span>');
                    }
                    if (aData['m'] == 1) {
                        $(nRow).find("td:eq(2)").html('<span class="text-success tx-24 text-center typcn typcn-input-checked"></span>');
                    }
                    if (aData['mi'] == 1) {
                        $(nRow).find("td:eq(3)").html('<span class="text-success tx-24 text-center typcn typcn-input-checked"></span>');
                    }
                    if (aData['j'] == 1) {
                        $(nRow).find("td:eq(4)").html('<span class="text-success tx-24 text-center typcn typcn-input-checked"></span>');
                    }
                    if (aData['v'] == 1) {
                        $(nRow).find("td:eq(5)").html('<span class="text-success tx-24 text-center typcn typcn-input-checked"></span>');
                    }
            }
        });
        $('#user').on('change', function() {
            tbl_data.ajax.reload();
        });
        $('body').on('click', '.deleteSchedule', function(e) {
            e.preventDefault();
            let data = tbl_data.row( $(this).parents('tr') ).data();

            if (confirm('¿Desea Eliminar este Horario?')) {
                $.ajax({
                    type: 'post',
                    url: '/horarios/horario/delete',
                    data: {
                        _token: '{{ csrf_token() }}',
                        schedule_id: data['id'],
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response == true) {
                            $('#messages').html('<div class="alert alert-success">Horario Eliminado con éxito</div>');
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
            let url = '/horarios/horario/pdf?teacher=' + profesor;
            if ($('#role').val() == 2) {
                url = '/horarios/horario/pdf';
            }
            $(location).attr('href',url);
        });
    </script>
@endsection