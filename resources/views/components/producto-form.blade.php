<form id="form_producto_insert" onsubmit="insertarProducto(event)" action="#">
    @csrf

    <div class="row mb-3">

        <div class="col-12 col-md-4">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input name="nombre" type="text" placeholder="Ingrese el nombre" id="nombre"
                        class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                >
                <div id="nombre_err" class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" type="text" placeholder="Ingrese una descripcion" id="descripcion"
                        class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                ></textarea>
                <div id="descripcion_err" class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">

                <div class="custom-file">
                    <input name="imagen" type="file" class="custom-file-input" id="imagen" lang="es">
                    <label id="lbl_imagen" class="custom-file-label" for="validatedCustomFile">Seleccioanr imagen...</label>
                    <div class="invalid-feedback">La imagen es obligatoria</div>
                </div>

                <img style="width: 100%;" id='img-upload'/>

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
                                <th><button type="button" class="btn btn-primary" onclick="agregarMPAlProducto()"> + </button></th>
                            </tr>
                        </thead>
                        <tbody id="body_mp">
                            <tr id="mp_tr_1">
                                <td>
                                    <div class="form-group">
                                        <select
                                            id="mp_1_materia_prima_id"
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
                                        id="mp_1_cantidad"
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

    <button type="submit" class="btn btn-primary">
        Aceptar
    </button>
</form>

@section('script')
<script>
    $(document).on('change', '#imagen', function() {
		var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $('#lbl_imagen').html(label);

        input.trigger('fileselect', [label]);

        console.log(input);
    });

    $("#imagen").change(function(){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    // agrego una materia prima a la lista
    function agregarMPAlProducto() {
        // recupero el ultimo id agregado -> es incremental
        var id = $('#body_mp').children().last().attr('id').replace('mp_tr_','');
        var new_id = Number(id) + 1;

        // recupero primer tr para hacer una copia
        var cant = $('#body_mp').children().length;
        var html = '<tr id="mp_tr_'+new_id+'">';
        html += $('#body_mp').children().first().html();

        // reemplazo por el nuevo id en todos lados donde figura 1
        html = html.replace(/mp\[1]/g,'mp['+new_id+']');
        html = html.replace(/mp\.1/g,'mp.'+new_id);
        html = html.replace(/mp_1/g,'mp_'+new_id);
        html = html.replace(/is-invalid/g,'');

        // armmo la fila y la agrego
        html += "</tr>";
        $('#body_mp').append(html);

        // agrego boton para eliminar fila
        $('#body_mp').children().last().find('.td_button').html('<button type="button" class="btn btn-danger" onclick="eliminarMPDelProducto(this)">-</button>');
    }

    // elimino una materia prima de la lista
    function eliminarMPDelProducto(elem) {
        console.log($(elem).parent().parent());
        $(elem).parent().parent().remove();
    }


    function insertarProducto(e) {
        e.preventDefault();
        var route = "{{route('productos.store')}}";

        var fd = new FormData(document.getElementById('form_producto_insert'));
        //fd.append('imagen', $('#imagen')[0].files[0]);

        console.log($('#imagen')[0].files[0]);

        $('.is-invalid').removeClass('is-invalid');

        // ACTUALIZO DATOS
        $.ajax({
            url: route,
            //data: {'_method':'PUT','_token':csrf_token},
            data: fd,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
            }
        }).fail( function(data) {
            console.log(data.responseJSON.errors);
            errors = data.responseJSON.errors;
            for (var err in errors) {
                $('#'+err.replace(/\./g,'_')).addClass('is-invalid');




                var id_error = '#'+err.replace(/\./g,'_')+'_err';
                console.log(id_error);
                $(id_error).html(errors[err][0]);
            }
        });
    }

</script>
@endsection
