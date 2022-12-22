<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-2 mt-2">DETALLE DE COMPRA N° {{$ide}}</h5>
                        {{-- <b style="color: rgb(74, 74, 74)">Fecha: </b>
                            {{$fecha_compra}}
                            <br/>  
                            <b style="color: rgb(74, 74, 74)">Registrado por: </b> 
                            {{$usuario}}<br/> 
                        --}}
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#theModal" 
                                class="btn bg-gradient-light btn-sm mb-0"><strong>Registrar Producto</strong></a>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card  mb-4">
                <div class="card-body p-3">
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Proveedor</strong>
                                <div class="input-group-prepend mb-3">
                                    <input list="provider" wire:model="provider" class="form-control">
                                    <datalist id="provider">
                                       @foreach($data_prov as $datas)
                                           <option value="{{$datas->nombre_prov}}">{{$datas->nombre_prov}}</option>
                                       @endforeach
                                    </datalist>
                                     
                                    <button type="button" data-toggle="modal"
                                        data-target="#modal_prov" class="btn btn-dark"> <i class="fas fa-plus"></i></button>
                                        
                                </div>
                                @error('provider')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div <div class="col-12 col-sm-6 col-md-3">
                            <b>Tipo de Documento:</b>
                            <div class="form-group">
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

                        <div <div class="col-12 col-sm-6 col-md-3">
                            <b>Nro. de Documento</b>
                            <div class="form-group">
                                <input type="text" wire:model.lazy="nro_documento" class="form-control">
                                @error('nro_documento')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-6 col-md-3">
                            <strong style="color: rgb(74, 74, 74)">Observacion: </strong>
                            <div class="form-group">
                                <textarea  wire:model='observacion' class="form-control" aria-label="With textarea"></textarea>
                                @error('observacion')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">      
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Destino Producto</strong>
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
                    </div>
                </div> 
            </div>
            <br>
            <div class="card  mb-4">
                <div class="card-body p-3">
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
                            </div>
                        </div>

                        <div class="col-lg-8 col-12 col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-12 col-md-4 col-sm-12">
                                    <h6 class="rounded">
                                        <b>Elementos encontrados:</b>
                                    </h6>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="widget-content">
                <div class="row">
                    <div class="col-lg-4 col-12 col-md-12">
                            <div class="ml-2 mt-2 mb-2 mr-0 p-2">
                               
                                    
                                
                                
                         
                                   @if(strlen($search) > 0)
                                   <div class="table-6">
                                    <table>
                                        <thead>
                                             <tr>
                                                 <th class="table-th text-withe text-left">Producto</th>                              
                                                 <th class="table-th text-withe text-left">Accion</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($data_prod as $prod)
                                                 <tr>
                                                     <td>
                                                         
                                                            <strong>{{$prod->nombre}}</strong>
                                                            <label>{{ $prod->unidad}}|{{ $prod->marca}}|{{ $prod->industria }}</label>
                                                            <label>{{ $prod->caracteristicas }}</label>
                                                        
                                                     </td>
                                                   
                                                     <td class="text-center">
                                                         <a href="javascript:void(0)" wire:click="increaseQty({{ $prod->id }})"
                                                             class="boton-azul">
                                                             <i class="fas fa-plus"></i>
                                                         </a>
                                                        
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
                        <div class="widget mr-2 mb-2 mt-2">
                              


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
                                                         <input type="text" 
                                                         id="r{{$prod->id}}" 
                                                         wire:change="UpdatePrice({{$prod->id}}, $('#r' + {{$prod->id}}).val() )" 
                                                         style="font-size: 0.8rem!important; padding:0!important" 
                                                         class="form-control text-center" 
                                                         value="{{$prod->price}}">
                                                    </td>

                                                    <td>
                                                        <input type="text" 
                                                         id="rs{{$prod->id}}" 
                                                         wire:change="UpdatePrecioVenta({{$prod->id}}, $('#rs' + {{$prod->id}}).val() )" 
                                                         style="font-size: 0.8rem!important; padding:0!important" 
                                                         class="form-control text-center" 
                                                         value="{{$prod->attributes->precio}}">
                                                    </td>

                                                    <td>
                                                         <input type="text" 
                                                         id="rr{{$prod->id}}" 
                                                         wire:change="UpdateQty({{$prod->id}}, $('#rr' + {{$prod->id}}).val() )" 
                                                         style="font-size: 0.8rem!important; padding:0!important" 
                                                         class="form-control text-center" 
                                                         value="{{$prod->quantity}}">
                                                    </td>
                                                   
                                                    <td>
                                                        <h6 style="font-size: 0.8rem!important;" class="text-center" >{{$prod->getPriceSum()}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <button 
                                                        wire:click="deleteItem({{ $prod->id }})"
                                                            class="boton-rojo" title="Eliminar Item">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tfoot class="text-white text-right" style="background: #fffefd"  >
                                                   
                                                    <tr>
                                                        <td colspan="5">
                                                             <h5 class="text-dark" style="font-size: 1rem!important;">TOTAL.-</h5>
                                                        </td>
                                                        <td colspan="5">
                                                            <h5 class="text-dark text-center" style="font-size: 1rem!important;" >{{$total_compra}}</h5>
                                                        </td>
                                                    </tr>
                                            </tfoot>
                                        </tbody>
                                    </table>
                                </div>
                            
                        </div>
                        <div class="row align-items-center justify-content-center">

                                <button class="btn btn-info m-3 p-2"  wire:click.prevent="guardarCompra()">ACTUALIZAR</button>
                                <button class="btn btn-danger m-3 p-2"  wire:click.prevent="exit()" > CANCELAR</button>
                            
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </div>
    @include('livewire.compras.provider_info')
    @include('livewire.products.form')
    @include('livewire.compras.descuento')
    @include('livewire.compras.errores')
 </div>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         window.livewire.on('show-modal', msg => {
             $('#modal_prov').modal('show')
         });
         window.livewire.on('errores', msg => {
             $('#errores').modal('show')
         });
         window.livewire.on('prov_added', msg => {
             $('#modal_prov').modal('hide')
             noty(Msg)
         });
         window.livewire.on('dscto_added', msg => {
             $('#modal_desc').modal('hide')
             noty(Msg)
         });
         window.livewire.on('products_added', msg => {
            $('#theModal').modal('hide')
             noty(Msg)
         });
         window.livewire.on('empty_cart', msg => {
            noty(msg)
        });


        window.livewire.on('error-item', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'error',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        window.livewire.on('item-updated', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        window.livewire.on('modificiacion_exitosa', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });
        // window.livewire.on('error-destino', msg => {
        //     const toast = swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 5000,
        //     padding: '2em'
        //     });
        //     toast({
        //         type: 'error',
        //         title: @this.mensaje_toast,
        //         padding: '2em',
        //     })
        // });
        window.livewire.on('destino_actualizado', msg => {
            const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em'
            });
            toast({
                type: 'success',
                title: @this.mensaje_toast,
                padding: '2em',
            })
        });


        window.livewire.on('error-destino', msg => {
            const addOption = (arr) => {
            let optionItems='';
            arr.forEach(item =>{
                optionItems += `<option value="${item}">${item}</option>`
            });
            return optionItems;
            }

//in swal 

        swal.fire({
            title: 'Error',
            icon: 'error',
            text:'No puede modificar el destino de la compra por los siguientes productos:',
            html:addOption(@this.col) 
            })
            
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
 