<div wire:ignore.self class="modal fade" id="ajusteCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ajuste de Efectivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
               
            </div>
            <div class="modal-body">
                @if ($idcaja!==null)

                <div class="row justify-content-center">
                    <div class="mb-2">

                        <div class="row mt-2">
                            <div class="col-lg-5">

                                @if ($active1==true)

                                <h5 class="text-left">
                                    <b>Arqueo de Caja</b>
                                </h5>
                             
                                @else
                                <h5>
                                    <b>Recaudar Efectivo</b>
                                </h5>
                                @endif
                            </div>
                            <div class="col-lg-7">
                                <button type="button" class="btn btn-sm btn-primary">
                                    Ajuste de Cierre de Caja
                                </button>
                            </div>
                        </div>
                        @if($active1 == true)
                        <div class="row m-2">
                            <div class="mb-2">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="text-right">
                                                <h6> <b> Transacciones del Dia:</b> </h6>
                                            </td>
                                            <td class="text-right">
                                                <h6> Bs. {{$hoyTransacciones}}</h6>
                                            </td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td class="text-right">
                                                <h6> <b>Esperado en Efectivo:</b> </h6>
                                            </td>
                                            <td class="text-right">
                                                <h6> Bs. {{$saldoAcumulado}}</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                <h6> <b>Efectivo Actual: </b></h6>
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
                                                <h6> <b> {{$efectivo_actual>$saldoAcumulado ? 'Efectivo Sobrante:':'Efectivo
                                                    Faltante: '}}</b>
                                                </h6>
                                            </td>
                                            <td class="text-right">
                                                <h6> Bs. {{$efectivo_actual-$saldoAcumulado}} </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6>

                                                    Nota/Comentario:
                                                </h6>
                                            </td>
                                            <td>
                                                <textarea wire:model='nota_ajuste'></textarea>
                                            </td>
                                        </tr>
                                        @else

                                        <tr>
                                            <td class="text-right">
                                                <h6> <b>Efectivo Sob./Falt.:</b> 
                                                </h6>
                                            </td>
                                            <td class="text-right">
                                                <h6> Bs. 0</h6>
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
                                            <h6 class="text-right">Monto limite Efectivo:</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-right">{{$monto_limite}}</h6>
                                        </td>

                                    </tr>
                                    <tr>


                                        <td>
                                            <h6 class="text-right">Efectivo Excedente:</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-right">{{number_format($saldoAcumulado-$monto_limite,2)}}
                                            </h6>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="text-right">Recaudo:</h6>
                                        </td>
                                        <td>
                                            <input type="number" wire:model='recaudo' style="direction: rtl;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm mb-3"
                                                wire:click='RecaudarEfectivo()' {{$recaudo==null? "disabled='true'":''}}>Recaudar</button>

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

                    <button type="button" class="btn btn-dark btn-sm mb-3" wire:click='finArqueo()'>Finalizar Arqueo de Caja</button>
                    @else

                

                    <button type="button" class="btn btn-dark btn-sm mb-3" wire:click='finalizarCierre()'>Finalizar Cierre</button>
                    @endif



                </div>
                @endif
            </div>
        </div>
    </div>
</div>