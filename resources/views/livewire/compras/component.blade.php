
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h2 class="text-center">
                    <b>LISTA DE COMPRAS</b>
                </h2>
                <ul class="row justify-content-end">
                        <a href="detalle_compras" class="btn btn-outline-primary">Registrar Compra</a>
           
                </ul>
               
            </div>

            <div class="widget-body">

                <div class="row">

                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <b wire:click="limpiarsearch()" style="cursor: pointer;">Buscar...</b>
                        <div class="form-group">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-gp">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" wire:model="search" placeholder="Buscar por Nro.Documento,Proveedor,Usuario" class="form-control">
                            </div>
                        </div>
                    </div>
            
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <b>Seleccionar Sucursal</b>
                        <div class="form-group">
                            <select wire:model="sucursal_id" class="form-control">
                                @foreach($listasucursales as $sucursal)
                                <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                                @endforeach
                                <option value="Todos">Todas las Sucursales</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <b>Estado</b>
                        <div class="form-group">
                            <select wire:model="estado" class="form-control">
                                <option value='ACTIVO' selected>Activo</option>
                                <option value='INACTIVO'>Anulado</option>
                                <option value='Todos'>Todos</option>
                            </select>
                        </div>
                    </div>
    
               
                    <div class="col-12 col-sm-6 col-md-2 text-center">
                        <b>Tipo de Fecha</b>
                        <div class="form-group">                              
                                <select wire:model="fecha" class="form-control">
                                    <option value='hoy' selected>Hoy</option>
                                    <option value='ayer'>Ayer</option>
                                    <option value='semana'>Semana</option>
                                    <option value='fechas'>Entre Fechas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-1 text-center">
                        <b>Otros</b>
                        <div class="btn-group form-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              Ver
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" wire:click= "VerComprasProducto()">Compras por producto</a>
                              <a class="dropdown-item" wire:click= "VerProductosProveedor()">Productos por proveedor</a>

                            </div>
                          </div>
                    </div>
    
                </div>
                @if($this->fecha != "hoy" and $this->fecha != 'ayer' and $this->fecha != 'semana')

                <div class="row">
    
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <b>Fecha Inicio</b>
                        <div class="form-group">
                            <input type="date" wire:model="fromDate" class="form-control flatpickr" >
                        </div>
                    </div>
    
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <b>Fecha Fin</b>
                        <div class="form-group">
                            <input type="date" wire:model="toDate" class="form-control flatpickr" >
                        </div>
                    </div>
                
                </div>
    
                @endif
    

    {{--tabla que muestra todas las compras--}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget-content">
                            <div class="table-5">
                                <table>
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-center">#</th>                                
                                            <th class="text-center">FECHA</th>                                
                                            <th class="text-center">PROVEEDOR</th>                                
                                            <th class="text-center">DOCUMENTO</th>                                
                                            <th class="text-center">TIPO<br>COMPRA</br></th>                                
                                            <th class="text-center">TOTAL<br>COMPRA</br></th>                                
                                                          
                                            <th class="text-center">ESTADO</th>
                                            <th class="text-center">USUARIO</th>
                                            <th class="text-center">ACC.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_compras as $data)
                                            <tr>
                                                <td class="text-center" >
                                                    <h6>{{ $loop->index+1}}</h6>
                                                </td>
                                                <td>
                                                   
                                                    <center> {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}
                                                        <br>
                                                        {{\Carbon\Carbon::parse($data->created_at)->format('h:i:s a')}}</center>
                                                </td>
                                                <td>
                                                    <h6 class="text-center" wire:key="{{ $loop->index }}">{{ $data->nombre_prov}}</h6>
                                                </td>
                                                <td>
                                                    <center><h6>{{$data->tipo_doc}}</h6>
                                                        <h6 class="text-center">{{ $data->nro_documento }}</h6></center>
                                                    
                                                </td>
                                                <td>
                                                    <h6 class="text-center">{{ $data->transaccion }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="text-center">{{ $data->imp_tot }}</h6>
                                                </td>
                                           
                                              
                                                @if( $data->status == 'ACTIVO')
                                                <td class="text-center" >
                                               <span class="badge badge-success mb-0">{{$data->status}}</span>
                                                </td>
                                                @else
                                                <td class="text-center">
                                                  <span class="badge badge-warning mb-0">ANULADO</span>
                                                </td>
                                                @endif
                                                <td>
                                                    <h6 class="text-center">{{ $data->username }}</h6>
                                                </td>
                                              
                                                
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" wire:click= "VerDetalleCompra('{{$data->id}}')"
                                                        class="boton-celeste p-1" title="Listar compra">
                                                        <i class="fas fa-list"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" wire:click= "editarCompra('{{$data->id}}')"
                                                        class="btn btn-dark p-1" title="Editar compra">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ url('Compras/pdf' . '/' . $data->id)}}"  
                                                        class="btn btn-success p-1" title="Imprimir detalle compra">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" wire:click="Confirm('{{ $data->id }}')"
                                                        class="btn btn-danger p-1" title="Anular compra">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                        <tfoot class="text-white text-right">
                                            <tr>
                                                <td colspan="5">
                                                     <h5 class="text-dark">Total Bs.-</h5>
                                                     <h5 class="text-dark">Total $us.-</h5>
                                                </td>
                                                <td>
                                                    <h5 class="text-dark text-center">{{$totales}}</h5>
                                                    <h5 class="text-dark text-center">{{round($totales/6.96,2)}}</h5>
                                                </td>
                                                <td  colspan="4">

                                                </td>
                                            </tr>
                                            
                                    </tfoot>
                                </table>
                          
                           
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @include('livewire.compras.verDetallecompra')
    @include('livewire.compras.compra_producto')
    @include('livewire.compras.producto_proveedor')
   </div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('purchase-deleted', msg => {
            noty(msg)
        });
        window.livewire.on('purchase-error', msg => {
            noty(msg)
        });
        window.livewire.on('verDetalle', msg => {
            $('#detalleCompra').modal('show')
        });
        window.livewire.on('comprasproducto', msg => {
            $('#compraprod').modal('show')
        });
        window.livewire.on('productoproveedor', msg => {
            $('#prodprov').modal('show')
        });
        window.livewire.on('erroreliminarCompra', msg => {
            swal.fire({
                title: 'ERROR',
                icon: 'warning',
                text: 'La compra no puede ser eliminada por que uno de los items ya ha sido distribuido.'              
            })
        });
        window.livewire.on('preguntareliminarCompra', msg => {
            //console.log(msg);
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: '¿Esta seguro de anular la compra?',
                showCancelButton: true,
                cancelButtonText: 'Cerrar'
                
            }).then(function(result){
                if(result.value){
                    console.log(msg);
                    window.livewire.emit('deleteRow',msg).Swal.close()
                }
            })
        });
    })


    </script>