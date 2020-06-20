@extends('layouts.home')

@section('home_contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Nuevo Producto
                </div>
                <div class="card-body">

                    <x-producto-form :materiasPrimas=$materias_primas>
                    </x-producto-form>

                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Listado de Producto
                </div>

                <div id="list_ajax" class="card-body">
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
