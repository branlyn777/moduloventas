@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-4 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Ingresos/Egresos Categoria</h6>
    </nav>
@endsection




@section('categoriaEI')
    "nav-link active"
@endsection

@section('categoriaIE')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Categoria Ingresos/Egresos</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <button wire:click="modalnuevacategoria()" class="btn btn-add "> <i
                                    class="fas fa-plus me-2"></i> Nueva Categoria</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex pt-4">
                        <div class="col-12 col-sm-12 col-md-3">
                            @include('common.searchbox')
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">NombreCategoria</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Detalles</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Tipo</th>
                                    <th class="text-uppercase text-sm ps-2 text-left"> Estado</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Fecha Creación</th>
                                    <th class="text-uppercase text-sm ps-2 text-center"> Acciones</th>
                                </tr>
                            </thead>
                            <tbody>



                                @foreach ($data as $p)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $p->nombre }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $p->detalle }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $p->tipo }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            @if ($p->status == 'ACTIVO')
                                                <div class="badge badge-sm bg-gradient-success"">
                                                    {{ $p->status }}
                                                </div>
                                            @else
                                                <div class="badge badge-sm bg-gradient-danger">
                                                    {{ $p->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-sm ps-0 text-center">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                @if ($p->status == 'ACTIVO')
                                                    <a href="javascript:void(0)"
                                                        wire:click.prevent="modaleditar({{ $p->id }})"
                                                        title="Editar Categoria" class="mx-3">
                                                        <i class="fas fa-edit text-default"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        onclick="ConfirmarAnular({{ $p->id }},'{{ $p->nombre }}')"
                                                        title="Anular Categoria" type="button">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" wire:click.prevent="reacctivar({{ $p->id }})" title="Reactivar Categoria" type="button">
                                                        <i class="fab fa-phabricator text-primary"></i>
                                                    </a>
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
            {{ $data->links() }}
        </div>
    </div>
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
                    timer: 2000,
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
                    'La Categoria: "' + @this.mensaje_toast + '" fue anulado con éxito.',
                    'success'
                )
            });


            window.livewire.on('accion-toast-ok', event => {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
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
