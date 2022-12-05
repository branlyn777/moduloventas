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
    
<div class="row justify-content-center table-3">
    <div  style="border:2px solid rgba(0, 0, 0, 0.544);border-radius: 20px; margin-top: 2rem;">

        <div class="row mt-4">
            <div class="col-lg-12">

                @if ($active1==true)
                    
                <h3 style="margin-top: -15px; background-color: rgb(255, 255, 255); width: 150px; margin-top: -35px; margin-left: 50px; margin-right:50px">
                    <b> Arqueo de Caja</b>
                   </h3>    
                   @else
                   <h3 class="text-center mt-2 pl-2">
                    <b> Recaudar Efectivo</b>
                   </h3>  
                @endif
            </div>
        </div>
        @if($active1 == true)
        <div class="row m-2">
            <div class="mb-2">
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
                        @if ($efectivo_actual != null)
                            
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
                        <tr>
                            <td>
                                <h3>

                                    Nota/Comentario: 
                                </h3>
                            </td>
                            <td>
                                <textarea 
                                     wire:model='nota_ajuste'></textarea>
                            </td>
                        </tr>
                        @else

                        <tr>
                            <td class="text-right">
                                <h3>Efectivo Sob./Falt.:
                                </h3>
                            </td>
                            <td class="text-right">
                                <h3> Bs. 0</h3>
                            </td>
                        </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
        @else

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
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="button" class="btn btn-danger mb-3" wire:click='RecaudarEfectivo()' {{$recaudo == null? "disabled='true'":''}} >Recaudar Efectivo</button>

                        </td>
                        
                    </tr>
                </tbody>
            </table>
         
        </div>
        @endif
        
    </div>
    
</div>

<div class="row justify-content-end">
    @if ($active1== true)
        
    <button type="button" class="boton-azul p-2 mb-3 mr-4" wire:click='finArqueo()'>Finalizar Arqueo de Caja</button>
    @else

    <button type="button" class="boton-azul p-2 mb-3 mr-4" wire:click='cerrarCaja()'>Finalizar Cierre</button>
    @endif
   
    

</div>
@endif

        </div>
    </div>
</div>