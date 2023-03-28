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
        <h6 class="font-weight-bolder mb-0 text-white">Nueva Orden de Servicio</h6>
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
        /* Estilos para la lista de marcas disponibles a elegir en la ventana modal editar */
        .product-search {
            position: relative;
        }
        #product-input {
            width: 100%;
            padding: 10px;
            /* font-size: 16px; */
        }
        #product-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        #product-list li {
            padding: 10px;
            cursor: pointer;
            font-size: 12px;
        }
        #product-list li:hover {
            background-color: #5e72e4;
            color: white;
        }
    </style>
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Nueva Órden de Servicio</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                        <button class="btn btn-add" wire:click="$emit('show-modalclient')">
                            Buscar/Crear Cliente
                        </button>
                        <button class="btn btn-warning" wire:click="ShowModalFastService()">
                            Servicio Rápido
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <span class="text-sm">
                                <b>Nombre Cliente:</b>
                            </span>
                            <div class="form-control">
                                Ejemplo
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <span class="text-sm">
                                <b>Tipo de Servicio:</b>
                            </span>
                            <select class="form-select">
                                <option value="normal">Normal</option>
                                <option value="domicilio">A Domicilio</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 text-center">
                            
                        </div>
                        <div class="col-12 col-md-3 text-end">
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success">PDF</button>
                                <button type="button" class="btn btn-success">SALIR</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.servicio.modal_search_create_client')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modalclient', msg => {
            $('#modalclient').modal('show')
        });
    });
</script>