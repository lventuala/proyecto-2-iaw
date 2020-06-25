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
    // ajax para paginacion
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();

        // armo la ruta para recuperar todas las materias primas
        var page = $(this).attr('href').split('page=')[1];
        var route = "{{ route('productos.index') }}";

        paginacionProducto(route,page,'#list_ajax');
    });

</script>

@endsection
