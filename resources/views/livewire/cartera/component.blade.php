@section('migaspan')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="text-white" href="javascript:;">
                    <i class="ni ni-box-2"></i>
                </a>
            </li>
            <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                    href="{{ url('') }}">Inicio</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Gestion</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Cartera</h6>
    </nav>
@endsection


@section('empresacollapse')
    nav-link
@endsection


@section('empresaarrow')
    true
@endsection


@section('carteranav')
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
                        <h5 class="text-white" style="font-size: 16px">Carteras | Listado</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <button wire:click="Agregar()" class="btn btn-add "> <i class="fas fa-plus me-2"></i> Nueva
                                Cartera</button>

                            <a href="carteras" class="btn btn-secondary" data-type="csv" type="button">
                                <span style="margin-right: 7px;" class="btn-inner--text">Ir a Categoria
                                    Movimiento</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
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
                <div style="padding-left: 12px; padding-right: 12px;">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-sm text-center">NOMBRE</th>
                                        <th class="text-center text-uppercase text-sm  ps-2"> DESCRIPCION</th>
                                        <th class="text-center text-uppercase text-sm  ps-2">TIPO</th>
                                        <th class="text-center text-uppercase text-sm  ps-2">CAJA</th>
                                        <th class="text-center text-uppercase text-sm  ps-2">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->nombre }}
                                            </td>
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->descripcion }}
                                            </td>
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->tipo }}
                                            </td>
                                            {{-- <td>
                                                    {{ $item->telefonoNum }}
                                                </td> --}}
                                            <td class="text-xs mb-0 text-center">
                                                {{ $item->caja->nombre }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                    class="mx-3" title="Editar">
                                                    <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}','{{ $item->movimientos }}')"
                                                    class="mx-3" title="Borrar">
                                                    <i class="fas fa-trash text-default" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-5">

                {{ $data->links() }}
            </div>
        </div>
    </div>
    @include('livewire.cartera.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('alert', msg => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ya existe una cartera de Tipo "Efectivo" en esta caja'
            })
        });

        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('item-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('item-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
    });

    function Confirm(id, name, movimientos) {
        if (movimientos > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la cartera "' + name + '" porque tiene ' +
                    movimientos + ' transacciones.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Confirmar eliminar la cartera ' + '"' + name + '"?.',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>
