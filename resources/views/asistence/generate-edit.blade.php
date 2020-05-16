@extends('layouts.azia')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Editar Asistencia</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            {!! Form::model($schedule, ['route' => ['asistence.update', $schedule->id]]) !!}
                @include('asistence.partials.asistence')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $('#datetimepicker3').datetimepicker({
            format: 'LT',
            autoclose: true,
            icons: {
                time: 'typcn typcn-time',
                date: 'typcn typcn-calendar',
                up: 'typcn typcn-arrow-up-thick',
                down: 'typcn typcn-arrow-down-thick',
                previous: 'typcn typcn-arrow-left-thick',
                next: 'typcn typcn-arrow-right-thick',
                today: 'typcn typcn-calendar',
                clear: 'typcn typcn-trash',
                close: 'typcn typcn-delete'
            }
        });
        $('#datetimepicker4').datetimepicker({
            format: 'LT',
            autoclose: true,
            icons: {
                time: 'typcn typcn-time',
                date: 'typcn typcn-calendar',
                up: 'typcn typcn-arrow-up-thick',
                down: 'typcn typcn-arrow-down-thick',
                previous: 'typcn typcn-arrow-left-thick',
                next: 'typcn typcn-arrow-right-thick',
                today: 'typcn typcn-calendar',
                clear: 'typcn typcn-trash',
                close: 'typcn typcn-delete'
            }
        });
        $('#datetimepicker5').datetimepicker({
            format: 'L'
        });
    </script>
@endsection