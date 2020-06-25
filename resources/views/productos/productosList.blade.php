<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Imagen</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="body_list_producto">
        @isset($productos)

            @forelse ($productos as $p)
                <tr id="{{$p->id}}">
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->descripcion}}</td>
                    <td><img src="data:image/gif;base64,{{stream_get_contents($p->img)}}" class="img_Thumbnail"></td>
                    <td>
                        <button class="btn btn-primary" onclick="abrirModificarProducto(this,event,'{{ route("productos.edit",$p->id) }}')">
                            <i class="material-icons md-12">edit</i>
                        </button>



                        <button class="btn btn-danger" onclick="eliminarProducto({{$p->id}},'{{ route("productos.destroy",$p->id) }}')">
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

