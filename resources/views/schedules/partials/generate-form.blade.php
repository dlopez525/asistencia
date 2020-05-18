<div class="row">
    <div class="col-4">
        <div class="form-group @error('name') has-danger @enderror">
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
        <div class="form-group @error('day') has-danger @enderror">
            {!! Form::label('day', 'Dias') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="ckbox">
                {!! Form::checkbox('l', '1') !!}<span>Lunes</span>
            </label>
        </div>
        <div class="form-group">
            <label class="ckbox">
                {!! Form::checkbox('m', '1') !!}<span>Martes</span>
            </label>
        </div>
        <div class="form-group">
            <label class="ckbox">
                {!! Form::checkbox('mi', '1') !!}<span>Miercoles</span>
            </label>
        </div>
        <div class="form-group">
            <label class="ckbox">
                {!! Form::checkbox('j', '1') !!}<span>Jueves</span>
            </label>
        </div>
        <div class="form-group">
            <label class="ckbox">
                {!! Form::checkbox('v', '1') !!}<span>Viernes</span>
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('time_from') has-danger @enderror">
            {!! Form::label('time_from', 'Hora Desde') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                {!! Form::text('time_from', null, ['class' => 'form-control', 'id' => 'datetimepicker3', 'required', 'data-target' => '#datetimepicker3']) !!}
                <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="typcn typcn-time"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group @error('time_from') has-danger @enderror">
            

            @error('time_from')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('hour') has-danger @enderror">
            {!! Form::label('time_to', 'Hora Hasta') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                {!! Form::text('time_to', null, ['class' => 'form-control', 'id' => 'datetimepicker4', 'required', 'data-target' => '#datetimepicker4']) !!}
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="typcn typcn-time"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group @error('time_to') has-danger @enderror">
            

            @error('time_to')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group @error('course') has-danger @enderror">
            {!! Form::label('course', 'Curso') !!}
            <span class="typcn typcn-warning tx-danger tx-16" data-toggle="tooltip" data-placement="top" data-original-title="Este campo es requerido"></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group @error('course') has-danger @enderror">
            {!! Form::text('course', null, ['class' => 'form-control', 'required']) !!}
            @error('course')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']); !!}
        <a href="{{ route('shedules.index') }}" class="btn btn-light">Cancelar</a>
    </div>
</div>