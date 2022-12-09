@section('css')

<style>
    /* Estilos para las tablas */
    .table-wrapper {
    width: 100%;/* Anchura de ejemplo */
    height: 500px; /* Altura de ejemplo */
    overflow: auto;
    }

    .table-wrapper table {
        border-collapse: separate;
        border-spacing: 0;
        border-left: 0.3px solid #02b1ce;
        border-bottom: 0.3px solid #02b1ce;
        width: 100%;
    }

    .table-wrapper table thead {
        position: -webkit-sticky; /* Safari... */
        position: sticky;
        top: 0;
        left: 0;
    }
    .table-wrapper table thead tr {
    background: #02b1ce;
    color: white;
    }
    /* .table-wrapper table tbody tr {
        border-top: 0.3px solid rgb(0, 0, 0);
    } */
    .table-wrapper table tbody tr:hover {
        background-color: #ffdf76a4;
    }
    .table-wrapper table td {
        border-top: 0.3px solid #02b1ce;
        padding-left: 10px;
        border-right: 0.3px solid #02b1ce;
    }

</style>
@endsection





<div>
    <div class="d-sm-flex justify-content-between">
        <div class="col-12 col-sm-12 col-md-4">
            @include('common.searchbox')
        </div>
        <div class="nav-wrapper position-relative end-0">
            <button wire:click="Agregar()" class="btn btn-icon btn-outline-white ms-2 export" data-type="csv" 
            type="button">
            <span class="btn-inner--icon">
                <i class="ni ni-fat-add"></i>
            </span class="btn-inner--text"> Nuevo Catergoria</button>
        </div>
    </div>


        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                      <h6>Categoria Cartera Movimiento</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-xxs font-weight-bolder">No</th>
                              <th class="text-uppercase text-xxs font-weight-bolder ps-2">Nombre Categorhhia</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Detalles</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Tipo</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Estado</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Fecha Creación</th>
                              <th class="text-center text-uppercase text-xxs font-weight-bolder">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
        
        
        
                            @foreach ($data as $p)
                            <tr class="text-center">
                                <td class="text-xs mb-0 text-center">
                                    {{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}
                                </td>
                                <td class="text-xs mb-0 text-center">
                                    {{ $p->nombre }}
                                </td>
                                <td class="text-xs mb-0 text-center">
                                    {{ $p->detalle }}
                                </td>
                                <td class="text-xs mb-0 text-center">
                                    {{ $p->tipo }}
                                </td>
                                <td class="text-xs mb-0 text-center">
                                    @if($p->status == "ACTIVO")
                                    <div class="badge badge-sm bg-gradient-success"">
                                        {{ $p->status }}
                                    </div>
                                    @else
                                    <div class="badge badge-sm bg-gradient-danger">
                                        {{ $p->status }}
                                    </div>
                                    @endif
                                </td>
                                <td class="text-xs mb-0 text-center">
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        @if($p->status == "ACTIVO")


                                        <a href="javascript:void(0)"  wire:click.prevent="modaleditar({{$p->id}})" title="Editar Categoria" class="mx-3">
                                            <i class="fas fa-edit text-info" ></i>
                                          </a>                                          

                                        <a href="javascript:void(0)" onclick="ConfirmarAnular({{ $p->id }},'{{ $p->nombre }}')" title="Anular Categoria" type="button" class="boton-rojo">
                                            <i class="fas fa-trash text-danger" ></i>
                                          </a>
                                        @else
                                        <button wire:click.prevent="reacctivar({{$p->id}})" type="button" title="Reactivar Categoria" class="boton-plomo">
                                            <i class="fab fa-phabricator"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $data->links() }}
        @include('livewire.carteramovcategoria.modalnuevacategoria')

</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Mètodo JavaScript para llamar al modal para crear o actualizar categorias
        window.livewire.on('nuevacategoria-show', Msg => {
            $("#modalnuevacategoria").modal("show");
        });
        //Cierra la ventana Modal Buscar Cliente y muestra mensaje Toast cuando se selecciona un Cliente
        window.livewire.on('nuevacategoria-hide', msg => {
            $("#modalnuevacategoria").modal("hide");
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });


        //Mostrar Mensaje Toast de Éxito
        window.livewire.on('accion-ok', event => {
        swal(
            '¡Anulado!',
            'La Categoria: "'+ @this.mensaje_toast +'" fue anulado con éxito.',
            'success'
            )
        });


        window.livewire.on('accion-toast-ok', event => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });




    });





    // Código para lanzar la Alerta de Anulación de Servicio
    function ConfirmarAnular(id, nombrecategoria) {
        swal({
        title: '¿Anular la Categoria "' + nombrecategoria + '"?',
        text: "Nombre Categoria: " + nombrecategoria,
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Anular Categoria',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            window.livewire.emit('anularcategoria', id)
            }
        })
    }
    


</script>


<!-- Scripts para el mensaje de confirmacion arriba a la derecha 'Mensaje Toast' de Éxito y Alerta de Eliminacion -->
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<!-- Fin Scripts -->
@endsection
