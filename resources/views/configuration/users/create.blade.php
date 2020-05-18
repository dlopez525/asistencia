@extends('layouts.azia')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Crear Usuario</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            {!! Form::open(['route' => ['users.store']]) !!}
                @include('configuration.users.partials.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection