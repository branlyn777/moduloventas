<div class="widget-content">
        <h2 class="text-center">
            <b>RESUMEN MOVIMIENTOS</b>
        </h2>

        <ul class="row justify-content-start">
            <div class="col-sm-12 col-md-2">
                <div class="form-group">
                                 <label>Sucursal</label>
                                 <select wire:model="sucursal" class="form-control">
                                     @foreach ($sucursales as $item)
                                     <option wire:key="item-{{ $item->id }}" value="{{$item->id}}">{{$item->name}}</option>
                                     @endforeach
                                     <option value="TODAS">TODAS</option>
                                    
                                 </select>
                                        
                 </div>
            </div>
            <div class="col-sm-12 col-md-2">
                <div class="form-group">
                                 <label>Caja</label>
                                 <select wire:model="caja" class="form-control">
                                     @foreach ($cajas as $item)
                                     <option  wire:key="item-{{ $item->id }}" value="{{$item->id}}">{{$item->nombre}}</option>
                                     @endforeach
                                     <option value="TODAS">TODAS</option>
                                    
                                 </select>
                                        
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
         
       
        </ul>
        <ul class="row justify-content-end">
         
{{--               
                <button wire:click="viewDetailsR()" class="boton-azul-g">
                    Generar Recaudo
                </button> --}}
               
                <button wire:click="generarpdf({{$totalesIngresosV}}, {{$totalesIngresosS}}, {{$totalesIngresosIE}}, {{$totalesEgresosV}}, {{$totalesEgresosIE}}, {{$op_sob_falt}})" class="boton-verde-g">
                    <i class="fas fa-print" ></i>  Generar PDF
                </button>
         
       
        </ul>
    <div class="table-6">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>FECHA</th>
                     
                        <th>DETALLE</th>
                        
                        <th>INGRESO</th>
                        <th>EGRESO</th>
                        <th>
                            @if(@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                            UTILIDAD
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($totalesIngresosV as $p)
                        <tr class="text-center">
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                            </td>
                          
                            <td class="text-center">
                                <b>{{ $p->idventa }},{{ $p->tipoDeMovimiento }},{{ $p->ctipo =='CajaFisica'?'Efectivo':$p->ctipo }},({{ $p->nombrecartera }})</b>
                            </td>
                            <td class="text-right">
                                {{ number_format($p->importe,2) }}
                            </td>
                            <td>
                                
                            </td>
                            <td class="text-right">
                                @if(@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                {{ number_format($p->utilidadventa,3) }}
                                @endif
                            </td>

                            
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <table>
                                    <thead class="cabeza">
                                        <tr class="text-center">
                                            <td>
                                                Nombre
                                            </td>
                                            <td>
                                                Precio Original
                                            </td>
                                            <td>
                                                Desc/Rec
                                            </td>
                                            <td>
                                                Precio Venta
                                            </td>
                                            <td>
                                                Cantidad
                                            </td>
                                            <td>
                                                Total
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($p->detalle as $item)
                                        <tr class="fila">
                                            <td>
                                                {{-- {{rtrim(mb_strimwidth($item['nombre'], 2, 2, '...', 'UTF-8'))}} --}}
                                                {{-- {{$item['nombre']}} --}}
                                                {{substr($item->nombre, 0, 17)}}
                                            </td>
                                            <td>
                                                {{number_format($item->po,2)}}
                                            </td>
                                            <td>
                                                @if($item->po - $item->pv == 0)
                                                {{$item->po - $item->pv}}
                                                @else
                                                {{($item->po - $item->pv) * -1}}
                                                @endif
                                            </td>
                                            <td>
                                                {{number_format($item->pv,2)}}
                                            </td>
                                            <td>
                                                {{$item->cant}}
                                            </td>
                                            <td>
                                                {{number_format($item->pv * $item->cant,2)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    @foreach ($totalesIngresosS as $p)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                            </td>
                          
                            <td class="text-center">
                                <b>{{ $p->idordenservicio }},{{ $p->tipoDeMovimiento }}, {{$p->nombrecategoria}} ,{{ $p->ctipo =='CajaFisica'?'Efectivo':$p->ctipo }},({{ $p->nombrecartera }})</b>
                            </td>
                            <td class="text-right">
                                {{ number_format($p->importe,2) }}
                            </td>
                            <td>
                                
                            </td>
                            <td class="text-right">
                                @if(@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                {{ number_format($p->utilidadservicios,2) }}
                                @endif
                            </td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                {{ucwords(strtolower($p->solucion))}} 
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    @foreach ($totalesIngresosIE as $m)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($m->movcreacion)->format('d/m/Y H:i') }}
                        </td>
                      
                        <td class="text-center">
                            <b>{{ $m->ctipo =='CajaFisica'?'Efectivo':$m->ctipo }},({{ $m->nombrecartera }})</b>
                            
                        </td>
                        <td class="text-right">
                            {{ number_format($m->importe,2) }}
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            {{$m->coment}}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach 


                @foreach ($totalesEgresosV as $p)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($p->movcreacion)->format('d/m/Y H:i') }}
                    </td>
                  
                    <td class="text-center">
                        <b>{{ $p->tipoDeMovimiento }},Devolución,{{ $p->ctipo =='CajaFisica'?'Efectivo':$p->ctipo }},{{ $p->nombrecartera }}</b>
                    </td>
                    <td>
                        
                    </td>
                    <td class="text-right">
                        {{ number_format($p->importe,2) }}
                    </td>
                    <td>
                        
                    </td>
                    
                </tr>
                @endforeach

                @foreach ($totalesEgresosIE as $st)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($st->movcreacion)->format('d/m/Y H:i') }}
                    </td>
                
                    <td class="text-center">
                        <b>{{ $st->ctipo =='CajaFisica'?'Efectivo':$st->ctipo }},({{ $st->nombrecartera }})</b>
                    </td>
                    <td>
                    
                    </td>
                    <td class="text-right">
                        {{ number_format($st->importe,2) }}
                    </td>
                    <td>
                        
                    </td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                        {{$st->coment}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach

      
            <tfoot>
                <tr>
                    <td colspan="6">

                    </td>
                </tr>
                      {{-- SUBTOTAL OPERACIONES --}}
                      <tr>
                        <td colspan="3">
                            <h5 class="text-dark text-right" style="font-size: 1rem!important;"><b> TOTAL OPERACIONES </b></h5>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($subtotalesIngresos,2) }}</b>
                        </td>
                        <td class="text-right">
                            <b>{{ number_format($EgresosTotales,2) }}</b>
                        </td>
                        <td class="text-right">
                            @if(@Auth::user()->hasPermissionTo('VentasMovDiaSucursalUtilidad'))
                                <b>{{ number_format($totalutilidadSV,2) }}</b>
                            @endif
                        </td>
                        </tr>
                    </tfoot>
              </tbody>
        </table>
    </div>

    <div class="row">
            <div class="col-lg-5">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                             
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-center"><b> Ingresos en Efectivo </b></h5>
                                    </td>
                                    <td class="ml-2">
                                        <h5 class="text-dark text-center">{{ number_format($ingresosTotalesCF,2)}}</h5>
                                    </td>
                                </tr>
                             
                    
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-center" ><b> Ingresos por Bancos </b></h5>
                                    </td>
                                    <td class="ml-2">
                                        <h5 class="text-dark text-center" >{{ number_format($this->ingresosTotalesNoCFBancos,2)}}</h5>
                                    </td>
                                </tr>
                             
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-left m-0" ><b> Ingresos Totales </b></h5>
                                    </td>
                                    <td>
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        <h5 class="text-dark text-center m-0" ><b>{{ number_format($subtotalesIngresos,2)}}</b></h5>
                                    </td>
                                </tr>
                     
               
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-left" ><b> Egresos Totales en Efectivo </b></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark text-center m-0" ><b>{{ number_format($EgresosTotalesCF,2)}} </h5></b>
                                      
                                    </td>
                                </tr>
 
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-left" ><b> Saldo Ingresos/Egresos Totales </b></h5>
                                    </td>
                                    <td>
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        <h5 class="text-dark text-center m-0" > {{ number_format($subtotalcaja,2)}}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-left" ><b> Saldo en Efectivo Hoy </b></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark text-center m-0" > <b>{{ number_format($operacionesefectivas,2)}}</b> </h5>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>
                                        <h5 class="text-dark text-center mr-1"><b> Saldo por Operaciones en TigoMoney </b></h5>
                                    </td>
                               
                                    <td>
                                        <h5 class="text-dark text-center mr-1" >{{ number_format($total,2)}} </h5>
                                    </td>
                                  
                                </tr> --}}
                                <tr>
                                    <td>
                                        <h5 class="text-dark text-left" ><b> Saldo Acumulado Dia Ant. </b></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-dark text-center m-0" >{{ number_format($ops,2)}} </h5>
                                    </td>
                                </tr>
                             

                                <tr>
                                    <td>
                                        <h5 class="text-dark text-left" ><b> Total Efectivo </b></h5>
                                    </td>
                                    <td>
                                        <hr class="m-0 p-0" width="50%" style="background-color: black">
                                        <h5 class="text-dark text-left" > <b> {{ number_format($operacionesW,2)}}</b></h5>
                                    </td>
                                </tr>
                               
                                
                    </div>
            </div>

           <div class="col-lg-5">
                <div class="table-responsive">
                    <table>
                        <tbody>
                            @if ($caja != 'TODAS')
                                <tr style="height: 2rem"></tr>
                        
                                <tr class="p-5">
                                <td>
                                        <h5 class="text-dark text-left"><b> Recaudo </b></h5>
                                </td>
                                <td>
                                    <h5 class="text-dark text-center m-0" > {{ number_format($op_recaudo,2) }}</h5>
                            
                                </td>
                    
                                </tr>
                                <tr class="p-5">


                                    @foreach ($op_sob_falt as $values)
                                        
                                    <td>
                                        <h5 class="text-dark text-left"><b> {{$values->tipo_sob_fal}} </b></h5>
                                    </td>
                                    <td>
                                    <h5 class="text-dark text-center m-0" > {{ number_format($values->import,2) }}</h5>
                                
                                    </td>
                                    @endforeach
                    
                                </tr>
                                <tr class="p-5">
                                <td>
                                        <h5 class="text-dark text-left"><b> Nuevo Saldo Caja Fisica </b></h5>
                                </td>
                                <td>
                                    <h5 class="text-dark text-center m-0" > {{ number_format($operacionesZ,2) }}</h5>
                            
                                </td>
                    
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        
    @include('livewire.reportemovimientoresumen.modalDetailsr')

 </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
         
            window.livewire.on('show-modalR', Msg => {
            $('#modal-detailsr').modal('show')
            })
            window.livewire.on('hide-modalR', Msg => {
                $('#modal-detailsr').modal('hide')
                noty(Msg)
            })
            window.livewire.on('tigo-delete', Msg => {
                noty(Msg)
            })
            //Llamando a una nueva pestaña donde estará el pdf modal
            window.livewire.on('opentap', Msg => {
                var win = window.open('report/pdfmovdiaresumen');
                // Cambiar el foco al nuevo tab (punto opcional)
                //win.focus();

            });
        });
    </script>

