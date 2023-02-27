{{-- Modal para avisar stock insuficiente en la Tienda y mostrar stock disponibles
en otros destinos dentro de la misma sucursal --}}

<div wire:ignore.self class="modal fade" id="stockinsuficiente" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    Aviso
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8 text-center">
                        <h5>Stock Insuficiente</h5>
                    </div>
                    <div class="col-2">
                        <div class="form-check form-switch">
                            <input wire:model="selloutofstock" class="form-check-input" type="checkbox" role="switch" title="Vender sin stock">
                        </div>
                    </div>


                    @if($this->selloutofstock)
                    <br>
                    <br>

                    <div class="col-5 text-center">
                        <label>CANTIDAD</label>
                        <input class="form-control" wire:model="extraquantity" type="number">
                    </div>
                    <div class="col-5 text-center">
                        <label>COSTO</label>
                        <input class="form-control" wire:model="product_cost" type="text">
                    </div>
                    <div class="col-2 text-center">
                        <br>
                        @if($this->extraquantity > 0)
                            <button wire:click="extraincrease()" class="btn btn-primary" title="Incrementar Cantidad Extra">
                                <i class="fas fa-plus"></i>
                            </button>
                        @endif
                    </div>
                    
                    <br>
                    <br>
                    
                    <br>
                    <br>

                    @endif



                    <div class="col-12 text-sm mb-0 text-center">
                        No existe mas stock disponible del producto <b>"{{ $this->nombreproducto }}"</b>
                        , a continuacion se muestran todas las sucursales y el stock con el que cuentan de este producto
                        <p class="text-sm mb-0" style="background-color: #5e72e4; color: white;">
                            Tu Sucursal: <b>"{{ $this->nombresucursal }}"</b>
                        </p>
                    </div>

                </div>





                <div class="table-wrapper">
                    <table>
                        <thead class="text-sm mb-0">
                            <tr>
                                <th>N°</th>
                                <th>Nombre Destino</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- listadestinos solo cargará si es diferente de nulo --}}
                            @if ($this->listadestinos != null)
                                @if ($listadestinos->count() > 0)
                                    @foreach ($this->listadestinos as $item)
                                        <tr class="seleccionar">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nombredestino }}
                                            </td>
                                            <td>
                                                {{ $item->stock }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            No hay stock disponible
                                        </td>
                                    </tr>
                                @endif

                            @endif





                        </tbody>
                    </table>
                    @foreach ($this->listasucursales as $i)
                        <div style="background-color: rgb(234, 208, 12);">
                            {{ $i->name }} - {{ $i->adress }}
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($this->buscarstocksucursal($i->id)->count() > 0)
                                    @foreach ($this->buscarstocksucursal($i->id) as $d)
                                        <tr class="seleccionar">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $d->nombredestino }}
                                            </td>
                                            <td>
                                                {{ $d->stock }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            No hay stock disponible
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endforeach
                </div>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
