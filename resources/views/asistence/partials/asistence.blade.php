<div class="row">
    <div class="col-4">
        <div class="form-group @error('usr_id') has-danger @enderror">
            {!! Form::label('user_id', 'Profesor') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('user_id') has-danger @enderror">
            {!! Form::select('user_id', $teachers, null, ['class' => 'form-control', 'required']) !!}
            @error('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('date') has-danger @enderror">
            {!! Form::label('date', 'Fecha') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('date') has-danger @enderror">
                {!! Form::date('date', $date, ['class' => 'form-control', 'required']) !!}
            
            @error('date')
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
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                {!! Form::text('entry', null, ['class' => 'form-control', 'id' => 'datetimepicker4', 'required', 'data-target' => '#datetimepicker4']) !!}
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="typcn typcn-time"></i></div>
                </div>
            </div>
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
            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                {!! Form::text('exit', null, ['class' => 'form-control', 'id' => 'datetimepicker3', 'required', 'data-target' => '#datetimepicker3']) !!}
                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="typcn typcn-time"></i></div>
                </div>
            </div>
            @error('exit')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('assistance') has-danger @enderror">
            {!! Form::label('assistance', 'Estado de asistencia') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('assistance') has-danger @enderror">
            {!! Form::radio('assistance', '1', true) !!} <span>Asistió Puntual</span>
            {!! Form::radio('assistance', '2', true) !!} <span>Asistió No Puntual</span>
            {!! Form::radio('assistance', '3', true) !!} <span>No Asistió</span>
            @error('assistance')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']); !!}
        <a href="{{ route('asistence.index') }}" class="btn btn-light">Cancelar</a>
    </div>
</div>