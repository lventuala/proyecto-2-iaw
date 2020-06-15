<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Uni. Medida</th>
            <th scope="col">Cantidad Actual</th>
        </tr>
    </thead>
    <tbody>
        @isset($materias_primas)

        @forelse ($materias_primas as $mp)
            <tr>
                <th scope="row"> {{$mp->id}} </th>
                <td>{{$mp->nombre}}</td>
                <td>{{$mp->uni_medida}}</td>
                <td>{{$mp->cantidad}}</td>
            </tr>
        @empty
            <p>No users</p>
        @endforelse
        @endisset
    </tbody>
</table>

{{ $materias_primas->links() }}
