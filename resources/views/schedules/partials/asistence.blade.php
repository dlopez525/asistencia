<div class="row">
    <div class="col-4">
        <div class="form-group @error('name') has-danger @enderror">
            {!! Form::label('teacher_id', 'Profesor') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('teacher_id') has-danger @enderror">
            {!! Form::select('teacher_id', $teachers, null, ['class' => 'form-control', 'required']) !!}
            @error('teacher_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('entry') has-danger @enderror">
            {!! Form::label('entry', 'Hora Ingreso') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('entry') has-danger @enderror">
            {!! Form::text('entry', null, ['class' => 'form-control dtp', 'required']) !!}
            @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('exit') has-danger @enderror">
            {!! Form::label('exit', 'Hora Salida') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('exit') has-danger @enderror">
            {!! Form::text('exit', null, ['class' => 'form-control dtp', 'required']) !!}
            @error('exit')
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