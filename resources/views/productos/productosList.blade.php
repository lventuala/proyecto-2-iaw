<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Imagen</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="body_list_mp">
        @isset($productos)

            @forelse ($productos as $p)
                <tr id="{{$p->id}}">
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->descripcion}}</td>
                    <td><img src="data:image/gif;base64,{{stream_get_contents($p->img)}}" class="img_Thumbnail"></td>
                    <td>
                        <button class="btn btn-primary modi_producto">
                            <i class="material-icons md-12">edit</i>
                        </button>

                        <button class="btn btn-danger elim_producto">
                            <i class="material-icons md-12">delete</i>
                        </button>
                    </td>

                </tr>
            @empty
                <p>No hay materias primas</p>
            @endforelse
        @endisset
    </tbody>
</table>

{!! $productos->links() !!}

