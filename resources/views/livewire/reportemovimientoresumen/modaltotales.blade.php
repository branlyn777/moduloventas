<div wire:ignore.self id="modaltotales" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="text-white text-sm" id="exampleModalLabel">
                    Totales
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="text-center">
                        <b>Cuadro Resumen de Efectivo</b>
                    </h5>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 table-borderless">
                            <tbody>
                                <tr>
                                    <td class="text-sm">
                                        Ingresos en Efectivo
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($ingresosTotalesCF, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        Ingresos No efectivos(Bancos,Qr)
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($this->ingresosTotalesBancos, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        Ingresos Totales
                                    </td>
                                    <td class="text-sm" style="float: right">
                                       
                                      <u> {{ number_format($ingresos_totales, 2) }}</u> 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        Egresos Totales en Efectivo
                                    </td>
                                    <td class="text-sm" style="float: right">
                                       ({{ number_format($EgresosTotalesCF, 2) }})
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        Saldo Ingresos/Egresos Totales
                                    </td>
                                    <td class="text-sm" style="float: right">
                                     <u>{{ number_format($saldo, 2) }}</u>
                                     
                                    </td>
                                </tr>
{{-- 
                                <tr class="p-5">
                                    <td class="text-sm text-center">
                                        Operaciones Tigo Money
                                    </td>
                                    <td class="text-sm text-end" style="float: center">
                                        {{number_format($total,2)}}
                                    </td>
                                </tr> --}}

                                {{-- <tr>
                                    <td class="text-sm">
                                        Saldo en Efectivo Hoy
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($operacionesefectivas, 2) }}
                                    </td>
                                </tr> --}}

                                <tr>
                                    <td>
                                        <h5 class="text-dark text-center mr-1"><b> Saldo por Operaciones en TigoMoney </b></h5>
                                    </td>
            
                                    <td>
                                        <h5 class="text-dark text-center mr-1">{{ number_format($operaciones_tigo,2)}} </h5>
                                    </td>
            
                                </tr>



                                <tr>
                                    <td class="text-sm">
                                        <h5 class="text-dark"> Total Efectivo </h5>
                                    </td>
                                    <td class="text-sm" style="float: right">
                                   {{ number_format($total_efectivo, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        <h5 class="text-dark"> Saldo Acumulado </h5>
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        
                                       {{ number_format($saldo_acumulado,2)}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="">
                        <table class="table">
                            <tbody>


                                <tr class="p-5">
                                    <td class="text-sm">
                                        Recaudo
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($op_recaudo, 2) }}
                                    </td>

                                </tr>
                                <tr class="p-5">



                                    <td class="text-sm">
                                        Sobrantes
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($operacionsob, 2) }}
                                    </td>


                                </tr>
                                <tr class="p-5">



                                    <td class="text-sm">
                                        Faltantes
                                    </td>
                                    <td class="text-sm" style="float: right">
                                       <u>({{ number_format($operacionfalt, 2) }})</u> 
                                    </td>


                                </tr>
                                <tr class="p-5">



                                    <td class="text-sm">
                                        Ajustes
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        @if ($ajustes<0)
                                        <u>({{ number_format($ajustes*-1, 2) }})</u> 
                                            
                                        @else
                                        <u>({{ number_format($ajustes, 2) }})</u> 
                                        @endif
                                    </td>


                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        <h5 class="text-dark"> Saldo Total </h5>
                                    </td>
                                    <td class="text-sm" style="float: right">
                                 
                                        {{ number_format($total_efectivo+$saldo_acumulado-$op_recaudo-$operacionfalt+$operacionsob+$ajustes,2)}}
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

















            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>