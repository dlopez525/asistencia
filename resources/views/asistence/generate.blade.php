@extends('layouts.azia')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Agregar Asistencia</h2>
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
            {!! Form::open(['route' => ['asistence.store']]) !!}
                @include('asistence.partials.asistence')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
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
            format: 'D-M-YYYY'
        });
    </script>
@endsection