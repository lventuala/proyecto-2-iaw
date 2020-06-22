@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-12 col-md-6">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Si ya sos usuario...
                </div>
                <div class="card-body">
                    <x-login>
                    </x-login>
                </div>

            </div>
        </div>
        <div class="col-12 col-md-6">

                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        Registrate!
                    </div>
                    <div class="card-body">
                        <x-registro>
                        </x-registro>
                    </div>

                </div>


        </div>
    </div>
</div>
@endsection
