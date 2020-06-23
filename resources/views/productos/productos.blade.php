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
                    {!! $view_list !!}
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="id_mod_producto" tabindex="-1" role="dialog" aria-labelledby="lb_mod_producto" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div id="mod_producto" class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="id_elim_producto" tabindex="-1" role="dialog" aria-labelledby="lb_elim_producto" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div id="elim_producto" class="modal-body">
                <p>Se va a eliminar el producto seleccionada. Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <form id="form_elim_producto" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="_id_elim">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_elim_confirmar">Si</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')

<script>
    // evento para manejo de paginacion por ajax
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        // armo la ruta para recuperar todas las materias primas
        var page = $(this).attr('href').split('page=')[1];
        var route = "{{ route('productos.index') }}";

        console.log("ROUTE = ", route);

        // recupero las materias primas
        $.ajax({
            url: route,
            data: {page:page},
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#list_ajax').html(data.view_list);
            }
        });
    });

    // evento para actualizar label de la imagen al dar de alta un producto
    $(document).on('change', '#in_imagen_prod', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $('#lbl_imagen').html(label);
    });

    $(document).on('change', '#in_imagen_prod_mod', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        $('#lbl_imagen_mod').html(label);
    });

    // actualizar imagen en el alta de un producto
    $("#in_imagen_prod").change(function() {
        readURL(this,"#img_upload");
    });

    // para actualizar la imagen al modificar un producto
    $(document).on('change', '#in_imagen_prod_mod', function() {
        readURL(this,"#img_upload_mod");
    });

    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // agrego una materia prima a la lista
    function agregarMPAlProducto(mod = false) {
        str_id = "#body_mp";
        if (mod) {
            str_id = "#body_mp_mod";
        }

        // recupero el ultimo id agregado -> es incremental
        var id = $(str_id).children().last().attr('id').replace('mp_tr_','');
        var new_id = Number(id) + 1;

        // recupero primer tr para hacer una copia
        var cant = $(str_id).children().length;
        var html = '<tr id="mp_tr_'+new_id+'">';
        html += $(str_id).children().first().html();

        // reemplazo por el nuevo id en todos lados donde figura 1
        html = html.replace(/mp\[1]/g,'mp['+new_id+']');
        html = html.replace(/mp\.1/g,'mp.'+new_id);
        html = html.replace(/mp_1/g,'mp_'+new_id);
        html = html.replace(/is-invalid/g,'');

        // armmo la fila y la agrego
        html += "</tr>";
/*
        if ( id_mp !== "" ) {
            html = html.replace('value="'+id_mp+'"', 'value="'+id_mp+'" selected');
        } else {
            html = html.replace(' selected','');
            html = html.replace('disabled','disabled selected');
        }
*/
        $(str_id).append(html);
/*
        if (mod) {
            $('#mp_'+new_id+'_cantidad_mod').val(cantidad);
        } else {
            $('#mp_'+new_id+'_cantidad').val(cantidad);
        }
*/

        // agrego boton para eliminar fila
        $(str_id).children().last().find('.td_button').html('<button type="button" class="btn btn-danger" onclick="eliminarMPDelProducto(this)">-</button>');
    }

    // elimino una materia prima de la lista
    function eliminarMPDelProducto(elem) {
        console.log($(elem).parent().parent());
        $(elem).parent().parent().remove();
    }

    // insertamos un producto en la base de datos (actualiza listado)
    function insertarProducto(e) {
        e.preventDefault();
        var route = "{{route('productos.store')}}";

        var fd = new FormData(document.getElementById('producto_form_alta'));
        fd.append('file_name',$('#lbl_imagen').html());

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
                $('#producto_form_alta').trigger("reset");
                $('#lbl_imagen').html('Seleccioanr imagen...');
                $('#img_upload').attr('src', '');

                // actualizo listado de productos
                $('#list_ajax').html(data.view_list);
            }
        }).fail( function(data) {
            console.log(data.responseJSON.errors);
            errors = data.responseJSON.errors;
            for (var err in errors) {
                $('#'+err.replace(/\./g,'_')).addClass('is-invalid');
                var id_error = '#'+err.replace(/\./g,'_')+'_err';
                $(id_error).html(errors[err][0]);
            }
        });
    }

    // mostrar panel para modificar un producto
    $(document).on('click', '.modi_producto', function(e) {
        e.preventDefault();

        // recupero id del producto
        id = $(this).parent().parent().attr('id');

        // armo la ruta para recuperar la info
        var route = "{{ route('productos.edit',':id') }}";
        route = route.replace(':id',id.trim());

        // recupero la vista con los campos para editar
        $.ajax({
            url: route,
            data: {},
            type: 'GET',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data) {
                // ciclo las materias primas cargadas para cargarlas en la interface
                var productos_mp = data.productos_mp;
                cant = productos_mp.length;
                for (var i = 0; i < cant; i++) {
                    var id = productos_mp[i].materia_prima_id;
                    var cantidad = productos_mp[i].cantidad;

                    if (i == 0) {
                            // agrego listado a interface (dejo el seteo del primer elemento para el final)
                            var html = data.view_form;
                            $('#mod_producto').html(html);
                            $('#id_mod_producto').modal('show');
                    } else {
                        agregarMPAlProducto(true);
                        $('#mp_'+(i+1)+'_materia_prima_id_mod').val(id);
                        $('#mp_'+(i+1)+'_cantidad_mod').val(cantidad);
                    }
                }

                // seteo primer elemento
                $('#mp_1_materia_prima_id_mod').val(productos_mp[0].materia_prima_id);
                $('#mp_1_cantidad_mod').val(productos_mp[0].cantidad);
            }
        });
    });

    function dataURIToBlob(dataURI) {
        dataURI = dataURI.replace(/^data:/, '');

        const type = dataURI.match(/image\/[^;]+/);
        const base64 = dataURI.replace(/^[^,]+,/, '');
        const arrayBuffer = new ArrayBuffer(base64.length);
        const typedArray = new Uint8Array(arrayBuffer);

        for (let i = 0; i < base64.length; i++) {
            typedArray[i] = base64.charCodeAt(i);
        }

        return new Blob([arrayBuffer], {type});
    }

