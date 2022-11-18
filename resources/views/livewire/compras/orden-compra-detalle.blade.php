
@section('css')

<style>
  .table-wrapper {
    width: 100%;/* Anchura de ejemplo */
    height: 350px; /* Altura de ejemplo */
    overflow: auto;
    }

    .table-wrapper table {
        border-collapse: separate;
        border-spacing: 0;
        border-left: 0.3px solid #02b1ce;
        border-bottom: 0.3px solid #02b1ce;
        width: 100%;
    }

    .table-wrapper table thead {
        position: -webkit-sticky; /* Safari... */
        position: sticky;
        top: 0;
        left: 0;
    }
    .table-wrapper table thead tr {
    background: #02b1ce;
    color: white;
    }
    /* .table-wrapper table tbody tr {
        border-top: 0.3px solid rgb(0, 0, 0);
    } */
    .table-wrapper table tbody tr:hover {
        background-color: #ffdf76a4;
    }
    .table-wrapper table td {
        border-top: 0.3px solid #02b1ce;
        padding-left: 10px;
        border-right: 0.3px solid #02b1ce;
    }
</style>
@endsection
<div class="row sales layout-top-spacing">
    <div class="col-sm-12" >

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <div class="col-12 col-lg-12 col-md-10 mt-3">
                    <div class="row mb-3" >
                        <div class="col-lg-11" >
                            <h5 class="mb-2 mt-2">ORDEN DE COMPRA</h5>
                            <b style="color: rgb(74, 74, 74)">Fecha: </b>
                            {{-- {{$fecha_compra}}<br/>   --}}
                            <b style="color: rgb(74, 74, 74)">Registrado por: </b> 
                            {{-- {{$usuario}}<br/> --}}
                            
                        </div>
                        
                        <div class="col-lg-1 col-sm-1 col-md-1">
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#theModal" class="btn btn-primary p-1 m-1" > <strong> Registrar Producto</strong></a>
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
                                                    {{-- @foreach($data_prov as $datas)
                                                        <option value="{{$datas->nombre_prov}}">{{$datas->nombre_prov}}</option>
                                                    @endforeach --}}
                                                 </datalist>
                                                   
                                                         <button data-toggle="modal" class="btn btn-dark pl-2 pr-2"
                                                             data-target="#modal_prov" > <i class="fas fa-plus text-white"></i> </button>
                                                  
                                              </div>
                                             {{-- @error('provider')
                                                 <span class="text-danger er">{{ $message }}</span>
                                             @enderror --}}
                                           </div>
                                     </div>
                                <div class="col-lg-12">
                                        
                                        <div class="form-group">
                                            <strong style="color: rgb(74, 74, 74)">Destino Producto</strong>
                                            {{-- <select wire:model.lazy="destino" class="form-control">
                                                <option value='Elegir'>Elegir Destino</option>

                                              @foreach($data_suc as $data)
                                                <option value="{{$data->destino_id}}">{{$data->nombre}}-{{$data->name}}</option>
                                              @endforeach
                                              
                                            </select> --}}
                                          </div>
                                        
                                          {{-- @error('destino')
                                                 <span class="text-danger er">{{ $message }}</span>
                                          @enderror --}}
                                     </div>

                                 </div>
                             </div>

                             <div class="col-12 col-md-4 col-lg-4" style="border: thick #b4b4b1;" >
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <strong style="color: rgb(74, 74, 74)">Tipo de Documento:</strong>
                                          {{-- <select wire:model='tipo_documento' class="form-control">
                                              <option value='FACTURA' selected>Factura</option>
                                              <option value='NOTA DE VENTA'>Nota de Venta</option>
                                              <option value='RECIBO'>Recibo</option>
                                              <option value='NINGUNO'>Ninguno</option>
                                          </select>
                                          @error('tipo_documento')
                                              <span class="text-danger er">{{ $message }}</span>
                                          @enderror                                           --}}
                                       </div>
                                    </div>
   
                                 
    
                                   
                                </div>
                              
                               
                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <strong style="color: rgb(74, 74, 74)">Pago:</strong>

                                            @if($tipo_transaccion == "CONTADO")
                                            <div class="input-group-prepend mb-3">
                                                 <input  wire:model='pago_parcial' type="text" disabled class="form-control" placeholder="Bs. 0">
                                                
                                            </div>
                                           @else
                                           <div class="input-group-prepend mb-3">
                                                <input  wire:model='pago_parcial' type="text" class="form-control" placeholder="Bs. 0">
                                              
                                            </div>
                                           @endif
                                           @error('pago_parcial')
                                           <span class="text-danger er">{{ $message }}</span>
                                           @enderror
                                       </div>
                                    </div> --}}

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
            <hr style="height:3px;border:none;color:rgb(189, 188, 188);background-color:rgb(230, 152, 64);" />

            <div class="widget-content">
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
                                
{{--                                     
                                    @if(strlen($search) > 0)
                                    <div class="col-lg-12 col-12 col-sm-12">
                                        <h6 class="rounded">
                                            <b>Elementos encontrados:</b> {{$data_prod->count()}}
                                        </h6>
                                    </div>
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
                                                         <button wire:click="increaseQty({{ $prod->id }})"
                                                             class="boton-azul">
                                                             <i class="fas fa-plus"></i>
                                                         </button>
                                                        
                                                     </td>
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             @endif --}}
                                
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
                                            {{-- @foreach ($cart as $prod)
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
                                                        <a href="javascript:void(0)"
                                                        wire:click="removeItem({{ $prod->id }})"
                                                        class="btn btn-danger p-1" title="Quitar Item">
                                                            <i class="fas fa-trash"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            <tfoot>
                                                    {{-- <tr>
                                                        <td colspan="5">
                                                             <h5 class="text-dark" style="font-size: 1rem!important;">SubTotal.-</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-dark" style="font-size: 1rem!important;" >{{$subtotal}}</h5>
                                                        </td>
                                                    </tr> --}}
                                                    {{-- <tr>

                                                        <td colspan="5">
                                                            <a href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#modal_desc"
                                                            class="btn btn-dark mtmobile p-1 m-1 rounded-pill"><strong>%</strong> </i></a>
                                                            <label class="text-dark" style="font-size: 1rem!important;"><strong>Descuento</strong> .-</label>
                                                        </td>
                                                        <td>
                                                            <h5 class="text-dark" >{{$dscto}}</h5>
                                                        </td>
                                                    </tr> --}}
                                                    <tr>
                                                        <td colspan="5">
                                                             <h3 class="text-right">TOTAL.-</h3>
                                                        </td>
                                                        <td colspan="2">
                                                            {{-- <h3 class="text-center">{{$total_compra}}</h3> --}}
                                                        </td>
                                                     
                                                    </tr>
                                            </tfoot>
                                        </tbody>
                                    </table>
                                </div>
                            
                        </div>
                        <div class="row align-items-center justify-content-center">

                                <button class="btn btn-info m-3 p-2"  wire:click.prevent="guardarCompra()">GUARDAR</button>
                                <button class="btn btn-danger m-3 p-2"  wire:click.prevent="exit()" > CANCELAR</button>
                            
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </div>

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
 