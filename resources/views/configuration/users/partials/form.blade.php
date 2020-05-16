<div class="row">
    <div class="col-4">
        <div class="form-group @error('name') has-danger @enderror">
            {!! Form::label('name', 'Nombre') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('name') has-danger @enderror">
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'requried']) !!}
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('lastname') has-danger @enderror">
            {!! Form::label('lastname', 'Apellidos') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('lastname') has-danger @enderror">
            {!! Form::text('lastname', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('lastname')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('email') has-danger @enderror">
            {!! Form::label('email', 'Email') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('email') has-danger @enderror">
            {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('role_id') has-danger @enderror">
            {!! Form::label('role', 'Role') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('role_id') has-danger @enderror">
            {!! Form::select('role_id', $roles, null, ['class' => 'form-control', 'required']) !!}
            @error('role_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group">
            {!! Form::label('password', 'Contraseña') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @error('role_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']); !!}
        <a href="{{ route('users.index') }}" class="btn btn-light">Cancelar</a>
    </div>
</div>