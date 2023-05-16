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

@section('css')
<style>
    .btn-delete {
        background-color: red;
        border: 1px solid rgb(231, 124, 1);
        border-radius: 7px;
        color: white;
        padding: 2px 3px 4px 3px;
    }
    .btn-delete:hover {
        background-color: rgb(228, 73, 1);
        border: 1px solid rgb(231, 124, 1);
        border-radius: 7px;
        color: white;
    }
</style>
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
                        <div class="col-12 col-sm-6 col-md-3">
                            <span class="text-sm">Buscar:</span>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search" placeholder="Buscar por Producto o Venta..." class="form-control ">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <span class="text-sm">Fecha Desde:</span>
                            <input wire:model="dateFrom" class="form-control" type="date">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <span class="text-sm">Fecha Hasta:</span>
                            <input wire:model="dateTo" class="form-control" type="date">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <span class="text-sm">Sucursal</span>
                            <select wire:model="branch_id" class="form-select">
                                <option value="0">Todas</option>
                                @foreach ($this->list_branchs as $b)
                                <option value="{{$b->id}}">{{$b->name}}</option>
                                @endforeach
                            </select>
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
                                    <th class="text-uppercase text-center text-sm">Usuario</th>
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
                                    <td class="text-sm">
                                        {{ $d->name_product }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->quantity }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ number_format($d->amount, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->user }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $d->name_sucursal }}
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-center text-sm">
                                        <button class="btn-delete" onclick="Confirm({{$d->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                              </svg>
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

    function Confirm(id)
    {
        swal({
                title: '¿Inactivar la devolución?',
                text: "Se deshara todos los cambios como el egreso y el producto recibido",
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
    }
</script>
