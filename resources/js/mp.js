// evento para manejo de paginacion por ajax
window.paginacionMP = function (route,page,id_update) {
    $.ajax({
        url: route,
        data: {page:page},
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $(id_update).html(data.view_list);
        }
    });
}

// recupero informacion para editar la mp
window.abrirModificarMP = function(event,id,route) {
    event.preventDefault();

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
};

// modificar una materia prima
window.modificarMP = function (e,id,route) {
    e.preventDefault();

    var fd = new FormData(document.getElementById('mp_form_modi'));

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
            $('#body_list_mp > #'+id+' > td').eq(0).html(data.nombre);
            $('#body_list_mp > #'+id+' > td').eq(1).html(data.categoria);
            $('#body_list_mp > #'+id+' > td').eq(2).html(data.uni_medida);
            $('#body_list_mp > #'+id+' > td').eq(3).html(data.cantidad);

            // cierro modal
            $('#btn-cancelar-mp').click();
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

// recupero informacion para eliminar la mp
//$(document).on('click', '.elim_mp', function(e) {
window.eliminarMP = function (id,route) {
    $('#id_elim_mp').modal('show');
    $('input[name=_id_elim]').val(id);

    //var route = "{{ route('materias-primas.destroy',':id') }}";
    //route = route.replace(':id',id.trim());

    console.log(route);

    $('#form_elim_mp').attr('action',route);

    $(document).on('click', '#btn_elim_confirmar', function(e) {
        $('#form_elim_mp').submit();
    });
};

