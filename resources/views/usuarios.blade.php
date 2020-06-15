@extends('layouts.home')

@section('home_contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-5">

            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Nuevo Usuario
                </div>
                <div class="card-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" placeholder="Enter email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" placeholder="Enter password" id="pwd">
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox"> Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-12 col-md-7" style="background-color:green;"></div>
    </div>
</div>

@endsection
