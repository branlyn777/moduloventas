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
        <h6 class="font-weight-bolder mb-0 text-white">Ordenes de Servicios</h6>
    </nav>
@endsection

@section('serviciocollapse')
    nav-link
@endsection

@section('servicioarrow')
    true
@endsection

@section('ordenservicionav')
    "nav-link active"
@endsection

@section('servicioshow')
    "collapse show"
@endsection

@section('ordenservicioli')
    "nav-item active"
@endsection


@section('css')
    <style>

    </style>
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px"></i>Nueva Órden de Servicio</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <button class="btn btn-add" wire:click="show_modal_service()">
                            Buscar/Crear Cliente
                        </button>

                        <a href="javascript:void(0)" class="btn btn-add mb-0" wire:click="modalswhow()">Agregar
                            Servicio</a>

                        <button class="btn btn-add mb-0" wire:click="ResetSession">Ir a Órdenes de Servicio</button>
                        <button class="btn btn-add mb-0" wire:click="ShowModalFastService()">Servicio Rápido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-12 col-md-3">
                    <h6>Cliente</h6>
                    <span class="text-sm">{{ $this->client_name  }}</span>
                </div>
                <div class="col-12 col-md-3">
                    <h6>Celular</h6>
                    <span class="text-sm">{{ $this->client_cell }}</span>
                </div>
                <div class="col-12 col-md-3">
                    <h6></h6>
                    <span class="text-sm"></span>
                </div>
                <div class="col-12 col-md-3">
                    <h6></h6>
                    <span class="text-sm"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-sm">
                            <td>#</td>
                            <td>EQUIPO</td>
                            <td>MARCA</td>
                            <td>DETALLE</td>
                            <td>ESTADO</td>
                            <td>TOTAL</td>
                            <td>A CUENTA</td>
                            <td>SALDO</td>
                            <td>ACCIONES</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->list_services as $s)
                        <tr class="text-sm">
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$s->name_cps}}
                            </td>
                            <td>
                                {{$s->mark}}
                            </td>
                            <td>
                                {{$s->detail}}
                            </td>
                            <td>
                                {{$s->type}}
                            </td>
                            <td>
                                {{$s->price_service}}
                            </td>
                            <td>
                                {{$s->on_account}}
                            </td>
                            <td>
                                {{$s->balance}}
                            </td>
                            <td>
                                <button wire:click.prevent="show_modal_service()" class="btn btn-primary btn-sm">
                                    Editar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('livewire.servicio.modal_service')
</div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            window.livewire.on('show-service', Msg => {
                $('#modalservice').modal('show')
            });
            window.livewire.on('hide-service', Msg => {
                $('#modalservice').modal('hide')
            });

        });
    </script>
@endsection
