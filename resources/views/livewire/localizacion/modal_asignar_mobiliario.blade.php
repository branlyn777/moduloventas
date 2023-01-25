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
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle" style="font-size: 16px">Agregar
                    Productos al Mobiliario</h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <b style="cursor: pointer; font-size: 14px">Buscar</b>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                <input type="text" wire:model="search2" placeholder="Producto" class="form-control ">
                            </div>
                        </div>

                        @if ($search2 != null)
                            <table style="width:100%">
                                <thead style="font-size: 0.9rem">
                                    <th>Nombre Producto</th>
                                    <th class="text-center">Accion</th>
                                </thead>
                                <tbody>
                                    @forelse ($data_prod_mob as $data_m)
                                        <tr>
                                            <td style="font-size: 0.9rem">
                                                {{ $data_m->nombre }}
                                            </td>
                                            <td class="text-center">
                                                <a wire:click="addProd({{ $data_m->id }})" class="btn btn-primary"
                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-center">No existe productos con ese criterio de
                                            busqueda</p>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <p>{{ $search2 }}</p>
                            {{-- <h5 style="text-align: center">Sin Datos</h5> --}}
                        @endif
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
                    <div class="table-responsive">
                        @if ($col->count() != 0)
                            <table class="m-auto">
                                <thead style="font-size: 0.9rem">
                                    <th style="width: 25%">Codigo Producto</th>
                                    <th>Nombre Producto</th>
                                    <th class="text-center">Accion</th>
                                </thead>
                                <tbody>
                                    @forelse ($col as $datacol)
                                        <tr style="font-size: 0.9rem">
                                            <td>
                                                {{ $datacol['product_codigo'] }}
                                            </td>
                                            <td>
                                                {{ $datacol['product_name'] }}
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" class="mx-3"
                                                    wire:click="quitarProducto({{ $datacol['product_codigo'] }})" class="boton-rojo">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <p></p>
                                    @endforelse
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">CANCELAR</button>
                <button wire:click.prevent="asignarMobiliario()" type="button" class="btn btn-primary"
                    style="font-size: 13px">GUARDAR</button>
            </div>
        </div>
    </div>
</div>

