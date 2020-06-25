
<form name="mp_form"
    @isset($data_mod)
        id="mp_form_modi" action="#" onsubmit="modificarMP(event,{{$data_mod->id}},'{{route("materias-primas.update",$data_mod->id)}}')"
    @else
        id="mp_form_alta" action="{{route('materias-primas.store')}}" method="POST"
    @endisset
>

    @isset($data_mod)
        @method('PUT')
    @endisset

    @csrf
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input
            name="nombre" type="text"
            placeholder="Ingrese el nombre" id="nombre" required
            value=@isset($data_mod) "{{$data_mod->nombre}}" @else "{{old('nombre')}}" @endisset
                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"

        >
        <div class="invalid-feedback">
            {{ $errors->first('nombre') }}
        </div>
    </div>
    <div class="form-group">
        <label for="categoria_mp_id">Categoria:</label>
        <select name="categoria_mp_id" id="categoria_mp_id" id="categoria_mp_id" value="{{old('categoria_mp_id')}}" required
            class="form-control {{ $errors->has('categoria_mp_id') ? 'is-invalid' : '' }}"
        >
            <option disabled selected value>Seleccione unidad de medida...</option>
            @foreach($categorias as $c)
                <option value="{{ $c->id }}" @isset($data_mod) @if($data_mod->categoria_mp_id == $c->id) selected  @endif @endisset>
                    {{$c->nombre}}
                </option>
            @endforeach

        </select>
        <div class="invalid-feedback">
            {{ $errors->first('uni-med') }}
        </div>
    </div>
    <div class="form-group">
        <label for="unidad_medida_id">Unidad de Medida:</label>
        <select
            name="unidad_medida_id"
            id="unidad_medida_id"
            value="{{old('unidad_medida_id')}}"
            class="form-control {{ $errors->has('unidad_medida_id') ? 'is-invalid' : '' }}"
            required
        >
            <option disabled selected value>Seleccione unidad de medida...</option>
            @foreach($unidad_medida as $um)
                <option value="{{ $um->id }}" @isset($data_mod) @if($data_mod->unidad_medida_id == $um->id) selected  @endif @endisset>
                        {{$um->descripcion}}
                </option>
            @endforeach

        </select>
        <div class="invalid-feedback">
            {{ $errors->first('uni-med') }}
        </div>
    </div>
    <div class="form-group">
        <label for="cantidad">Cantidad:</label>
        <input
            name="cantidad"
            id="cantidad"
            type="number"
            placeholder="Ingrese la cantidad"
            class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}"
            required
            value=@isset($data_mod) {{$data_mod->cantidad}} @else {{old('cantidad')}} @endisset
        >
        <div class="invalid-feedback">
            {{ $errors->first('cantidad') }}
        </div>
    </div>
    @isset($data_mod)
        <button id="btn-modificar-mp" class="btn btn-primary">Modificar</button>
        <button id="btn-cancelar-mp" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
    @else
        <button id="btn-aceptar-mp" class="btn btn-primary">Aceptar</button>
    @endisset
</form>
