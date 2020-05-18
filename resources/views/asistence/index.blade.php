@extends('layouts.azia')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
            <h2 class="az-content-title">Asistencia</h2>
        </div>
    </div>
    @if (auth()->user()->role_id != '2')
        <div class="row">
            <div class="col mb-4">
                <a href="{{ route('asistence.create') }}" class="btn btn-primary">Crear Nueva Asistencia</a>
            </div>
        </div>
    @endif
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
        @if (auth()->user()->role_id != '2')    
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
                <label>Filtrar por Fecha</label>
                <input type="text" class="form-control" id="dtr">
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
                            <th>Asistencia</th>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
                    let rangeDates = $('#dtr').val();
                    var arrayDates = rangeDates.split(" ");
                    var dateSpecificOne =  arrayDates[0].split("/");
                    var dateSpecificTwo =  arrayDates[2].split("/");

                    d.dateOne = dateSpecificOne[2]+'-'+dateSpecificOne[1]+'-'+dateSpecificOne[0];
                    d.dateTwo = dateSpecificTwo[2]+'-'+dateSpecificTwo[1]+'-'+dateSpecificTwo[0];
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
                    data: 'assistance',
                },
                {
                    data: 'id'
                },
            ],
            'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).find("td:eq(5)").html('<a href="/horarios/asistencia/'+ aData['id'] +'/edit" class="dt_icons"><i class="typcn typcn-edit"></i></a> &nbsp; <a href="#" class="dt_icons deleteAsistence"><i class="typcn typcn-trash"></i></a>');
                    $(nRow).find("td:eq(1)").text(moment(aData['date']).format("DD/MM/YYYY"));
                    $(nRow).find("td:eq(0)").text(aData['user']['name'] + ' ' + aData['user']['lastname']);
                    let assistance;
                    if (aData['assistance'] == 1) {
                        assistance = 'Asistió Puntual';
                    } else if (aData['assistance'] == 2) {
                        assistance = 'Asistió No Puntual';
                    } else if (aData['assistance'] == 3) {
                        assistance = 'No Asistió';
                    }
                    $(nRow).find("td:eq(4)").text(assistance);
            }
        });
        $('#user').on('change', function() {
            tbl_data.ajax.reload();
        });
        $('#dtr').change(function() {
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
            let rangeDates = $('#dtr').val();
            var arrayDates = rangeDates.split(" ");
            var dateSpecificOne =  arrayDates[0].split("/");
            var dateSpecificTwo =  arrayDates[2].split("/");

            var dateOne = dateSpecificOne[2]+'-'+dateSpecificOne[1]+'-'+dateSpecificOne[0];
            var dateTwo = dateSpecificTwo[2]+'-'+dateSpecificTwo[1]+'-'+dateSpecificTwo[0];
            let url = '/horarios/asistencia/pdf?teacher=' + profesor +'&dateOne=' + dateOne + '&dateTwo=' + dateTwo;
            @if (auth()->user()->role_id == '2')    
                let url = '/horarios/asistencia/pdf?dateOne=' + dateOne + '&dateTwo=' + dateTwo;
            @endif

            $(location).attr('href',url);
        });
        $('#dtr').daterangepicker({
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Do",
                    "Lu",
                    "Ma",
                    "Mi",
                    "Ju",
                    "Vi",
                    "Sa"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "firstDay": 1
            },
        }, function() {
        // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection