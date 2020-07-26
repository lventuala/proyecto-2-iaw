@extends('layouts.home')

@section('home_contenido')

    @if(Auth::user()->estado == 1)
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Atención!</h4>
            <hr>

            <p>El administrador no ha activado tu usuario!!</p>
            <p>En cuanto lo haga vas a poder visualizar las funciones del sistemas.</p>
        </div>
    @else

        <div class="card shadow p-3 mb-5 bg-white rounded w-75 mx-auto">
            <div class="card-header">
                Información del usuario
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input
                            name="nombre" type="text"
                            placeholder=""
                            id="nombre"
                            value="{{ Auth::user()->nombre }}"
                            class="form-control"
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input
                            name="email" type="text"
                            placeholder=""
                            id="email"
                            value="{{ Auth::user()->email }}"
                            class="form-control"
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endif

@endsection
