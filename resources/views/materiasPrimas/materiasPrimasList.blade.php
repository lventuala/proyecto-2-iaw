<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Uni. Medida</th>
            <th scope="col">Cantidad Actual</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="body_list_mp">
        @isset($materias_primas)

            @forelse ($materias_primas as $mp)
                <tr id="{{$mp->id}}">
                    <td>{{$mp->nombre}}</td>
                    <td>{{$mp->categoria}}</td>
                    <td>{{$mp->uni_medida}}</td>
                    <td>{{$mp->cantidad}}</td>
                    <td>
                        <button class="btn btn-primary" onclick="abrirModificarMP(event,{{$mp->id}},'{{ route("materias-primas.edit",$mp->id) }}')">
                            <i class="material-icons md-18">edit</i>
                        </button>

                        <button class="btn btn-danger" onclick="eliminarMP({{$mp->id}},'{{ route("materias-primas.destroy",$mp->id) }}')">
                            <i class="material-icons md-18">delete</i>
                        </button>
                    </td>

                </tr>
            @empty
                <p>No hay materias primas</p>
            @endforelse
        @endisset
    </tbody>
</table>

{{ $materias_primas->links() }}

