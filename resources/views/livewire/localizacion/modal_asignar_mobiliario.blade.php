<style>
    .vertical-scrollable>.row {
        position: absolute;
        top: 120px;
        bottom: 100px;
        left: 180px;
        width: 50%;
        overflow-y: scroll;
    }

    .col-sm-8 {
        color: white;
        font-size: 24px;
        padding-bottom: 20px;
        padding-top: 18px;
    }

    .col-sm-8:nth-child(2n+1) {
        background: green;
    }

    .col-sm-8:nth-child(2n+2) {
        background: black;
    }

    table.borderless td,
    table.borderless th {
        border: none !important;
    }

    table.round {
        border-radius: 6px;
    }
</style>
<div wire:ignore.self class="modal fade" id="asignar_mobiliario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle" style="font-size: 16px">Agregar Productos al Mobiliario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                
                <div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <b style="cursor: pointer; font-size: 14px">Buscar Producto</b>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search2" placeholder="Buscar Producto..." class="form-control ">
                            </div>
                        </div> 
                    </div>
                </div>
                
                <form class="form-control dropzone dz-clickable">
                    <div class="dz-default dz-message">
                        @if ($search2 != null)
                                <div class="vertical-scrollable">
                                    <div class="table-sm">
                                        <table class='table borderless round' style="width:96%">
                                            <tbody>
                                                @forelse ($data_prod_mob as $data_m)
                                                    <tr class="text-center">
                                                        <td class="text-center">
                                                            <h6>{{$data_m->nombre}}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <button class="btn bg-gradient-primary btn-sm mb-0" type="button" wire:click="addProd({{ $data_m->id}})">
                                                                <i class="fas fa-check"></i> Agregar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <p class="text-center">No existe productos con ese criterio de busqueda</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p>{{$search2}}</p>
                                <h5 style="text-align: center">Sin Datos</h5>
                            @endif
                        </div>
                    </form>
                
                <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
                    <div class="table-responsive">
                        @if ($col->count() != 0)
                        <table class="m-auto">
                            <thead class="text-center" style="font-size: 12px">
                                <th style="width: 25%" class="text-center">Codigo Producto</th>
                                <th class="text-center">Nombre Producto</th>
                                <th class="text-center">Acc.</th>
                            </thead>
                            <tbody>
                                @forelse ($col as $datacol)
                                <tr class="text-center" style="font-size: 11.5px">
                                    <td>
                                        {{$datacol['product_codigo']}}
                                    </td>
                                    <td>
                                        {{$datacol['product_name']}}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="mx-3"
                                            wire:click="quitarProducto({{ $datacol['product_codigo']}})" class="boton-rojo">
                                            <i class="fas fa-times text-danger" style="font-size: 14px"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <p></p>
                                @endforelse
                            </tbody>
                        </table>
                        @else
                            <div class="table-wrapper row align-items-center m-auto"
                                style="background-color: rgba(145, 250, 189, 0.459)">
                                <div class="col-lg-12">
                                    <div class="row justify-content-center">
                                        <h5 class="text-center"> BUSCAR Y AGREGAR ITEMS</h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                <button wire:click.prevent="asignarMobiliario()" type="button" class="btn btn-primary" style="font-size: 13px">GUARDAR</button>
                    {{-- <button type="button" wire:click.prevent="asignarMobiliario()" class="btn btn-warning m-1">GUARDAR</button> --}}
            </div>
        </div>
    </div>
</div>