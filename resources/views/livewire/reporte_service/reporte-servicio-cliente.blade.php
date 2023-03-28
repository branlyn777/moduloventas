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
        <h6 class="font-weight-bolder mb-0 text-white">OrdenServicioCliente</h6>
    </nav>
@endsection

@section('serviciocollapse')
    nav-link
@endsection


@section('servicioarrow')
    true
@endsection


@section('ordenserviClinav')
    "nav-link active"
@endsection


@section('servicioshow')
    "collapse show"
@endsection

@section('reporteserviciocostoli')
    "nav-item active"
@endsection

<div>
    <div class="row">
        <div class="col-12">
            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class=" text-white" style="font-size: 16px">Orden Servicio Cliente</h5>
                </div>
                <div class="ms-auto my-auto mt-lg-1">
                    <div class="ms-auto my-auto">
                        <button wire:click.prevent="generateexcel()" class="btn btn-success mb-0 text-white" type="button">
                            Generar EXCEL2
                        </button>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Seleccionar Procedencia</h6>
                            <div class="form-group">
                                <select wire:model="procedencia_id" class="form-select">
                                    <option value="Todos">Todas las Precedencias</option>
                                    @foreach ($this->listaprodencias as $s)
                                        <option value="{{ $s->id }}">{{ $s->procedencia }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Fecha Inicio</h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateFrom" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-2">
                            <h6>Fecha Fin</h6>
                            <div class="form-group">
                                <input type="date" wire:model="dateTo" class="form-control">
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-2">
                            <h4>TOTAL:</h4>
                            <div class="form-group">
                                <p> {{ $clients->total()}}</p>
                            </div>
                        </div>
                       
                        
                        
                        
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Clientes</th>
                                        <th scope="col">Celulaar</th>
                                        <th scope="col">Procedencia</th>
                                        <th scope="col">fecha de creacion</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($clients as $c)
                                        <tr>
                                            <td width="2%">
                                                <h6 class="text-center"
                                                    style="font-size: 90%; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0">
                                                    {{ ($clients->currentpage() - 1) * $clients->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td>

                                                @if ($c->nombre)
                                                    {{ $c->nombre }}
                                                @else
                                                    <p>sin nombre</p>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $c->celular }}

                                            </td>
                                            <td>
                                                {{ $c->procedencia }}
                                            </td>
                                            <td>
                                                {{ $c->created_at }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $clients->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          

        </div>
    </div>

</div>