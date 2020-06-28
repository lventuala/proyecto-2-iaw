@extends('layouts.home')

@section('home_contenido')

<div class="container">
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-header">
            Usuarios registrados:
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="body_list_mp">
                    @isset($usuarios)
                        @forelse ($usuarios as $u)
                            <tr>
                                <td>{{$u->nombre}}</td>
                                <td>{{$u->email}}</td>
                                <td> @if($u->esado == 0) Activo @else Pendiente @endif </td>
                                <td>
                                    @if($u->estado == 0)
                                        <form method="POST" action="{{ route('usuarios.desactivar',$u->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-danger modi_mp">
                                                Desactivar
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('usuarios.activar',$u->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-primary modi_mp">
                                                Activar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <p>No hay usuarios</p>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
