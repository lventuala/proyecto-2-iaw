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
                    <x-mp-form :categorias="$categorias" :unidadMedida="$unidad_medida" >
                    </x-mp-form>
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

<div class="modal fade" id="id_mod_mp" tabindex="-1" role="dialog" aria-labelledby="lb_mod_mp" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Materia Prima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div id="mod_mp" class="modal-body">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="id_elim_mp" tabindex="-1" role="dialog" aria-labelledby="lb_elim_mp" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Materia Prima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div id="mod_mp" class="modal-body">
                <p>Se va a eliminar la Materia Prima seleccionada. Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <form id="form_elim_mp" method="POST">
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
<script >
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        // armo la ruta para recuperar todas las materias primas
        var page = $(this).attr('href').split('page=')[1];
        var route = "{{ route('materias-primas.index') }}";

        // recupero las materias primas
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

    // recupero informacion para editar la mp
    $(document).on('click', '.modi_mp', function(e) {
        e.preventDefault();

        // recupero id de la materia prima
        id = $(this).parent().parent().attr('id');

        // armo la ruta para recuperar la info
        var route = "{{ route('materias-primas.edit',':id') }}";
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

    // recupero informacion para eliminar la mp
    $(document).on('click', '.elim_mp', function(e) {
        id = $(this).parent().parent().attr('id');
        $('#id_elim_mp').modal('show');
        $('input[name=_id_elim]').val(id);

        var route = "{{ route('materias-primas.destroy',':id') }}";
        route = route.replace(':id',id.trim());

        $('#form_elim_mp').attr('action',route);

        $(document).on('click', '#btn_elim_confirmar', function(e) {
            $('#form_elim_mp').submit();
        });
    });

</script>
@endsection









