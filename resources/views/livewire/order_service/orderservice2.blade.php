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
        /* Estilos para las tablas */
        .table-style {
            width: 100%;
            /* Altura de ejemplo */
            height: 500px;
            overflow: auto;
        }

        .table-style table {
            border-collapse: separate;
            border-spacing: 0;
            border-left: 0.3px solid #ffffff00;
            border-bottom: 0.3px solid #ffffff00;
            width: 100%;
        }

        .table-style table thead {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            left: 0;
        }

        .table-style table thead th {
            padding-top: 3px;
            padding-bottom: 10px;
        }

        .table-style table thead tr {
            background: #ffffff;
            color: rgb(0, 0, 0);
        }

        .table-style table tbody tr:hover {
            background-color: #8e9ce96c;
        }

        .table-style table td {
            border-top: 0.3px solid rgb(255, 255, 255);
            padding-left: 10px;
            border-right: 0.3px solid #ffffff00;
        }

        /* Estilos para el codigo de servicio */
        .code {
            padding-top: 0.3px;
            padding-bottom: 0.5px;
            padding-left: 4px;
            padding-right: 4px;
            background-color: #5e72e4;
            color: white;
            border-radius: 3px;
        }
    </style>
@endsection
<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Órdenes de Servicios</h5>
                </div>

                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <a class="btn btn-add mb-0">
                            <i class="fas fa-plus"></i>
                            Nueva Órden de Servicio
                        </a>
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="padding-left: 12px; padding-right: 12px;">

                        <div class="row justify-content-between">
                            <div class="mt-lg-0 col-md-3">
                                <label style="font-size: 1rem">Buscar</label>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        <input type="text" wire:model="search" placeholder="Nombre de Categoria"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <div class="table-style">
                            <table>
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-uppercase text-xs">#</th>
                                        <th class="text-uppercase text-xs">Código</th>
                                        <th class="text-uppercase text-xs">Fecha Recepción</th>
                                        <th class="text-uppercase text-xs">Fecha Estimada Entrega</th>
                                        <th class="text-uppercase text-xs">Responsable Técnico</th>
                                        <th class="text-uppercase text-xs">Servicios</th>
                                        <th class="text-uppercase text-xs">Precio</th>
                                        <th class="text-uppercase text-xs">Técnico Receptor</th>
                                        <th class="text-uppercase text-xs">Estado</th>
                                        <th class="text-uppercase text-xs">Editar</th>
                                        <th class="text-uppercase text-xs">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service_orders as $so)
                                        <tr class="text-center">
                                            <td>
                                                <span class="text-sm">
                                                    {{ ($service_orders->currentpage() - 1) * $service_orders->perpage() + $loop->index + 1 }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm code">
                                                    <b>{{ $so->code }}</b>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm">
                                                    {{ \Carbon\Carbon::parse($so->reception_date)->format('d/m/Y H:i') }}
                                                </span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-sm bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Opciones
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#">Imprimir</a></li>
                                                    <li><a class="dropdown-item" href="#">Modificar</a></li>
                                                    <li><a class="dropdown-item" href="#">Anular</a></li>
                                                    <li><a class="dropdown-item" href="#">Eliminar</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
