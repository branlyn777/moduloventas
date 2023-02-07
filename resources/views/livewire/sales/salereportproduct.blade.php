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
        <h6 class="font-weight-bolder mb-0 text-white"> Productos mas vendidos </h6>
    </nav>
@endsection


@section('Reportescollapse')
    nav-link
@endsection


@section('Reportesarrow')
    true
@endsection


@section('productosmasvendidosnav')
    "nav-link active"
@endsection


@section('Reportesshow')
    "collapse show"
@endsection

@section('productosmasvendidosli')
    "nav-item active"
@endsection




<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex" style="margin-bottom: 2.3rem">
                <h5 class="text-white" style="font-size: 16px">Productos Mas Vendidos </h5>
                
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Buscar
                            </h6>
                            <div class="form-group">


                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></span>
                                    <input wire:model="search" placeholder="Ingrese Nombre o código"
                                        class="form-control">
                                </div>


                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Seleccionar Sucursal
                            </h6>
                            <div class="form-group">
                                <select wire:model="sucursal_id" class="form-select">
                                    @foreach ($this->listasucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                                    @endforeach
                                    <option value="Todos">Todas las Sucursales</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Seleccionar Usuario
                            </h6>
                            <div class="form-group">
                                <select wire:model="user_id" class="form-select">
                                    <option value="Todos" selected>Todos</option>
                                    @foreach ($this->listausuarios as $u)
                                        <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Categoria
                            </h6>
                            <div class="form-group">
                                <select wire:model="categoria_id" class="form-select">
                                    <option value="Todos" selected>Todos</option>
                                    @foreach ($this->lista_categoria as $c)
                                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->name)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Fecha Inicio
                            </h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateFrom" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2 text-left">
                            <h6 class="mb-0">
                                Fecha Fin
                            </h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateTo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>



                <center>
                    <div id="preloader_3" wire:loading.delay.longest>


                        <div class="lds-roller">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>


                    </div>
                </center>
            </div>

            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">No</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Producto</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Código Producto</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Cantidad</th>
                                    <th class="text-uppercase text-sm ps-2 text-left">Total Bs</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabla_productos->sortByDesc('cantidad_vendida') as $t)
                                    <tr class="text-left">
                                        <td class="text-sm mb-0 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $t->nombre_producto }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $t->codigo_producto }}
                                        </td>
                                        <td class="text-sm mb-0 text-left">
                                            {{ $t->cantidad_vendida }}
                                        </td>
                                        <td>

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
