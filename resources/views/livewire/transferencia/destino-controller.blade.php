<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h3 class="text-center">
                    <b>TRANSFERENCIA PRODUCTOS</b>
                </h3>

            </div>

            {{--SELECT DE LAS SUCURSALES--}}

            <div class="row">

                <div class="col-12 col-lg-8 col-md-3 ml-3">

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <label> <strong style="color: black">Origen de transferencia:</strong> </label>
                                <select wire:model='selected_origen' {{ ($itemsQuantity>0)? 'disabled':""}}
                                    class="form-control">
                                    <option value=0>Elegir Origen</option>
                                    @foreach ($data_origen as $data)
                                    <option value="{{ $data->destino_id }}">{{ $data->sucursal }}-{{$data->destino}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="form-group">
                                <label> <strong style="color: black">Destino de transferencia:</strong> </label>
                                <select wire:model='selected_destino' class="form-control">
                                    <option value=null>Elegir Destino</option>
                                    @foreach ($data_destino as $data)
                                    <option value="{{ $data->destino_id }}">{{ $data->sucursal }}-{{$data->destino}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">

                            <div class="form-group">
                                <label> <strong style="color: black">Observacion:</strong> </label>
                                <input wire:model='observacion' class="form-control" type="text">
                            </div>

                        </div>
                    </div>


                </div>


            </div>

            <div class="row">

                <div class="col-lg-5 mt-3">

                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-6">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">

                            @if($selected_origen !== 0 && strlen($search) > 0 )
                            <div class="table-6">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center">ITEM</th>
                                            <th class="text-center">PRODUCTO</th>
                                            <th class="text-center">STOCK</th>
                                            <th class="text-center">ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($destinos_almacen as $destino)
                                        <tr>
                                            <td>
                                                <h6 class="text-center">{{ $loop->iteration}}</h6>
                                            </td>
                                            <td>
                                                <h6 class="text-center">{{ $destino->name }}</h6>
                                            </td>

                                            <td>
                                                <h6 class="text-center">{{ $destino->stock }}</h6>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" wire:click="increaseQty({{ $destino->prod_id }})"
                                                    class="boton-azul p-1">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>

                            @else
                            <span>No se encontraron resultados</span>
                            @endif
                        </div>
                    </div>

                </div>
                {{--AREA DE TRANSFERENCIAS DE PRODUCTOS--}}

                <div class="col-12 col-lg-7 col-md-3">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-12 widget mr-2 mb-2 mt-2">
                            <div class="row justify-content-center mt-2">

                                <h3><b>Detalle Transferencia</b></h3>
                            </div>
                            @if ($cart->isNotEmpty())
                            <div class="row">

                                <div class="table-wrapper pt-4 mt-1">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto</th>

                                                <th class="text-center" style="width: 20%">Cantidad</th>
                                                <th class="text-center">Acc.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $prod)
                                            <tr>
                                                <td class="text-center">
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$prod->name}}
                                                </td>

                                                <td class="text-center">
                                                    <input type="number" id="rr{{$prod->id}}"
                                                        wire:change="UpdateQty({{$prod->id}}, $('#rr' + {{$prod->id}}).val())"
                                                        style="font-size: 0.8rem!important; padding:0!important"
                                                        class="form-control text-center" value="{{$prod->quantity}}">
                                                </td>

                                                <td class="text-center">
                                                    <a href="javascript:void(0)"
                                                        wire:click="removeItem({{ $prod->id }})" class="boton-rojo"
                                                        title="Edit">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            @else
                            <div class="table-wrapper row align-items-center m-auto">
                                <div class="col-lg-12">
                                    <div class="row justify-content-center">AGREGAR ITEMS</div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if($this->itemsQuantity > 0)
                            <button wire:click="resetUI()" class="btn btn-button"
                                style="background-color: #373839; color: white; border-color: black;">
                                Vaciar
                            </button>
                            @endif
                            <a wire:click="exit()" class="btn btn-button"
                                style="background-color: rgb(255, 255, 255); border: 1.8px solid #000000; color: black;">
                                <b>Ir Transferencias</b>
                            </a>
                            <button wire:click="finalizar_tr()" class="btn btn-button"
                                style="background-color: #11be32; color: white;">
                                Finalizar
                            </button>
                        </div>
                    </div>




                </div>


            </div>

        </div>

    </div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('empty', msg => {
           noty(msg)
       });
        window.livewire.on('empty-destino', msg => {
           noty(msg)
       });
        window.livewire.on('no-stock', msg => {
           noty(msg)
       });
        window.livewire.on('empty_cart_tr', msg => {
           noty(msg)
       });
    });
</script>