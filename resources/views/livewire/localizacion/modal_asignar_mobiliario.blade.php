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
<div wire:ignore.self class="modal fade" id="asignar_mobiliario" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Productos al Mobiliario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12 ml-4 mt-4">

                            <b style="cursor: pointer;">Buscar Producto</b>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend ml-3">
                                        <span class="input-group-text input-gp">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input type="text" wire:model="search2" placeholder="Buscar Producto..."
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="row mt-0 ml-5">
                        <div class="col-12 col-md-12">

                            <div class="table-7 mt-0">

                                @if ($search2 != null)

                                <div class="vertical-scrollable">
                                    <div class="table-sm">
                                        <table class='table borderless round' style="width:96%">

                                            <tbody>

                                                @forelse ($data_prod_mob as $data_m)
                                                <tr>
                                                    <td class="text-center">
                                                        <h6>{{$data_m->nombre}}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <button type="button" wire:click="addProd({{ $data_m->id}})"
                                                            class="boton-azul">
                                                            <i class="fas fa-check"></i> Agregar
                                                        </button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <p>No existe productos con ese criterio de busqueda</p>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @else
                                <p>{{$search2}}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
                <div class="table-responsive">
                    @if ($col->count() != 0)

                    <table class="m-auto">
                        <thead>
                            <th style="width: 25%" class="text-center">Codigo Producto</th>
                            <th class="text-center">Nombre Producto</th>
                            <th class="text-center">Acc.</th>
                        </thead>
                        <tbody>
                            @forelse ($col as $datacol)
                            <tr>

                                <td class="text-center">
                                    <h6>{{$datacol['product_codigo']}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$datacol['product_name']}}</h6>
                                </td>
                                <td class="text-center">
                                    <button href="javascript:void(0)"
                                        wire:click="quitarProducto({{ $datacol['product_codigo']}})" class="boton-rojo">
                                        <i class="fas fa-times"></i>
                                    </button>
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
                                <h2> BUSCAR Y AGREGAR ITEMS</h2>

                            </div>
                        </div>
                    </div>
                    @endif
                </div>


            </div>
            <div class="row justify-content-end mr-2 mb-2">
               

                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning m-1"
                        data-dismiss="modal">CANCELAR</button>
    
                    <button type="button" wire:click.prevent="asignarMobiliario()" class="btn btn-warning m-1">GUARDAR</button>
    
              
            </div>
        </div>
    </div>