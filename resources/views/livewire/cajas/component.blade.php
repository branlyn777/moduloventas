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
        <h6 class="font-weight-bolder mb-0 text-white">Cajas</h6>
    </nav>
@endsection


@section('empresacollapse')
    nav-link
@endsection


@section('empresaarrow')
    true
@endsection


@section('cajasnav')
    "nav-link active"
@endsection


@section('empresashow')
    "collapse show"
@endsection

@section('cajasli')
    "nav-item active"
@endsection





<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Listado de cajas</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <button wire:click="Agregar()" class="btn btn-add "> <i class="fas fa-plus me-2"></i> Nueva
                                Caja</button>

                            <a href="carteras" class="btn btn-secondary" data-type="csv" type="button">
                                <span style="margin-right: 7px;" class="btn-inner--text">Ir a Cartera</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
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
                                    <input type="text" wire:model="search" placeholder="nombre caja" class="form-control ">
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
                                    <th class="text-uppercase text-sm ps-2 text-left">SUCURSAL</th>
                                    <th class="text-uppercase text-sm ps-2 text-left"> ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="text-sm mb-0 text-left ">
                                            {{ $item->nombre }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $item->sucursal }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">

                                            
                                            @if($item->estado != "Inactivo")
                                                {{ $item->estado }}
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning">
                                                    INACTIVO
                                                </span>
                                            @endif


                                        </td>
                                        <td class="text-sm ps-0 text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $item->id }})"
                                                class="mx-3" title="Edit">
                                                <i class="fas fa-edit text-default" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $item->id }}','{{ $item->nombre }}','{{ $item->carteras->count() }}')"
                                                class="mx-3" title="Delete">
                                                <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="table-5">

                {{ $data->links() }}
            </div>
        </div>
    </div>
    @include('livewire.cajas.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

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

    function Confirm(id, name, carteras) {
        if (carteras > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la caja "' + name + '" porque tiene ' +
                    carteras + ' carteras.'
            })
            return;
        }


        swal({
            title: 'CONFIRMAR',
            text: '¿Confirmar eliminar la caja ' + '"' + name + '"?.',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
            }
        })
    }
</script>
