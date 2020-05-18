<div class="row">
    <div class="col-4">
        <div class="form-group @error('role') has-danger @enderror">
            {!! Form::label('role', 'Rol') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('role') has-danger @enderror">
            {!! Form::text('role', null, ['class' => 'form-control', 'required' => 'requried']) !!}
            @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']); !!}
        <a href="{{ route('roles.index') }}" class="btn btn-light">Cancelar</a>
    </div>
</div>