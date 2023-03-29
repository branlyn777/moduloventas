<div wire:ignore.self id="modaltotales" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="text-white text-sm" id="exampleModalLabel">
                    Resumen de Operaciones
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 py-4">
                <h6 class="text-center">
                    <b>Cuadro Resumen de Efectivo</b>
                  
                    <br>
                    <label class="text-sm"> {{ $fromDate }} al {{ $toDate }}</label>
                    <br>
                    <span class="text-sm my-0 py-0">(Expresado en Bolivianos)</span>

                </h6>
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
                                    <u> {{ number_format($this->ingresosTotalesBancos, 2) }}</u>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm">
                                    Ingresos Totales
                                </td>
                                <td class="text-sm" style="float: right">

                                    {{ number_format($ingresos_totales, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm">
                                    Egresos Totales en Efectivo
                                </td>
                                <td class="text-sm" style="float: right">
                                    <u>({{ number_format($EgresosTotalesCF, 2) }})</u>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm">
                                    Saldo Ingresos/Egresos Totales en Efectivo
                                </td>
                                <td class="text-sm" style="float: right">
                                    {{ number_format($saldo, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-sm">
                                    Operaciones en TigoMoney
                                </td>
                                <td class="text-sm" style="float: right">
                                    <u>{{number_format($operaciones_tigo,2)}}</u>
                                </td>

                            </tr>



                            <tr>
                                <td class="text-sm">
                                    <b>Saldo total en Efectivo del periodo</b>
                                </td>
                                <td class="text-sm" style="float: right">
                                    {{ number_format($total_efectivo, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm">
                                    Saldo Acumulado ant. al periodo
                                </td>
                                <td class="text-sm" style="float: right">

                                    <u> {{ number_format($saldo_acumulado, 2) }}</u>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm">
                                    <b> Saldo Total de Efectivo antes de Ajustes</b>
                                </td>
                                <td class="text-sm" style="float: right">

                                    {{ number_format($saldo_acumulado + $total_efectivo, 2) }}
                                </td>
                            </tr>
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
                                 <u>  ({{ number_format($operacionfalt, 2) }})</u>
                                </td>


                            </tr>
                      

                            <tr>
                                <td class="text-sm">
                                <b> Saldo Total de Efectivo despues de Ajustes</b> 
                                </td>
                                <td class="text-sm" style="float: right">

                                    {{ number_format($total_efectivo + $saldo_acumulado - $op_recaudo - $operacionfalt + $operacionsob , 2) }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <br>
            </div>
   
        </div>
    </div>
</div>
