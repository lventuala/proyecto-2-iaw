<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Imagen</th>
        </tr>
    </thead>
    <tbody>
        @isset($productos)
            @foreach($productos as $producto)
                <tr>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->descripcion}}</td>
                    <td><img src="data:image/gif;base64,{{$producto->img}}" class="img_Thumbnail"></td>
                </tr>
            @endforeach
        @endisset
    </tbody>
</table>
