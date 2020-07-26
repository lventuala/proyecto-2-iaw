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
    // ajax para paginacion
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        // armo la ruta para recuperar todas las materias primas
        var page = $(this).attr('href').split('page=')[1];
        var route = "{{ route('materias-primas.index') }}";

        paginacionProducto(route,page,'#list_ajax');
    });
</script>
@endsection









