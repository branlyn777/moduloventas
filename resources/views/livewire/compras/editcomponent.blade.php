<div>
    <div class="row">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="text-white" style="font-size: 16px">Detalle de Compra N° {{$ide}}</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#theModal" 
                                class="btn bg-gradient-light btn-sm mb-0"><strong>Registrar Producto</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card  mb-4">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Proveedor</strong><br>
                                <div class="input-group mb-3" role="group" aria-label="Basic example">
                                    <input list="provider" wire:model="provider" class="form-control">
                                    <datalist id="provider">
                                       @foreach($data_prov as $datas)
                                           <option value="{{$datas->nombre_prov}}">{{$datas->nombre_prov}}</option>
                                       @endforeach
                                    </datalist>
                                     
                                    <button type="button" data-bs-toggle="modal" class="btn btn-dark pl-2 pr-2"
                                        data-bs-target="#modal_prov"> <i class="fas fa-plus text-white"></i></button>
                                        
                                </div>
                                @error('provider')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
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

                        <div class="col-12 col-sm-6 col-md-3">
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

                        <div class="col-12 col-sm-6 col-md-3">      
                            <div class="form-group">
                                <strong style="color: rgb(74, 74, 74)">Destino Producto</strong>
                                <select wire:model.lazy="destino" class="form-select">
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
                                <select wire:model='tipo_transaccion' class="form-select">
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
            <div class="card mb-4">
                <div class="card-body p-3">
                    <div class="row">

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
                                                <tr style="font-size: 14px">
                                                    <th>Producto</th>                              
                                                    <th class="text-center">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_prod as $prod)
                                                    <tr>
                                                        <td>  
                                                            <label style="font-size: 14px" type="button">{{$prod->nombre}}({{$prod->codigo}})</label>
                                                            <label>{{ $prod->unidad}}|{{ $prod->marca}}|{{ $prod->industria }}</label>
                                                            <label>|{{ $prod->caracteristicas }}</label>
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            <a wire:click="increaseQty({{ $prod->id }})" class="btn btn-primary" 
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
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

                        {{-- <div class="col-lg-8 col-12 col-md-12">
                            <div class="row">
                                <div class="col-lg-12 col-12 col-md-4 col-sm-12">
                                    <h6 class="rounded">
                                        <b>Elementos encontrados:</b>
                                    </h6>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-8 col-12 col-md-12">
                            <div class="row">
                               
                                    <div class="text-center">{{-- class="row justify-content-center mt-3 mb-4" --}}
                                        <h5><b>Detalle Compra</b></h5>
                                    </div>
                                    <div class="row">
                                        <div class="card-body px-0 pb-0">
                                            <div class="table-responsive">
                                         
                                                        <table class="table align-items-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Producto</th>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Codigo</th>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Precio Compra</th>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Precio Venta</th>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Cantidad</th>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Total</th>
                                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" >Accion</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cart as $prod)
                                                                    <tr>
                                                                        <td>
                                                                         
                                                                            <h6 class="mb-0 text-xs">{{$prod->name}}</h6>
                                                                        </td>
                                                                        <td>
                                                                            <h6 class="mb-0 text-xs">{{$prod->attributes->codigo}}</h6>
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
                                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                                <button title="Eliminar Producto" href="javascript:void(0)"
                                                                                    wire:click="deleteItem({{ $prod->id }})" class="btn btn-danger" 
                                                                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                                    <i class="fas fa-trash-alt"></i>
                                                                                </button>
                                                                            </div>
                                                                            {{-- <a href="javascript:void(0)"
                                                                                wire:click="deleteItem({{ $prod->id }})"
                                                                                class="btn btn-danger p-1" title="Eliminar Item">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a> --}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <h5><b>TOTAL.-</b></h5>
                                                                        </td>
                                                                        <td colspan="5">
                                                                            <h5><b>{{$total_compra}}</b></h5>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </tbody>
                                                        </table>
                                                    
                                            </div>
                                        </div>
                                    </div>
                               
                            </div>

                            <div class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info" wire:click.prevent="guardarCompra()">ACTUALIZAR</button>
                                    <button type="button" class="btn btn-danger" wire:click.prevent="exit()">CANCELAR</button>
                                </div>
                            </div>
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
 