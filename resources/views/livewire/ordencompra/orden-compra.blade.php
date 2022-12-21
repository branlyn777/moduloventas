<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0" style="font-size: 16px">Ordenes de Compra</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="detalle_orden_compras" class="btn bg-gradient-primary btn-sm mb-0">Registrar Orden</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2 text-center">
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

                        <div class="col-12 col-sm-6 col-md-2 text-center">
                            <b>Estado</b>
                            <div class="form-group">
                                <select wire:model="estado" class="form-select">
                                    <option value='ACTIVO' selected>Activo</option>
                                    <option value='INACTIVO'>Anulado</option>
                                    <option value='Todos'>Todos</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-2 text-center">
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

                        @if($this->fecha=='fechas')
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-2 text-center">
                                    <b>Fecha Inicio</b>
                                    <div class="form-group">
                                        <input type="date" wire:model="fromDate" class="form-control flatpickr" >
                                    </div>
                                </div>
                
                                <div class="col-12 col-sm-6 col-md-2 text-center">
                                    <b>Fecha Fin</b>
                                    <div class="form-group">
                                        <input type="date" wire:model="toDate" class="form-control flatpickr" >
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center" style="font-size: 12px">
                                                <th class="text-center" style="width: 2%">#</th>                                
                                                <th class="text-center" style="width: 5%">COD.</th>                                
                                                <th class="text-center">FECHA</th>                                                                               
                                                <th class="text-center">PROVEEDORES</th>                                                                               
                                                <th class="text-center">ESTADO</th>
                                                <th class="text-center">USUARIO</th>
                                                <th class="text-center">TOTAL</th>
                                                <th class="text-center">ACC.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_orden_compras as $data)
                                                <tr class="text-center"  style="font-size: 12px">
                                                    <td>
                                                        <h6>{{ $loop->index+1}}</h6>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary mb-0">{{ $data->id}}</span>
                                                    </td>
                                                    <td>
                                                        <center> {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}
                                                        <br>
                                                        {{\Carbon\Carbon::parse($data->created_at)->format('h:i:s a')}}</center>
                                                    </td>
                                                    <td>
                                                        <h6 wire:key="{{ $loop->index }}">{{ $data->proveedor->nombre_prov}}</h6>
                                                    </td>
                                            
                                                    @if( $data->status == 'ACTIVO')
                                                        <td >
                                                            <span class="badge badge-success mb-0">{{$data->status}}</span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-warning mb-0">ANULADO</span>
                                                        </td>
                                                    @endif

                                                    <td>
                                                        <h6>{{ $data->usuario->name }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ $data->importe_total }}</h6>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" wire:click= "VerDetalleCompra('{{$data->id}}')"
                                                            class="boton-celeste p-1" title="Listar orden de compra">
                                                            <i class="fas fa-list"></i>
                                                        </a>
                                                        {{-- <a href="javascript:void(0)" wire:click= "editarCompra('{{$data->id}}')"
                                                            class="btn btn-dark p-1" title="Editar orden de compra">
                                                            <i class="fas fa-edit"></i>
                                                        </a> --}}
                                                        <a href="{{ url('OrdenCompra/pdf' . '/' . $data->id)}}"  
                                                            class="btn btn-success p-1" title="Imprimir orden de compra">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" wire:click="anularOrden('{{ $data->id }}')"
                                                            class="btn btn-danger p-1" title="Anular orden compra">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        {{-- <tfoot class="text-white text-right">
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
                                            
                                        </tfoot> --}}
                                    </table><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.ordencompra.verDetalleOrden')
</div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {

      
        window.livewire.on('verDetalle', msg => {
            $('#detalleOrden').modal('show')
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

        window.livewire.on('anulacion_compra', msg => {
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
    })


    </script>