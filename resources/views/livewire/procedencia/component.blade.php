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
        <h6 class="font-weight-bolder mb-0 text-white"> Procedencia Clientes </h6>
    </nav>
@endsection


@section('empresacollapse')
    nav-link
@endsection


@section('empresaarrow')
    true
@endsection


@section('procedientesclientenav')
    "nav-link active"
@endsection


@section('empresashow')
    "collapse show"
@endsection

@section('procedientesclienteli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12 ">
            <div class="card-header pt-0 mb-4">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Listado de procedencias</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">

                            <button wire:click="Agregar()" class="btn btn-add "> <i class="fas fa-plus me-2"></i> Nuevo
                                Procedencia</button>

                            <a href="clientes" class="btn btn-secondary" data-type="csv" type="button">
                                <span style="margin-right: 7px;" class="btn-inner--text">Ir a Clientes</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <h6>Buscar</h6>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model="search" placeholder="nombre procedencia"
                                        class="form-control ">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 " style="margin-bottom: 7px;">
                            <label style="font-size: 1rem">Filtrar por Estado</label>
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
                                        color: #525f7f;">Activos</label>
                                @else
                                    <label
                                        style="font-size: 16px;
                                        font-weight: 400;
                                        line-height: 1.7;
                                        margin:0px 0.9rem;
                                        align-self: left;
                                        color: #525f7f;">Inactivos</label>
                                @endif
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>

            <br>


            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">Nº</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">PROCEDENCIA</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">ESTADO</th>
                                    <th class="text-uppercase text-sm ps-2 text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $item)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            <p class="text-sm mb-0 text-left">{{ $item->procedencia }}</p>
                                        </td>

                                        <td>
                                            <p class="text-sm mb-0 text-left">{{ $item->estado }}</p>
                                        </td>

                                        <td class="text-sm ps-0 text-center">
                                            <a href="javascript:void(0)"
                                                wire:click.prevent="Edit('{{ $item->id }}')" class="mx-3">
                                                <i class="fas fa-edit text-default"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="Confirm('{{ $item->id }}','{{ $item->procedencia }}')"
                                                class="mx-3" title="Delete">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.procedencia.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide'),
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
        window.livewire.on('hidden.bs.modal', function(e) {
            $('.er').css('display', 'none')
        });

        window.livewire.on('alerta-procedencia', Msg => {
            Swal.fire(
                'Atención',
                'No se puede eliminar la procedencia por que tiene clientes asociados',
                'info'
            )
        })


    });

    function Confirm(id, name) {
        swal({
            title: 'CONFIRMAR',
            text: "Confirmar eliminar el prouducto  + " + name + "'",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
            }
        })
    }
</script>
