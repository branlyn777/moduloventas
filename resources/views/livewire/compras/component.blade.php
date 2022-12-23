<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0" style="font-size: 16px">Lista de Compras</h5>
                        </div>
                        
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="detalle_compras" class="btn bg-gradient-primary btn-sm mb-0">Registrar Compra</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            {{-- <b style="font-size: 16px">Buscar</b><br>
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                <input type="text" wire:model="search" placeholder="Buscar por Nro.Documento,Proveedor,Usuario"
                                        class="form-control">
                                <div class="btn-group" role="group">
                                    {{-- <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Uno link</a></li>
                                        <li><a class="dropdown-item" href="#">Dos link</a></li>
                                    </ul> --}}
                                    {{-- <select wire:model="tipo_search" class="form-control btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <option value="codigo"> Cod. Compra</option>
                                        <option value="proveedor">Proveedor</option>
                                        <option value="usuario">Usuario</option>
                                        <option value="documento">Documento</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <b wire:click="limpiarsearch()" style="cursor: pointer; font-size: 16px">Buscar</b><br> --}}
                            <b style="font-size: 16px">Buscar</b><br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <div class="input-group mb-4">
                                    <span class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" wire:model="search" placeholder="Buscar por Nro.Documento,Proveedor,Usuario"
                                        class="form-control">
                                </div>
                                <div class="input-group mb-4">
                                    <select wire:model="tipo_search" class="form-select">
                                        <option value="codigo"> Cod. Compra</option>
                                        <option value="proveedor">Proveedor</option>
                                        <option value="usuario">Usuario</option>
                                        <option value="documento">Documento</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <div class="input-group mb-4">
                                    <span class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" wire:model="search" placeholder="Buscar por Nro.Documento,Proveedor,Usuario" 
                                        class="form-control">
                                    <select wire:model="tipo_search" class="form-select" style="text-align: center">
                                        <option value="codigo"> Cod. Compra</option>
                                        <option value="proveedor">Proveedor</option>
                                        <option value="usuario">Usuario</option>
                                        <option value="documento">Documento</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    
                        <div class="col-12 col-sm-6 col-md-3">
                            <b>Seleccionar Sucursal</b>
                            <div class="form-group">
                                <select wire:model="sucursal_id" class="form-select">
                                    @foreach($listasucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                                    @endforeach
                                    <option value="Todos">Todas las Sucursales</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <b>Estado</b>
                            <div class="form-group">
                                <select wire:model="estado" class="form-select">
                                    <option value='ACTIVO' selected>Activo</option>
                                    <option value='INACTIVO'>Anulado</option>
                                    <option value='Todos'>Todos</option>
                                </select>
                            </div>
                        </div>
            
                        <div class="col-12 col-sm-6 col-md-2">
                            <b>Tipo de Fecha</b>
                            <div class="form-group">                              
                                <select wire:model="fecha" class="form-select">
                                    <option value='hoy' selected>Hoy</option>
                                    <option value='ayer'>Ayer</option>
                                    <option value='semana'>Semana</option>
                                    <option value='fechas'>Entre Fechas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-1">
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
                </div>

                    {{--tabla que muestra todas las compras--}}
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="text-center" style="font-size: 12px">
                                                <th>#</th>                                
                                                <th style="width: 50px;">COD.</th>                                
                                                <th>FECHA</th>                 
                                                <th>PROVEEDOR</th>                                
                                                <th>DOCUMENTO</th>                                
                                                <th>TIPO<br>COMPRA</br></th>                                
                                                <th>TOTAL<br>COMPRA</br></th>                                   
                                                <th>ESTADO</th>
                                                <th>USUARIO</th>
                                                <th>ACC.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($data_compras as $data)
                                                <tr class="text-center"  style="font-size: 12px">
                                                    <td>
                                                        {{ $loop->index+1}}
                                                    </td>
                                                    <td>
                                                        <h6 style="font-size: 12px"><span class="badge bg-secondary">{{ $data->id}}</span></h6>
                                                        {{-- <span class="badge badge-secondary mb-0">{{ $data->id}}</span> --}}
                                                    </td>
                                                    <td>
                                                    
                                                        <center> {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}
                                                            <br>
                                                            {{\Carbon\Carbon::parse($data->created_at)->format('h:i:s a')}}</center>
                                                    </td>
                                                    <td>
                                                        <h6wire:key="{{ $loop->index }}">{{ $data->nombre_prov}}</h6>
                                                    </td>
                                                    <td>
                                                        <center><h6>{{$data->tipo_doc}}</h6>
                                                            <h6 class="text-center">{{ $data->nro_documento ?$data->nro_documento:'S/N' }}</h6></center>
                                                        
                                                    </td>
                                                    <td>
                                                        {{ $data->transaccion }}
                                                    </td>
                                                    <td>
                                                        {{ $data->imp_tot }}
                                                    </td>
                                            
                                                
                                                    @if( $data->status == 'ACTIVO')
                                                    <td>
                                                        <span class="badge badge-sm bg-gradient-success">{{$data->status}}</span>
                                                        {{-- <span class="badge badge-success mb-0">{{$data->status}}</span> --}}
                                                    </td>
                                                    @else
                                                    <td class="text-center">
                                                        <span class="badge text-bg-danger text-white">ANULADO</span>
                                                        {{-- <span class="badge badge-warning mb-0">ANULADO</span> --}}
                                                    </td>
                                                    @endif
                                                    <td>
                                                        {{ $data->username }}
                                                    </td>
                                                
                                                    
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-primary" wire:click= "VerDetalleCompra('{{$data->id}}')"
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                <i class="fas fa-bars" style="font-size: 14px"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-success" wire:click= "editarCompra('{{$data->id}}')"
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                <i class="fas fa-edit text-white" style="font-size: 14px"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-secondary" href="{{ url('Compras/pdf' . '/' . $data->id)}}"
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                <i class="fas fa-print text-white" style="font-size: 14px"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger" wire:click="Confirm('{{ $data->id }}')"
                                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                                <i class="fas fa-minus-circle text-white" style="font-size: 14px"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                    <tfoot class="text-dark text-right">
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center" style="font-size: 14.5px">Total Bs.-</h5>
                                                    <h5 class="text-center" style="font-size: 14.5px">Total $us.-</h5>
                                                </td>
                                                <td>
                                                    <h5 class="text-center" style="font-size: 14.5px">{{$totales}}</h5>
                                                    <h5 class="text-center" style="font-size: 14.5px">{{round($totales/6.96,2)}}</h5>
                                                </td>
                                                <td colspan="4">
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
        window.livewire.on('opentap', Msg => {
         
         var win = window.open('Compras/pdf/{id}');
         // Cambiar el foco al nuevo tab (punto opcional)
         // win.focus();

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