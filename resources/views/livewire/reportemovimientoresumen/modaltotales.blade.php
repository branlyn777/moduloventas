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
                                        Ingresos por Bancos
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
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        {{ number_format($subtotalesIngresos, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        Egresos Totales en Efectivo
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($EgresosTotalesCF, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm">
                                        Saldo Ingresos/Egresos Totales
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        {{ number_format($subtotalcaja, 2) }}
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td class="text-sm">
                                        Saldo en Efectivo Hoy
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        {{ number_format($operacionesefectivas, 2) }}
                                    </td>
                                </tr> --}}

                                {{-- <tr>
                                    <td>
                                        <h5 class="text-dark text-center mr-1"><b> Saldo por Operaciones en TigoMoney </b></h5>
                                    </td>
            
                                    <td>
                                        <h5 class="text-dark text-center mr-1">{{ number_format($total,2)}} </h5>
                                    </td>
            
                                </tr> --}}
                                
                            

                                <tr>
                                    <td class="text-sm">
                                        <h5 class="text-dark"> Total Efectivo </h5>
                                    </td>
                                    <td class="text-sm" style="float: right">
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        {{ number_format($operacionesW, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="">
                        <table class="table">
                            <tbody>
                       
                                    <tr style="height: 2rem"></tr>

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
                                                {{ number_format($operacionfalt, 2) }}
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
