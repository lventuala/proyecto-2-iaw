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

// actualizar imagen en el alta de un producto
$("#in_imagen_prod").change(function(){
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
    console.log("ENTRA POR AGERGAR MP");
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

// insertamos un producto en la base de datos (actualiza listado)
function insertarProducto(e) {
    e.preventDefault();
    var route = "{{route('productos.store')}}";

    var fd = new FormData(document.getElementById('form_producto_insert'));

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
            $('#form_producto_insert').trigger("reset");
            $('#lbl_imagen').html('Seleccioanr imagen...');
            $('#img-upload').attr('src', '');

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
        dataType: 'html',
        success: function(data) {
            $('#mod_mp').html(data);
            $('#id_mod_mp').modal('show');
        }
    });
});


</script>

@endsection
