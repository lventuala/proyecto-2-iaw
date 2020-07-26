@extends('layouts.home')

@section('home_contenido')

<div class="container">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-header">
            Generar un nuevo pedido
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pedidos.store') }}">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Cantidad Maxima</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody id="body_list_producto">
                        @if (isset($productos) && ! empty($productos))
                                @csrf
                                @foreach ($productos as $p)
                                    <tr id="{{$p->id}}">
                                        <td>{{$p->nombre}}</td>
                                        <td>{{$p->descripcion}}</td>
                                        <td><img src="data:image/gif;base64,{{$p->img}}" class="img_Thumbnail"></td>
                                        <td>{{$p->cant_maxima}}</td>
                                        <td>
                                            <input
                                                name="productos[{{$p->id}}]"
                                                id="cantidad"
                                                type="number"
                                                placeholder="Cantidad..."
                                                class="form-control"
                                                onfocusout="reCalcularCantidad(this)"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                        @else
                            <p>No hay productos para mostrar</p>
                        @endif
                    </tbody>
                </table>

                @if (isset($productos) && ! empty($productos))
                    <button class="btn btn-primary">Generar Perido</button>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection

<script>

    function reCalcularCantidad() {
        console.log($(this));
    }

</script>

