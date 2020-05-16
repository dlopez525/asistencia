<table border="0">
    <thead>
        <tr role="row">
            <th width="150px">Profesor</th>
            <th width="120px">Fecha</th>
            <th width="120px">Entrada</th>
            <th width="120px">Salida</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
            <tr>
                <td>{{ $schedule->user->name }} {{ $schedule->user->lastname }}</td>
                <td>{{ date('d-m-Y', strtotime($schedule->date)) }}</td>
                <td>{{ $schedule->entry }}</td>
                <td>{{ $schedule->exit }}</td>
            </tr>
        @endforeach
    </tbody>
</table>