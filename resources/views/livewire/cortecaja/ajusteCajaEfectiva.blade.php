<div wire:ignore.self class="modal fade" id="ajusteCaja" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ajuste de Efectivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

@if ($idcaja!==null)
    
<div class="row justify-content-start table-3">
    <div class="ml-3">

        <div class="row m-2">
            <div class="col-lg-12">

        

                <h2 class="text-dark mb-0 pl-2"
                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 1.5rem; font-weight:500">
                    Control de Efectivo</h2>
        
            
            </div>

        </div>
    {{-- 
            <div class="row justify-content-start">
                <div class="col-lg-12">

                    <h3> <b>Abierta por:</b>{{$usuarioApertura}}</h3>

                    <h3> <b>Fecha de Apertura:</b>{{$fechaApertura}}</h3>
            
                </div>
            </div> --}}


        <div class="row">
            <div class="ml-5 mb-2">
                <table>
                    <tbody>
                        <tr>
                            <td class="text-right">
                                <h3> Transacciones del Dia: </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. {{$hoyTransacciones}}</h3>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class="text-right">
                                <h3> Esperado en Efectivo: </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. {{$saldoAcumulado}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <h3>Efectivo Actual:</h3>
                            </td>
                            <td class="text-right"> <input type="number" style="direction: rtl;"
                                     wire:model='efectivo_actual'></td>
                            <td>

                                <button class="boton-verde p-1" title="Contar Billetes y Monedas"
                                    data-toggle="modal" data-target="#contador_monedas">
                                    <i class="fas fa-calculator"></i>
                                </button>
                            </td>

                        </tr>

                        <br>
                        <tr>
                            <td class="text-right">
                                <h3>{{$efectivo_actual>$saldoAcumulado ? 'Efectivo Sobrante:':'Efectivo
                                    Faltante: '}}
                                </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. {{$efectivo_actual-$saldoAcumulado}}</h3>
                            </td>
                        </tr>
                        @if (($efectivo_actual-$saldoAcumulado) != 0)
                            <tr>
                                <td>
                                    Observacion:
                                </td>
                                <td>
                                    <textarea  wire:model='observacion' class="form-control" aria-label="With textarea"></textarea>
                                </td>
                            </tr>
                        @endif
                        {{-- <tr>
                            <td>

                                <h3 class="text-right"> Recaudar Fondos: </h3>
                            </td>
                            <td>
                                <div class="ml-4">

                                    <label class="switch">
                                        <input type="checkbox" wire:click='mostrar()'>
                                        <span class="slider round"></span>
                                    </label>
                                </div>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Nuevo Saldo Efectivo: </h3>
                            </td>
                        </tr> --}}


                        {{-- @if ($showDiv)

                        <tr>
                            <td>
                                <h3 class="text-right">Monto limite Efectivo:</h3>
                            </td>
                            <td>
                                <h3 class="text-right">{{$monto_limite}}</h3>
                            </td>

                        </tr>
                        <tr>


                            <td>
                                <h3 class="text-right">Efectivo Excedente:</h3>
                            </td>
                            <td>
                                <h3 class="text-right">{{$monto_limite}}</h3>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <h3 class="text-right">Recaudo:</h3>
                            </td>
                            <td>
                                <input type="number" class="form-control" wire:model='recaudo'
                                    style="direction: rtl;">
                            </td>
                        </tr>
                        @endif --}}
                    </tbody>
                </table>
            </div>




        </div>
 
        <div class="row ml-4 mt-4">

            <table>
                <tbody>
    
                    <tr>
                        <td>
                            <h3 class="text-right">Monto limite Efectivo:</h3>
                        </td>
                        <td>
                            <h3 class="text-right">{{$monto_limite}}</h3>
                        </td>
            
                    </tr>
                    <tr>
                  
                            
                        <td>
                            <h3 class="text-right">Efectivo Excedente:</h3>
                        </td>
                        <td>
                            <h3 class="text-right">{{$monto_limite}}</h3>
                        </td>
                
                    </tr>
                    <tr>
                        <td>
                            <h3 class="text-right">Recaudo:</h3>
                        </td>
                        <td>
                            <input type="number" wire:model='recaudo' style="direction: rtl;">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    


       
    </div>




</div>
@endif
<div class="row justify-content-end">
    @if ($active1=='active show')
    <button type="button" class="boton-azul p-2 mb-3 mr-4" wire:click='cerrarCaja()'>Siguiente</button>
    @else
    <button type="button" class="boton-verde p-2 mb-3" wire:click='RecaudarEfectivo()'>Recaudar Efectivo</button>
    
    @endif
</div>

        </div>
    </div>
</div>