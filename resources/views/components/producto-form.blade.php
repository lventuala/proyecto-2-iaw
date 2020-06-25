<form
    @isset($producto)
        id="producto_form_modi" action="#" onsubmit="modificarProducto(this,event,{{$producto->id}},'{{ route("productos.update",$producto->id) }}')"
    @else
        id="producto_form_alta" action="#" onsubmit="insertarProducto(event,'{{route("productos.store")}}')"
    @endisset
>

    @isset($producto)
        @method('PUT')
    @endisset

    @csrf

    <div class="row mb-3">

        <div class="col-12 col-md-4">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input
                    name="nombre"
                    type="text"
                    placeholder="Ingrese el nombre"
                    id="nombre"
                    value="@isset($producto){{$producto->nombre}}@else{{old('nombre')}}@endisset"
                    class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                    required
                >
                <div id="nombre_err" class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <textarea
                    name="descripcion"
                    type="text"
                    placeholder="Ingrese una descripcion" id="descripcion"
                    class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                    required
                >@isset($producto){{$producto->descripcion}}@else{{old('descripcion')}}@endisset</textarea>
                <div id="descripcion_err" class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">

                <div class="custom-file">
                    <input
                        @isset($producto)
                            id="in_imagen_prod_mod"
                            onchange="actualizaLabelImagen(this,'#lbl_imagen_mod','#img_upload_mod')"
                        @else
                            id="in_imagen_prod"
                            onchange="actualizaLabelImagen(this,'#lbl_imagen','#img_upload')"
                            required
                        @endisset
                        name="imagen"
                        type="file"
                        class="custom-file-input" lang="es"
                        value="----"
                    >
                    <label
                        @isset($producto)
                            id="lbl_imagen_mod"
                        @else
                            id="lbl_imagen"
                        @endisset
                        class="custom-file-label"
                        for="validatedCustomFile">@isset($producto) {{$producto->nombre_img}} @else Seleccioanr imagen...@endisset</label>
                    <div class="invalid-feedback">La imagen es obligatoria</div>
                </div>

                <img
                    style="width: 100%;"
                    @isset($producto)
                        id='img_upload_mod'
                        src="data:image/gif;base64,{{stream_get_contents($producto->img)}}"
                    @else
                        id='img_upload'
                    @endisset
                />

            </div>

        </div>

        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    Listado de Materias Primas <small>(agregar 1 o mas mp)</small>
                </div>
                <div class="card-body">
                    <table name="tbl_materias_primas" class="table table-striped table-bordered table-s" >
                        <thead>
                            <tr>
                                <th class="w-75" scope="col">MP | Uni. Medida</th>
                                <th class="w-25" scope="col">Cantidad</th>
                                <th><button type="button" class="btn btn-primary" @isset($producto) onclick="agregarMPAlProducto(true)" @else onclick="agregarMPAlProducto()" @endisset> + </button></th>
                            </tr>
                        </thead>
                        <tbody @isset($producto) id="body_mp_mod" @else id="body_mp" @endisset>
                            <tr id="mp_tr_1">
                                <td>
                                    <div class="form-group">
                                        <select
                                            @isset($producto)id="mp_1_materia_prima_id_mod" @else id="mp_1_materia_prima_id" @endisset
                                            name="mp[1][materia_prima_id]"
                                            value="{{old('mp.1.materia_prima_id')}}"
                                            class="form-control"
                                        >
                                            <option disabled @empty(old('mp.1.materia_prima_id')) selected value @endempty >Seleccione una mp...</option>
                                            @foreach($materias_primas as $mp)
                                                <option value="{{ $mp->id }}"  @if(old('mp.1.materia_prima_id') == $mp->id) selected @endif>
                                                        {{$mp->nombre}} | {{$mp->uni_medida}}
                                                </option>
                                            @endforeach

                                        </select>

                                        <div id="mp_1_materia_prima_id_err" class="invalid-feedback">
                                            El campo MP es obligatorio
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input
                                        @isset($producto) id="mp_1_cantidad_mod" @else id="mp_1_cantidad" @endisset
                                        name="mp[1][cantidad]"
                                        class="form-control {{ $errors->has('mp.1.cantidad') ? 'is-invalid' : '' }}"
                                        value="{{old('mp.1.cantidad')}}"
                                        type="number"
                                        step="0.1"
                                    >

                                        <div id="mp_1_cantidad_err" class="invalid-feedback">
                                            El campo cantidad es obligatorio
                                        </div>
                                    </div>
                                </td>
                                <td class="td_button">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @isset($producto)
        <button type="submit" class="btn btn-primary">Modificar</button>
        <button id="btn_cancelar_producto" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
    @else
        <button type="submit" class="btn btn-primary">Aceptar</button>
    @endisset
</form>




