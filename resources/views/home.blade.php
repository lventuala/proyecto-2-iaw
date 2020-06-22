@extends('layouts.home')

@section('home_contenido')

    @if(Auth::user()->estado == 1)
        <p> El administrador no ha activado el usuario actual!!</p>
    @endif

@endsection
