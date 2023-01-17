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
                                    <td>
                                        Ingresos en Efectivo
                                    </td>
                                    <td style="float: right">
                                        {{ number_format($ingresosTotalesCF, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Ingresos por Bancos
                                    </td>
                                    <td style="float: right">
                                        {{ number_format($this->ingresosTotalesNoCFBancos, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Ingresos Totales
                                    </td>
                                    <td style="float: right">
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        {{ number_format($subtotalesIngresos, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Egresos Totales en Efectivo
                                    </td>
                                    <td style="float: right">
                                        {{ number_format($EgresosTotalesCF, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Saldo Ingresos/Egresos Totales
                                    </td>
                                    <td style="float: right">
                                        <hr class="m-0 p-0" width="100%" style="background-color: black">
                                        {{ number_format($subtotalcaja, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Saldo en Efectivo Hoy
                                    </td>
                                    <td style="float: right">
                                        {{ number_format($operacionesefectivas, 2) }}
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td>
                                        <h5 class="text-dark text-center mr-1"><b> Saldo por Operaciones en TigoMoney </b></h5>
                                    </td>
            
                                    <td>
                                        <h5 class="text-dark text-center mr-1">{{ number_format($total,2)}} </h5>
                                    </td>
            
                                </tr> --}}
                                
                                <tr>
                                    <td>
                                        Saldo Acumulado Dia Ant.
                                    </td>
                                    <td style="float: right">
                                        {{ number_format($ops, 2) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5 class="text-dark"> Total Efectivo </h5>
                                    </td>
                                    <td style="float: right">
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
                                @if ($caja != 'TODAS')
                                    <tr style="height: 2rem"></tr>

                                    <tr class="p-5">
                                        <td>
                                            Recaudo
                                        </td>
                                        <td style="float: right">
                                            {{ number_format($op_recaudo, 2) }}
                                        </td>

                                    </tr>
                                    <tr class="p-5">


                                        @foreach ($op_sob_falt as $values)
                                            <td>
                                                {{ $values->tipo_sob_fal }}
                                            </td>
                                            <td style="float: right">
                                                {{ number_format($values->import, 2) }}
                                            </td>
                                        @endforeach

                                    </tr>
                                    <tr class="p-5">
                                        <td>
                                            Nuevo Saldo Caja Fisica
                                        </td>
                                        <td style="float: right">
                                            {{ number_format($operacionesZ, 2) }}
                                        </td>

                                    </tr>
                                @endif
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
