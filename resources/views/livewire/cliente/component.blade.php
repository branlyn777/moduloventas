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
        <h6 class="font-weight-bolder mb-0 text-white">Clientes</h6>
    </nav>
@endsection


@section('empresacollapse')
    nav-link
@endsection


@section('empresaarrow')
    true
@endsection


@section('clientesnav')
    "nav-link active"
@endsection


@section('empresashow')
    "collapse show"
@endsection

@section('carterali')
    "nav-item active"
@endsection



<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Listado de clientes</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <button wire:click="Agregar()" class="btn btn-add "> <i class="fas fa-plus me-2"></i> Nuevo
                                Cliente</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="col-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <h6>Buscar</h6>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre cliente" class="form-control ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>



            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">CÉDULA</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">CELULAR</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">EMAIL</th>
                                    {{-- <th class="text-uppercase text-sm ps-2 text-left">FECHA NACIM</th> --}}
                                    <th class="text-uppercase text-sm ps-2 text-left">NIT</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">DIRECCIÓN</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">RAZÓN SOCIAL</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">PROCEDENCIA</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $c)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->nombre }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->cedula }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->celular }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->email == null ? '--': $c->email}}
                                        </td>
                                        {{-- <td class="text-sm mb-0 text-left">
                                            {{ \Carbon\Carbon::parse($c->fecha_nacim)->format('d/m/Y') }}
                                        </td> --}}
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->nit == null ? '--': $c->nit }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{  substr($c->direccion, 0, 25) == null ? '--': substr($c->direccion, 0, 25) }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->razon_social == null ? '--': $c->razon_social}}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $c->procedencia }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            @if ($c->estado == 'ACTIVO')
                                                <span class="badge badge-sm bg-gradient-success">
                                                    ACTIVO
                                                </span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning">
                                                    INACTIVO
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-sm ps-0 text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $c->id }})"
                                                class="mx-3">
                                                <i class="fas fa-edit text-default"></i>
                                            </a>
                                            @if ($c->estado == 'ACTIVO')
                                            <a href="javascript:void(0)"
                                                wire:click="VerificarMovimientos({{ $c->id }})" class="mx-3"
                                                title="Eliminar Cliente">
                                                <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="max-width: 1rem;">
                        {{ $data->onEachSide(0)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.cliente.form')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide');
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
            $('#theModal').modal('hide')
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 500,
                padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        
        window.livewire.on('item-deleted', Msg => {
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
        window.livewire.on('item-error', Msg => {
            noty(Msg)
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('hide-modal', Msg => {
            $('#theModal').modal('hide')
        })

        window.livewire.on('eliminar-cliente', Msg => {
            swal({
                title: '¿Eliminar Cliente?',
                text: 'Se eliminará al cliente',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow')
                }
            })
        })

        window.livewire.on('inactivar-cliente', Msg => {
            swal({
                title: 'Inactivar Cliente?',
                text: 'Se inactivara al cliente',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Inactivar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('cancelRow')
                }
            })
        })
    });
</script>
