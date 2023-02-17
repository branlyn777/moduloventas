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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Nivel Inventarios</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-white">Valuacion Inventarios</h6>
    </nav>
@endsection




@section('nivelinventariosnav')
    "nav-link active"
@endsection


@section('nivelinventariosli')
    "nav-item active"
@endsection


<div>
    <div class="row">
        <div class="col-12">

            <div class="d-lg-flex my-auto p-0 mb-3">
                <div>
                    <h5 class="text-white" style="font-size: 16px">Nivel de Inventarios</h5>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body m-0">
                    <div class="padding-left: 12px; padding-right: 12px;">
                        <div class="row justify-content-start">
                            <div class="col-12 col-md-6">
                                <div class="row justify-content-end">
    
                                    <div class="col">
                                        <h6>Fecha Inicio</h6>
                                        <div class="form-group">
                                            <input type="date" wire:model="fromDate" class="form-control">
                                        </div>
                                    </div>
    
                                    <div class="col">
                                        <h6>Fecha Fin</h6>
                                        <div class="form-group">
                                            <input type="date" wire:model="toDate" class="form-control">
                                        </div>
                                    </div>
    
                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">

                        <table class="table align-items-between">
                            <label class="text-left p-2" style="font-size: 14px">Producto: <label for="" style="font-size: 14px">{{$product_name}}</label> </label>
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-sm text-center">N°</th>
                              
                                    <th class="text-uppercase text-sm text-center">Movimiento</th>
                                    <th class="text-uppercase text-sm text-center">Fecha</th>
                                    <th class="text-uppercase text-sm text-center">Entrada</th>
                                    <th class="text-uppercase text-sm text-center">Salida</th>
                                    <th class="text-uppercase text-sm text-center">Cantidad</th>
                                    <th class="text-uppercase text-sm text-center">Costo Un.</th>
                                    <th class="text-uppercase text-sm text-center">Valor Entrada</th>
                                    <th class="text-uppercase text-sm text-center">Valor Salida</th>
                                    <th class="text-uppercase text-sm text-center">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @foreach ($data as $products)
                                    <tr style="font-size: 14px" class="mt-2">
                                        <td class="text-center">
                                            {{ $loop->index + 1 }}
                                        </td>

                                        <td>

                                            <label><strong>{{ $products->nombre }}({{ $products->codigo }})</strong>
                                            </label>

                                            <p class="text-xs">
                                                {{ $products->unidad }}|{{ $products->marca }}|{{ $products->industria }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($products->total_existencia, 0) }}
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($products->total_costo, 2) }}
                                        </td>

                                        <td class="text-sm align-middle text-center">
                                            <button type="button" class="btn btn-primary"
                                                wire:click="verKardex({{ $products->id }})" class="mx-3"
                                                title="Ver Kardex">
                                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                Ver Kardex
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach --}}

                            </tbody>


                            <tfoot>
{{-- 
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Total Inversion Bs.
                                    </td colspan="1">
                                    <td class="text-center">
                                        {{ number_format($data->sum('total_costo'), 2) }}
                                    </td>
                                </tr> --}}
                            </tfoot>

                        </table>


                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
