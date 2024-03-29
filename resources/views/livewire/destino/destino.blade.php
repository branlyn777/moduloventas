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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Inventarios</li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Parámetros</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Almacenes</h6>
    </nav>
@endsection


@section('Gestionproductoscollapse')
    nav-link
@endsection


@section('Gestionproductosarrow')
    true
@endsection


@section('destinonav')
    "nav-link active"
@endsection


@section('Gestionproductosshow')
    "collapse show"
@endsection

@section('parametrocollapse')
    nav-link
@endsection


@section('parametroarrow')
    true
@endsection

@section('parametroshow')
    "collapse show"
@endsection

@section('destinoli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Lista Almacenes</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0" wire:click="modalestancia()"><i class="fas fa-plus"></i> Nuevo
                            Almacen </a>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body  p-4">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <h6>Buscar</h6>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="Buscar por nombre de destino"
                                        class="form-control ">
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <h6>Filtrar por Estado</h6>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" wire:change="cambioestado()" type="checkbox"
                                            role="switch" {{ $this->estados == true ? 'checked' : '' }}>
                                        @if ($estados)
                                            <label
                                                style="font-size: 16px;
                                            font-weight: 400;
                                            line-height: 1.7;
                                            margin:0px 0.9rem;
                                            align-self: left;
                                            color: #525f7f;">ACTIVO</label>
                                        @else
                                            <label
                                                style="font-size: 16px;
                                            font-weight: 400;
                                            line-height: 1.7;
                                            margin:0px 0.9rem;
                                            align-self: left;
                                            color: #525f7f;">INACTIVO</label>
                                        @endif
                                    </div>

                                    {{-- <select wire:model='estados' class="form-select">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                        <option value="TODOS">TODOS</option>
                                    </select> --}}

                                </div>
                                <div class="col-md-5">
                                    <h6>Seleccionar Sucursal</h6>
                                    <select wire:model='sucursal_id' class="form-select">
                                        @foreach ($sucursales as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                        <option value="Todos">Todas las Sucursales</option>
                                    </select>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-left mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                                    <th class="text-uppercase text-sm ps-2">CODIGO</th>

                                    <th class="text-uppercase text-sm ps-2">NOMBRE</th>
                                    <th class="text-uppercase text-sm ps-2">OBSERVACIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">SUCURSAL</th>
                                    <th class="text-uppercase text-sm ps-2">FECHA CREACIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">FECHA ACTUALIZACIÓN</th>
                                    <th class="text-uppercase text-sm ps-2">ESTADO</th>
                                    <th class="text-uppercase text-sm text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($destinos as $d)
                                    @if ($d->venta == 'No')
                                        <tr>
                                            <td>
                                                <p class="text-sm mb-0 text-center">
                                                    {{ ($destinos->currentpage() - 1) * $destinos->perpage() + $loop->index + 1 }}
                                                </P>
                                            </td>
                                            <td>
                                                <P class="text-sm mb-0 text-left">
                                                    {{ $d->codigo_almacen ?? 's/n' }}
                                                </P>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ $d->nombredestino }}
                                                </p>

                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ substr($d->observacion, 0, 58) }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ $d->nombresucursal }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($d->creacion)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($d->actualizacion)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>
                                            <td>
                                                @if ($d->estado == 'ACTIVO')
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $d->estado }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-sm bg-gradient-danger">{{ $d->estado }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $d->iddestino }})"
                                                    class="mx-3" class="boton-azul" title="Editar Estancia">
                                                    <i class="fas fa-edit" style="font-size: 14px"></i>
                                                </a>




                                                @if ($d->estado == 'ACTIVO')
                                                    <a href="javascript:void(0)"
                                                        onclick="Confirm('{{ $d->iddestino }}','{{ $d->nombredestino }}')"
                                                        class="boton-rojo mx-3" title="Anular Estancia">
                                                        <i class="fas fa-trash text-danger" style="font-size: 14px"></i>
                                                    </a>
                                                @endif




                                            </td>
                                        </tr>
                                    @else
                                        <tr style="background-color: #ececec">
                                            <td class="align-middle text-center">
                                                {{ ($destinos->currentpage() - 1) * $destinos->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ $d->codigo_almacen ?? 's/n' }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ $d->nombredestino }}
                                                </p>

                                            </td>

                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ substr($d->observacion, 0, 58) }}
                                                </p>

                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ $d->nombresucursal }}
                                                </p>

                                            </td>

                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($d->creacion)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-sm mb-0 text-left">
                                                    {{ \Carbon\Carbon::parse($d->actualizacion)->format('d/m/Y H:i') }}
                                                </p>
                                            </td>
                                            <td>
                                                @if ($d->estado == 'ACTIVO')
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $d->estado }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-sm bg-gradient-danger">{{ $d->estado }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $d->iddestino }})"
                                                    class="mx-3" class="boton-azul" title="Editar Estancia">
                                                    <i class="fas fa-edit" style="font-size: 14px"></i>
                                                </a>
                                                {{-- <button wire:click="Edit({{ $d->iddestino }})" class="boton-celeste" title="Editar Estancia">
                                                            <i class="fas fa-edit"></i>
                                                        </button> --}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $destinos->links() }}
        </div>
    </div>

    @include('livewire.destino.form')
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('unidad-added', Msg => {
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
        window.livewire.on('unidad-updated', Msg => {
            $('#theModal').modal('hide')
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
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });

        window.livewire.on('unidad-deleted', Msg => {
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

    function Confirm(id, nombre) {
        swal({
            title: 'CONFIRMAR',
            type: 'warning',
            text: 'Confirmar eliminar el destino ' + '"' + nombre + '"',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>