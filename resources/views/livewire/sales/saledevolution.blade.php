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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ventas</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Devolución Ventas</h6>
    </nav>
@endsection


@section('userscollapse')
    nav-link
@endsection


@section('userarrow')
    true
@endsection


@section('usernav')
    "nav-link active"
@endsection


@section('usershow')
    "collapse show"
@endsection

@section('userli')
    "nav-item active"
@endsection






<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Lista de Devoluciones</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">

                        {{-- <button wire:click="Agregar()" class="btn btn-add mb-0"> <i class="fas fa-plus me-2"></i>
                            Nuevo Usuario
                        </button> --}}
                    </div>
                </div>
            </div>
            <br>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <span class="text-sm"><b>Buscar:</b></span>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search" placeholder="Buscar por Producto o Venta..." class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-center text-sm">Nº</th>
                                    <th class="text-uppercase text-center text-sm">Producto</th>
                                    <th class="text-uppercase text-center text-sm">Cantidad</th>
                                    <th class="text-uppercase text-center text-sm">Monto</th>
                                    {{-- <th class="text-uppercase text-center text-sm">Destino</th> --}}
                                    <th class="text-uppercase text-center text-sm">Sucursal</th>
                                    <th class="text-uppercase text-center text-sm">Fecha</th>
                                    <th class="text-uppercase text-center text-sm">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_devolutions as $d)
                                <tr>
                                    <td class="text-center text-sm">
                                        {{ ($list_devolutions->currentpage() - 1) * $list_devolutions->perpage() + $loop->index + 1 }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->name_product }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->quantity }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->amount }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->name_sucursal }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-center text-sm">
                                        <button class="btn btn-danger btn-sm">
                                            -
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $list_devolutions->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#formUsers').modal('hide');
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
        window.livewire.on('item-updated', Msg => {
            $('#formUsers').modal('hide')
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
        window.livewire.on('sucursal-actualizada', Msg => {
            $('#modal-details').modal('hide')
        })
        window.livewire.on('atencion', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'info',
                title: "¡No puedes eliminarte a ti mismo!",
                padding: '2em',
            })
        })
        window.livewire.on('item-deleted', Msg => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: "¡Acción realizada con éxito!",
                padding: '2em',
            })
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $("#im").val('')
            $('#formUsers').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#formUsers').modal('hide')
        })
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        });
        window.livewire.on('user-withsales', Msg => {
            noty(Msg)
        })
        window.livewire.on('user-fin', Msg => {
            $('#modal-details').modal('hide')
            noty(Msg)
        })
        window.livewire.on('show-modal2', Msg => {
            $('#modal-details').modal('show')
        })
    });

    function Confirm(id, name, venta, compra, transferencia, ingreso)
    {

        if (venta !== 0 || compra !== 0 || transferencia !== 0 || ingreso !== 0) {
            swal({
                title: '¿Inactivar al usuario "' + name + '"?',
                text: "El usuario " + name +
                    " no se puede eliminar, pasara a ser inactivado y bloqueado del sistema.",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Inactivar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                }
            })

        } else {
            swal({
                title: '¿Eliminar al usuario "' + name + '"?',
                text: "Eliminar al usuario " + name + " permanentemente del sistema.",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRowPermanently', id)
                }
            })


            //     const toast = swal.mixin({
            //     toast: true,    
            //     position: 'top-end',
            //     showConfirmButton: false,
            //     timer: 2500,
            //     padding: '2em'
            // });
            // toast({
            //     type: 'success',
            //     title: "Usuario eliminado exitosamente.",
            //     padding: '2em',
            // })

        }

    }
</script>
