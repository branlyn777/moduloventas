<div wire:ignore.self class="modal fade" id="ajusteCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ajuste de Efectivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($idcaja!==null)

                <div class="row justify-content-center">
                    <div class="mb-2">

                        <div class="row mt-4">
                            <div class="col-lg-12">

                                @if ($active1==true)

                                <h5 class="text-center">
                                    <b> Arqueo de Caja</b>
                                </h5>
                                @else
                                <h5>
                                    <b> Recaudar Efectivo</b>
                                </h5>
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
                                                <h5> Transacciones del Dia: </h5>
                                            </td>
                                            <td class="text-right">
                                                <h5> Bs. {{$hoyTransacciones}}</h5>
                                            </td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td class="text-right">
                                                <h5> Esperado en Efectivo: </h5>
                                            </td>
                                            <td class="text-right">
                                                <h5> Bs. {{$saldoAcumulado}}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <h5>Efectivo Actual:</h5>
                                            </td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-outline-primary mb-0" type="button"
                                                        id="button-addon1" data-bs-toggle="modal"
                                                        data-bs-target="#contador_monedas"><i class="fas fa-calculator"></i></button>
                                                    <input type="text" class="form-control" wire:model='efectivo_actual' placeholder="">
                                                </div>

                                            </td>


                                        </tr>

                                        <br>
                                        @if ($efectivo_actual != null)

                                        <tr>
                                            <td class="text-right">
                                                <h5>{{$efectivo_actual>$saldoAcumulado ? 'Efectivo Sobrante:':'Efectivo
                                                    Faltante: '}}
                                                </h5>
                                            </td>
                                            <td class="text-right">
                                                <h5> Bs. {{$efectivo_actual-$saldoAcumulado}}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>

                                                    Nota/Comentario:
                                                </h5>
                                            </td>
                                            <td>
                                                <textarea wire:model='nota_ajuste'></textarea>
                                            </td>
                                        </tr>
                                        @else

                                        <tr>
                                            <td class="text-right">
                                                <h5>Efectivo Sob./Falt.:
                                                </h5>
                                            </td>
                                            <td class="text-right">
                                                <h5> Bs. 0</h5>
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else

                        <div class="row mt-3 m-2">

                            <table>
                                <tbody>

                                    <tr>
                                        <td>
                                            <h5 class="text-right">Monto limite Efectivo:</h5>
                                        </td>
                                        <td>
                                            <h5 class="text-right">{{$monto_limite}}</h5>
                                        </td>

                                    </tr>
                                    <tr>


                                        <td>
                                            <h5 class="text-right">Efectivo Excedente:</h5>
                                        </td>
                                        <td>
                                            <h5 class="text-right">{{number_format($saldoAcumulado-$monto_limite,2)}}
                                            </h5>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="text-right">Recaudo:</h5>
                                        </td>
                                        <td>
                                            <input type="number" wire:model='recaudo' style="direction: rtl;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm mb-3"
                                                wire:click='RecaudarEfectivo()' {{$recaudo==null? "disabled='true'"
                                                :''}}>Recaudar</button>

                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        @endif

                    </div>

                </div>


                <div class="modal-footer justify-content-center">

                    @if ($active1== true)

                    <button type="button" class="btn btn-warning" wire:click='finArqueo()'>Finalizar Arqueo de
                        Caja</button>
                    @else

                    <button type="button" class="btn btn-warning" wire:click='finalizarCierre()'>Finalizar
                        Cierre</button>
                    @endif



                </div>
                @endif
            </div>
        </div>
    </div>
</div>