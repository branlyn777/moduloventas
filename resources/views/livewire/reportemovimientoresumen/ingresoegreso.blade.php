<div class="container-fluid my-5 py-2">
    
     
     
                <h4 class="text-white">
                    <b>Ingresos y Egresos</b>
                </h4>

                <ul class="row justify-content-end">
              
                </ul>
                <ul class="row justify-content-end">
                    @can('Ver_Generar_Ingreso_Egreso_Boton')
                        <button wire:click.prevent="viewDetails()" class="boton-blanco-g">
                            <i class="fas fa-arrow-alt-circle-down" ></i>  <i class="fas fa-arrow-alt-circle-up" ></i> Generar Ingreso/Egreso
                        </button>
                        <button wire:click.prevent="generarpdf({{$data}})" class="boton-verde-g">
                          <i class="fas fa-print" ></i> Generar PDF
                        </button>
                    @endcan
                </ul>
              
        
            <div class="row">

                <div class="col-sm-12 col-md-12 d-flex">
                    @foreach ($grouped as $key=>$item)
                    <div class="card m-2 p-2" style="width: 18rem;  border-radius: 7px; border: #a4f9ff solid 2px;">
                    
                        <h6 class="card-title">
                            <b>Caja: {{ $key }},</b>
                            
                        </h6>
                        @foreach ($item as $dum)
                            
                       <div>{{$dum->carteraNombre}}:{{$dum->monto}}</div> 
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="form-group" >
                        <label>Buscar</label>
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

                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                                    <label>Fecha inicial</label>
                                    <input type="date" wire:model="fromDate" class="form-control">
                                    @error('fromDate')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                   </div>
                </div>
                <div class="col-sm-12 col-md-2">
                   <div class="form-group">
                                    <label>Fecha final</label>
                                    <input type="date" wire:model="toDate" class="form-control">
                                    @error('toDate')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                   <div class="form-group">
                                    <label>Cajas</label>
                                    <select wire:model="caja" class="form-control">
                                        @foreach ($cajas2 as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                        <option value="TODAS">TODAS</option>
                                    </select>
                                           
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                   <div class="form-group">
                                    <label>Sucursal</label>
                                    <select wire:model="sucursal" class="form-control">
                                        @foreach ($sucursals as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                           
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                   <div class="form-group">
                                    <label>Categoria</label>
                                    <select wire:model='categoria_id' class="form-control">
                                        <option value="Todos">Todas las Categorias</option>
                                        @foreach ($categorias as $c)
                                            <option value="{{ $c->id }}">{{ $c->nombre }} - {{ $c->tipo }}</option>
                                        @endforeach
                                    </select>
                                           
                    </div>
                </div>

            </div>
                <div class="widget-content">
                    <div class="table-5">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>FECHA</th>
                                    <th>MOVIMIENTO</th>
                                    <th>CATEGORIA</th>
                                    <th>CAJA</th>
                                    <th>CARTERA</th>
                                    <th>IMPORTE</th>
                                    <th>MOTIVO</th>
                                    <th>USUARIO</th>
                                    <th>ESTADO</th>
                                    <th>ACC.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $p)
                                    <tr>
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">{{ $loop->iteration }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">
                                                {{\Carbon\Carbon::parse($p->movimientoCreacion)->format('d/m/Y H:i') }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">
                                                {{ $p->carteramovtype }}</h6>
                                        </td>
                                     
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">
                                                @if($p->nombrecategoria != null)
                                                    <b>{{ $p->nombrecategoria }}</b>
                                                @else
                                                    Sin Categoria
                                                @endif


                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">
                                                {{ $p->cajaNombre }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">{{ $p->nombre }}
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">  {{ number_format($p->import,2) }}
                                            </h6>
                                        </td>
                                        <td>
                                            @if ($p->tipoDeMovimiento=='SOBRANTE')
                                            <h6 class="text-center" style="font-size: 100%">SOBRANTE:{{ $p->comentario }}
                                            </h6>
                                            @elseif($p->tipoDeMovimiento=='FALTANTE')
                                            <h6 class="text-center" style="font-size: 100%">FALTANTE:{{ $p->comentario }}
                                            </h6>
                                            @else
                                            <h6 class="text-center" style="font-size: 100%">{{ $p->comentario }}
                                            </h6>
                                            @endif
                                       
                                        </td>
                                   
                                        <td>
                                            <h6 class="text-center" style="font-size: 100%">
                                                {{ $p->usuarioNombre }}</h6>
                                        </td>

                                        @if( $p->movstatus == 'ACTIVO')
                                        <td>
                                            <h6 class="text-center text-white bg-primary">{{ $p->movstatus }}</h6>
                                        </td>
                                        @else
                                        <td>
                                            <h6 class="text-center text-white bg-danger">ANULADO</h6>
                                        </td>
                                        @endif

                                        @if ($p->movstatus == 'INACTIVO')

                                        <td>
                                            <div class="btn-group m-1" role="group" aria-label="Basic example">
                                                <button disabled  wire:click="anularOperacion({{$p->movid}})" class="btn btn-sm" title="sin accion" style="background-color: rgb(10, 137, 235); color:white">
                                                    <i class="la flaticon-cross"></i>
                                                </button>
                                            
                                            </div>
                                        </td>
                                        @else
                                            
                                        <td>
                                            <div class="btn-group m-1" role="group" aria-label="Basic example">
                                                <button href="javascript:void(0)" onclick="Confirm('{{ $p->movid }}')" class="btn btn-sm" title="Anular Ingreso/Egreso" style="background-color: rgb(10, 137, 235); color:white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                             
                                                <button  wire:click="editarOperacion({{$p->movid}})" class="btn btn-sm" title="Editar Ingreso/egreso" style="background-color: rgb(0, 104, 21); color:white">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                        </td>
                                       
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>

                                    <td colspan="5">
                                        <h6 class="text-right p-l-1" colspan="5" style="font-size: 100%">
                                         <b>TOTAL Bs.</b></h6>
                                    </td>
                                    <td colspan="1">
                                        <h6 class="text-center" colspan="5" style="font-size: 100%">
                                          {{ number_format($sumaTotal,2) }} </h6>
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="5">
                                        <h6 class="text-right p-l-1" colspan="5" style="font-size: 100%">
                                         <b>TOTAL $us.</b></h6>
                                    </td>
                                    <td colspan="1">
                                        <h6 class="text-center" colspan="5" style="font-size: 100%">
                                            {{ number_format($sumaTotal/$cot_dolar,2) }} </h6>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
         
       
   
    @include('livewire.reportemovimientoresumen.modalDetails')
    @include('livewire.reportemovimientoresumen.modaleditar')
  
</div>

@section('javascript')

<script>

    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#modal-details').modal('show')
        });
        window.livewire.on('editar-movimiento', Msg => {
            $('#modal-mov').modal('show')
            });
            window.livewire.on('hide_editar', Msg => {
                $('#modal-mov').modal('hide')
            });
            window.livewire.on('hide-modal', Msg => {
                $('#modal-details').modal('hide')
                noty(Msg)
            });
            
            window.livewire.on('openothertap', Msg => {
                var win = window.open('report/pdfingresos');
                // Cambiar el foco al nuevo tab (punto opcional)
                //win.focus();
                
            });

            function ConfirmarOperacionSinCorte()
                {
                    swal({
                        title: 'Transaccion sin corte de caja',
                        text: "No ha realizado corte de caja, la transaccion no pertenecera a ninguna caja¿Desea proseguir con la operacion?",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Proseguir',
                        padding: '2em'
                        }).then(function(result) {
                        if (result.value) {
                            window.livewire.emit('op_sn_corte')
                            }
                        })
                }
                    });
                    

  
    function Confirm(id){
        
        Swal.fire({
            title: 'Esta seguro de anular esta operacion?',
            text: "Esta accion es irreversible",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                
                window.livewire.emit('eliminar_operacion',id);
                
                Swal.fire(
                    'Anulado!',
                    'El registro fue anulado con exito',
                    'success'
                    )
                }
            })
            
        }
        
        
        </script>
        
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    
@endsection