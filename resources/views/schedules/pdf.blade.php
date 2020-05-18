<table border="0">
    <thead>
        <tr role="row">
            <th width="100px">Profesor</th>
            <th width="80px">Lunes</th>
            <th width="80px">Martes</th>
            <th width="80px">Miercoles</th>
            <th width="80px">Jueves</th>
            <th width="80px">Viernes</th>
            <th width="80px">Desde</th>
            <th width="80px">Hasta</th>
            <th width="80px">Curso</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
            <tr>
                <td>{{ $schedule->user->name }} {{ $schedule->user->lastname }}</td>
                <td>{{ $schedule->l ? 'Si' : '' }}</td>
                <td>{{ $schedule->m ? 'Si' : '' }}</td>
                <td>{{ $schedule->mi ? 'Si' : '' }}</td>
                <td>{{ $schedule->j ? 'Si' : '' }}</td>
                <td>{{ $schedule->v ? 'Si' : '' }}</td>
                <td>{{ $schedule->time_from }}</td>
                <td>{{ $schedule->time_to }}</td>
                <td>{{ $schedule->course }}</td>
            </tr>
        @endforeach
    </tbody>
</table>