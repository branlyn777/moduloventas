<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Registro de Compras</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <button data-bs-toggle="modal"
                                data-bs-target="#theModal" class="btn bg-gradient-light btn-sm mb-0">Registrar Producto</button>
                            <button data-bs-toggle="modal"
                                wire:click='mostrarOrdenes()' class="btn bg-gradient-light btn-sm mb-0">Ordenes De Compra</button>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <strong style="color: rgb(74, 74, 74)">Proveedor</strong><br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <input list="provider" wire:model="provider" class="form-control">
                                <datalist id="provider">
                                    @foreach($data_prov as $datas)
                                        <option value="{{$datas->nombre_prov}}">{{$datas->nombre_prov}}</option>
                                    @endforeach
                                </datalist> 
                                <button data-toggle="modal" class="btn btn-dark pl-2 pr-2"
                                    data-target="#modal_prov" > <i class="fas fa-plus text-white"></i></button>
                            </div>
                            {{-- <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Proveedor</strong>
                                <div class="input-group-prepend mb-3">
                                    <input list="provider" wire:model="provider" class="form-control">
                                    <datalist id="provider">
                                        @foreach($data_prov as $datas)
                                            <option value="{{$datas->nombre_prov}}">{{$datas->nombre_prov}}</option>
                                        @endforeach
                                    </datalist> 
                                    <button data-toggle="modal" class="btn btn-dark pl-2 pr-2"
                                        data-target="#modal_prov" > <i class="fas fa-plus text-white"></i></button>          
                                </div>
                                @error('provider')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div> --}}
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Tipo de Documento:</strong>
                                <select wire:model='tipo_documento' class="form-control">
                                    <option value='FACTURA' selected>Factura</option>
                                    <option value='NOTA DE VENTA'>Nota de Venta</option>
                                    <option value='RECIBO'>Recibo</option>
                                    <option value='NINGUNO'>Ninguno</option>
                                </select>
                                @error('tipo_documento')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror                                          
                             </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Nro. de Documento</strong>
                                <input type="text" wire:model.lazy="nro_documento" class="form-control">
                                @error('nro_documento')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Observacion: </strong>
                                <textarea  wire:model='observacion' class="form-control" aria-label="With textarea"></textarea>
                                @error('observacion')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Sucursal Destino</strong>
                                <select wire:model.lazy="destino" class="form-control">
                                    <option value='Elegir'>Elegir Destino</option>
                                    @foreach($data_suc as $data)
                                        <option value="{{$data->destino_id}}">{{$data->nombre}}-{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            @error('destino')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Tipo transaccion:</strong>
                                <select wire:model='tipo_transaccion' class="form-control">
                                    <option value="Contado" selected>Contado</option>
                                    <option value="Credito">Credito</option>
                                    
                                </select>
                                @error('tipo_documento')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror                                          
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Codigo Orden de Compra: </strong>
                                <label class="form-control">{{$ordencompraselected}}</label>
                            </div>
                        </div>
                    </div> 
                </div>
            </div> 
    
            <br>
            <div class="row">
                {{-- <form class="form-control dropzone dz-clickable"> --}}
                    

                <div class="col-lg-4 col-12 col-md-12">
                    <div class="ml-2 mt-2 mb-2 mr-0 p-2">
                        <div class="form-group">
                            <div class="input-group mb-4">
                                <span class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" wire:model="search" placeholder="Buscar"
                                    class="form-control">
                            </div>
                        </div>

                        @if(strlen($search) > 0)
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Producto</th>                              
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_prod as $prod)
                                            <tr>
                                                <td>  
                                                    <strong>{{$prod->nombre}}({{$prod->codigo}})</strong>
                                                    <label>{{ $prod->unidad}}|{{ $prod->marca}}|{{ $prod->industria }}</label>
                                                    <label>|{{ $prod->caracteristicas }}</label>
                                                </td>
                                                   
                                                <td class="text-center">
                                                    <button wire:click="increaseQty({{ $prod->id }})" class="boton-azul">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif  
                    </div>
                </div>

                    
                {{-- </form> --}}
               
                <div class="col-lg-8 col-12  col-md-12">
                    <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 widget mr-2 mb-2 mt-2">
                                <div>{{-- class="row justify-content-center mt-3 mb-4" --}}
                                    <h3><b>Detalle Compra</b></h3>
                                </div>
                                @if ($cart->isNotEmpty())
                                    <div class="row">
                                        <div class="table-6">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 12rem; color:#ffffff; font-size:1rem">Producto</th>
                                                        <th class="text-center" style="width: 5rem; color:#ffffff">Codigo</th>
                                                        <th class="text-center" style="width: 5rem; color:#ffffff" >Precio <br>Compra</th>
                                                        <th class="text-center" style="width: 5rem; color:#ffffff">Precio <br>Venta</th>
                                                        <th class="text-center" style="width: 5rem; color:#ffffff">Cantidad</th>
                                                        <th class="text-center" style="width: 6rem; color:#ffffff">Total</th>
                                                    
                                                        <th class="text-center" style="width: 6rem; color:#ffffff" >Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cart as $prod)
                                                        <tr>
                                                            <td>
                                                                <h6 style="font-size: 0.90rem" >{{$prod->name}}</h6>
                                                            </td>
                                                            <td>
                                                                <strong><h6 style="font-size: 0.8rem!important;"> {{$prod->attributes->codigo}}</h6></strong>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="r{{$prod->id}}" 
                                                                    wire:change="UpdatePrice({{$prod->id}}, $('#r' + {{$prod->id}}).val() )" 
                                                                    style="font-size: 0.8rem!important; padding:0!important" 
                                                                    class="form-control text-center" 
                                                                value="{{$prod->price}}">
                                                            </td>

                                                            <td>
                                                                <input type="text" id="rs{{$prod->id}}" 
                                                                    wire:change="UpdatePrecioVenta({{$prod->id}}, $('#rs' + {{$prod->id}}).val() )" 
                                                                    style="font-size: 0.8rem!important; padding:0!important" 
                                                                    class="form-control text-center" 
                                                                value="{{$prod->attributes->precio}}">
                                                            </td>

                                                            <td>
                                                                <input type="text" id="rr{{$prod->id}}" 
                                                                    wire:change="UpdateQty({{$prod->id}}, $('#rr' + {{$prod->id}}).val() )" 
                                                                    style="font-size: 0.8rem!important; padding:0!important" 
                                                                    class="form-control text-center" 
                                                                value="{{$prod->quantity}}">
                                                            </td>
                                                        
                                                            <td>
                                                                <h6 style="font-size: 0.8rem!important;" class="text-center" >{{$prod->getPriceSum()}}</h6>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0)"
                                                                    wire:click="removeItem({{ $prod->id }})"
                                                                    class="btn btn-danger p-1" title="Quitar Item">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5">
                                                                <h3 class="text-right">TOTAL.-</h3>
                                                            </td>
                                                            <td colspan="2">
                                                                <h3 class="text-center">{{$total_compra}}</h3>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
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
                                <button  wire:click="resetUI()" class="btn btn-button" style="background-color: #373839; color: white; border-color: black;">
                                    Vaciar
                                </button>
                                @endif
                                <a wire:click="exit()" class="btn btn-button" style="background-color: rgb(255, 255, 255); border: 1.8px solid #000000; color: black;">
                                    <b>Ir Compras</b>
                                </a>
                                <button wire:click="guardarCompra()" class="btn btn-button" style="background-color: #11be32; color: white;">
                                    Finalizar
                                </button>
                            </div>
                        </div>

                </div>
            </div>
             
        </div>
    </div>
    @include('livewire.compras.provider_info')
    @include('livewire.products.form')
    @include('livewire.compras.descuento')
    @include('livewire.compras.pago')
    @include('livewire.compras.verOrdenesCompra')
 </div>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         window.livewire.on('show-modal', msg => {
             $('#modal_prov').modal('show')
         });
         window.livewire.on('prov_added', msg => {
             $('#modal_prov').modal('hide')
             $("#im").val('');
             noty(Msg)
         });
         window.livewire.on('verOrdenes', msg => {
             $('#ordenCompra').modal('show')
          
         });
         window.livewire.on('ordenes_close', msg => {
             $('#ordenCompra').modal('hide')
          
         });
         window.livewire.on('products_added', msg => {
            $('#theModal').modal('hide')
             noty(Msg)
         });
         window.livewire.on('empty_cart', msg => {
            noty(msg)
        });
     });
 
     function Confirm(id, name, cantRelacionados ) {
         if (cantRelacionados > 0) {
             swal.fire({
                 title: 'PRECAUCION',
                 icon: 'warning',
                 text: 'No se puede eliminar la empresa "' + name + '" porque tiene ' 
                 + cantRelacionados + ' sucursales.'
             })
             return;
         }
         swal.fire({
             title: 'CONFIRMAR',
             icon: 'warning',
             text: '¿Confirmar eliminar la empresa ' + '"' + name + '"?.',
             showCancelButton: true,
             cancelButtonText: 'Cerrar',
             cancelButtonColor: '#383838',
             confirmButtonColor: '#3B3F5C',
             confirmButtonText: 'Aceptar'
         }).then(function(result) {
             if (result.value) {
                 window.livewire.emit('deleteRow', id)
                 Swal.close()
             }
         })
     }
 </script>
 