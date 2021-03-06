@extends('layouts.azia')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="az-content-title">Editar Usuario</h2>
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
            {!! Form::model($role, ['route' => ['roles.update', $role->id]]) !!}
                @include('configuration.roles.partials.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection