@extends('layouts.home')

@section('home_contenido')



<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-5">

            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Nueva Materia Prima
                </div>
                <div class="card-body">
                    <form id="myForm" method="POST" action=" {{route('materias-primas.store')}} ">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input name="nombre" type="text" placeholder="Ingrese el nombre" id="nombre" value="{{old('nombre')}}"  required
                                    class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
                            <select name="categoria_mp_id" id="sel1" id="categoria" value="{{old('categoria')}}" required
                                class="form-control {{ $errors->has('categoria') ? 'is-invalid' : '' }}"
                            >
                                <option disabled selected value>Seleccione unidad de medida...</option>
                                @foreach($categorias as $c)
                                    <option value="{{ $c->id }}"> {{$c->nombre}} </option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('uni-med') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidad_medida_id">Unidad de Medida:</label>
                            <select name="unidad_medida_id" id="sel1" id="unidad_medida_id" value="{{old('unidad_medida_id')}}" required
                                class="form-control {{ $errors->has('unidad_medida_id') ? 'is-invalid' : '' }}"
                            >
                                <option disabled selected value>Seleccione unidad de medida...</option>
                                @foreach($unidad_medida as $um)
                                    <option value="{{ $um->id }}"> {{$um->descripcion}} </option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('uni-med') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad Inicial:</label>
                            <input name="cantidad" type="number" placeholder="Ingrese la cantidad" id="cantidad" value="{{old('cantidad')}}" required
                                class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}"
                            >
                            <div class="invalid-feedback">
                                {{ $errors->first('cantidad') }}
                            </div>
                        </div>
                        <button id="btn-aceptar-mp" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-12 col-md-7">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Listado de Materias Primas
                </div>

                <div id="list_ajax" class="card-body">
                    {!! $view_list !!}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script >
    $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            var route = "{{ route('materias-primas.index') }}";

            $.ajax({
                url: route,
                data: {page:page},
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#list_ajax').html(data.view_list);
                }
            });
        });
</script>
@endsection









