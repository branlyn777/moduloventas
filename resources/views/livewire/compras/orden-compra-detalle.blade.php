
<div class="row sales layout-top-spacing">
    <div class="col-sm-12" >

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <div class="col-12 col-lg-12 col-md-10 mt-3">
                    <div class="row mb-3" >
                        <div class="col-lg-10" >
                            <h5 class="mb-2 mt-2">ORDEN DE COMPRA</h5>
                            <b style="color: rgb(74, 74, 74)">Fecha: </b>
                            {{Carbon\Carbon::now()->format('Y-m-d')}}<br/>  
                            <b style="color: rgb(74, 74, 74)">Registrado por: </b> 
                            {{Auth()->user()->name}}<br/>
                            
                        </div>
                        
                        <div class="col-lg-2 col-sm-1 col-md-1">
                            <button href="javascript:void(0)" data-toggle="modal"
                                data-target="#theModal" class="boton-azul" > <strong> Registrar Producto</strong></button>
                        </div>
                        
                    </div>
                    <hr style="height:3px;border:none;color:rgb(189, 188, 188);background-color:rgb(229, 140, 40);" />
                        <div class="row">

                             <div class="col-12 col-md-4 col-lg-4">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="form-group">
                                             <strong style="color: rgb(74, 74, 74)">Proveedor</strong>
                                             <div class="input-group-prepend mb-3">
                                                 <input list="provider" wire:model="provider" class="form-control">
                                                 <datalist id="provider">
                                                    @foreach($data_prov as $datas)
                                                        <option value="{{$datas->nombre_prov}}">{{$datas->nombre_prov}}</option>
                                                    @endforeach
                                                 </datalist>
{{--                                                    
                                                         <button data-toggle="modal" class="btn btn-dark pl-2 pr-2"
                                                             data-target="#modal_prov" > <i class="fas fa-plus text-white"></i> </button> --}}
                                                  
                                              </div>
                                             @error('provider')
                                                 <span class="text-danger er">{{ $message }}</span>
                                             @enderror
                                           </div>
                                     </div>
                                    </div>
                                    <div class="row">

                                    
                                <div class="col-lg-12">
                                        
                                        <div class="form-group">
                                            <strong style="color: rgb(74, 74, 74)">Destino de la Compra</strong>
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

                                 </div>
                             </div>

                            
                          
                             <div class="col-12 col-md-4 col-lg-4" style="border: thick #b4b4b1;" >

                                <div class="col-lg-12">
                                    <div class="form-group">
                                           <strong style="color: rgb(74, 74, 74)">Observacion: </strong>
                                        <textarea  wire:model='observacion' class="form-control" aria-label="With textarea"></textarea>
                                        @error('observacion')
                                        <span class="text-danger er">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                             </div>
                            </div>
                          </div>
                    

                </div>
        
            </div>
            <hr style="height:3px;border:none;color:rgb(189, 188, 188);background-color:rgb(230, 152, 64);" />

        
                <div class="row">
                    <div class="col-lg-4 col-12 col-md-12">
                            <div class="ml-2 mt-2 mb-2 mr-0 p-2">
                               
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-gp">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>
                                        <input type="text" wire:model="search" placeholder="Buscar" class="form-control">
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
                                             @foreach ($prod as $producto)
                                                 <tr>
                                                     <td>
                                                         
                                                            <strong>{{$producto->nombre}}({{$producto->codigo}})</strong>
                                                            <label>{{ $producto->unidad}}|{{ $producto->marca}}|{{ $producto->industria }}</label>
                                                            <label>|{{ $producto->caracteristicas }}</label>
                                                        
                                                     </td>
                                                   
                                                     <td class="text-center">
                                                         <button wire:click="InsertarProducto({{ $producto->id }})"
                                                             class="boton-azul">
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
               
                    <div class="col-lg-8 col-12  col-md-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 widget mr-2 mb-2 mt-2">
                             
                                    
                                <div class="row justify-content-center mt-3 mb-4">
                                    <h3><b>Detalle Orden de Compra</b></h3>
                                </div>
                                @if ($cart->isNotEmpty())
                                <div class="row">

                             
                                        <div class="table-6">
                                            <table>

                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 12rem; color:#ffffff; font-size:1rem">Producto</th>
                                                
                                                <th class="text-center" style="width: 5rem; color:#ffffff" >Precio <br>Compra</th>
                                           
                                                <th class="text-center" style="width: 5rem; color:#ffffff">Cantidad</th>
                                                <th class="text-center" style="width: 6rem; color:#ffffff">Total</th>
                                             
                                                <th class="text-center" style="width: 6rem; color:#ffffff" >Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart->sortBy("order") as $prod)
                                                <tr>
                                                    <td>
                                                        <h6 style="font-size: 0.90rem" >{{$prod['product_name']}}</h6>
                                                    </td>
                                                  
                                                    <td>
                                                         <input type="text" 
                                                         id="r{{$prod['product_id']}}" 
                                                         wire:change="actualizarPrecio({{$prod['product_id']}}, $('#r' + {{$prod['product_id']}}).val() )" 
                                                         style="font-size: 0.8rem!important; padding:0!important" 
                                                         class="form-control text-center" 
                                                         value="{{$prod['price']}}">
                                                    </td>

                                                 

                                                    <td>
                                                         <input type="text" 
                                                         id="rr{{$prod['product_id']}}" 
                                                         wire:change="actualizarCantidad({{$prod['product_id']}}, $('#rr' + {{$prod['product_id']}}).val() )" 
                                                         style="font-size: 0.8rem!important; padding:0!important" 
                                                         class="form-control text-center" 
                                                         value="{{$prod['quantity']}}">
                                                    </td>
                                                   
                                                    <td>
                                                        <h6 style="font-size: 0.8rem!important;" class="text-center" >{{number_format($prod['quantity']*$prod['price'],2)}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)"
                                                        wire:click="quitarProducto({{ $prod['product_id']}})"
                                                        class="boton-rojo p-1" title="Quitar Item">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                        wire:click="calcularStock({{ $prod['product_id']}})"
                                                        class="boton-verde p-1" title="Calcular stock">
                                                            <i class="fas fa-calculator"></i>
                                                        </a>

                                                    </td>
                                                  
                                                </tr>
                                            @endforeach
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                         <h3 class="text-right">TOTAL.-</h3>
                                                    </td>
                                                    <td colspan="3">
                                                        <h3 class="text-center">  {{number_format($total,2)}}</h3>
                                                      
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
                                <b>Ir Orden Compras</b>
                            </a>
                            <button wire:click="guardarCompra()" class="btn btn-button" style="background-color: #11be32; color: white;">
                                Finalizar
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
         </div>
         @include('livewire.compras.producto_cal')
    </div>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         window.livewire.on('show-modal', msg => {
             $('#modal_calculadora').modal('show')
         });
       
         window.livewire.on('cantidad_ok', msg => {
             $('#modal_calculadora').modal('hide')
   
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
 