// modifica el producto
function modificarProducto(e,id) {
        e.preventDefault();
        var route = "{{route('productos.update',':id')}}";
        route = route.replace(':id',id);

        var fd = new FormData(document.getElementById('producto_form_modi'));
        fd.append('file_name',$('#lbl_imagen_mod').html());
        var src_img = $('#img_upload_mod').attr('src');

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
                // actualizo info en la lista
                $('#body_list_producto > #'+id+' > td').eq(0).html(data.nombre);
                $('#body_list_producto > #'+id+' > td').eq(1).html(data.descripcion);
                $('#body_list_producto > #'+id+' > td > img').attr('src',src_img);

                // cierro modal
                $('#btn_cancelar_producto').click();
            }
        }).fail( function(data) {
            console.log(data.responseJSON.errors);
            errors = data.responseJSON.errors;
            for (var err in errors) {
                $('input[name='+err+']').addClass('is-invalid');
                //.invalid-feedback
                $('input[name='+err+']').parent().find('.invalid-feedback').html(errors[err]);
            }
        });

    }

    // recupero informacion para eliminar el producto
    $(document).on('click', '.elim_producto', function(e) {
        id = $(this).parent().parent().attr('id');
        $('#id_elim_producto').modal('show');
        $('input[name=_id_elim]').val(id);

        var route = "{{ route('productos.destroy',':id') }}";
        route = route.replace(':id',id.trim());

        $('#form_elim_producto').attr('action',route);

        $(document).on('click', '#btn_elim_confirmar', function(e) {
            $('#form_elim_producto').submit();
        });
    });


</script>

@endsection
