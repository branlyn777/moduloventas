<div wire:ignore.self class="modal fade" id="ajusteCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Cierre de Caja</h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            @if ($idcaja !== null)

                <div class="row justify-content-center m-2">
                    @if ($active1 == true)
                        <h6 class="text-center mt-1">
                            <b>Arqueo de Caja</b>
                        </h6>
                        <div class="table-responsive">

                            <table class="table table-borderless">

                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="mb-1 text-dark text-sm">
                                                <b>
                                                    Saldo s/EDSOFT:
                                            </h6>
                                        </td>
                                        <td class="text-left">

                                            <div class="input-group">

                                                <input disabled type="number" class="form-control"
                                                    wire:model='saldoAcumulado' placeholder="Bs...">
                                                <a class="btn btn-primary px-4 py-2" data-bs-toggle="collapse"
                                                    data-bs-target="#ingresos-detalle-ventas"
                                                    class="accordion-toggle"><i class="fa fa-chevron-down"></i></a>
                                            </div>




                                        </td>

                                    </tr>
                                    <tr class="nohover">
                                        <td colspan="3" class="hiddenRow">
                                            <div class="accordian-body collapse" id="ingresos-detalle-ventas">
                                                <div class="container border secondary-dark rounded">
                                                    <h6 class="text-center p-2">Resúmen de Operaciones
                                                        <br>
                                                        <span class="text-sm mt-0 pt-0">(Exp. en Bs.)</span>
                                                    </h6>

                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">

                                                            <tbody>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    Ingresos en Efectivo
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">
                                                                        <h6 class="text-sm text-end text-success">
                                                                            {{ number_format($ing_efectivo, 2) }}
                                                                        </h6>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    Ingresos No efectivos
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">

                                                                        <h6 class="text-sm text-end text-success">

                                                                            {{ number_format($ing_dig, 2) }}
                                                                        </h6>
                                                                        <hr class="hr-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6
                                                                                    class="mb-1 text-dark text-sm text-success">
                                                                                    Total Ingresos
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">
                                                                        <h6 class="text-sm text-end">
                                                                            {{ number_format($subtotal_ing, 2) }}
                                                                        </h6>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    Ingresos en efectivo
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">
                                                                        <h6 class="text-sm text-end text-success">
                                                                            {{ number_format($subtotal_ing - $ing_dig, 2) }}
                                                                        </h6>
                                                                    </td>

                                                                </tr>

                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    Egresos Efectivos</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">

                                                                        <h6 class="text-sm text-end text-danger">

                                                                            {{ number_format($egresos_efectivos, 2) }}
                                                                        </h6>
                                                                        <hr class="hr-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    Saldo en Efectivo</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">

                                                                        <h6 class="text-sm text-end">
                                                                            {{ number_format($subtotal_ing - $ing_dig - $egresos_efectivos, 2) }}
                                                                        </h6>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    Apertura de Caja</h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">

                                                                        <h6 class="text-sm text-end">
                                                                            {{ number_format($aperturaCaja, 2) }}
                                                                        </h6>
                                                                        <hr class="hr-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="ps-3">
                                                                        <div class="d-flex align-items-center">

                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-1 text-dark text-sm">
                                                                                    <b>
                                                                                        Saldo s/EDSOFT
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="pe-3">
                                                                        <h6 class="text-sm text-end">
                                                                            {{ number_format($saldoAcumulado, 2) }}
                                                                        </h6>
                                                                    </td>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="mb-1 text-dark text-sm ps-1">
                                                <b>
                                                    Efectivo Actual:
                                            </h6>

                                        </td>
                                        <td>
                                            <div class="input-group">

                                                <input type="number" class="form-control" wire:model='efectivo_actual'
                                                    placeholder="Bs...">
                                                <button class="btn"
                                                    style="background-color: #5e72e4; color: white; border: 1px solid #5e72e4;"
                                                    data-bs-toggle="modal" data-bs-target="#contador_monedas">
                                                    <i class="fas fa-calculator mx-2"></i>
                                                </button>
                                            </div>
                                        </td>




                                    </tr>

                                    @if ($efectivo_actual != null and $efectivo_actual != $saldoAcumulado)
                                        <tr>
                                            <td class="ps-3">

                                                <div class="d-flex align-items-center">

                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">
                                                            <b>
                                                                {{ $efectivo_actual > $saldoAcumulado ? 'Efectivo Sobrante: ' : 'Efectivo Faltante: ' }}</b>


                                                        </h6>

                                                    </div>
                                                </div>
                                            </td>

                                            <td class="ps-3">


                                                {{ number_format($efectivo_actual - $saldoAcumulado, 2) }}

                                            </td>
                                        </tr>

                                        <tr class="nohover">
                                            <td colspan="2" class="ps-3 pe-2">

                                                <h6 class="mb-1 text-dark text-sm">
                                                    <b>
                                                        Nota/Comentario:
                                                </h6>
                                                {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                                <textarea wire:model='nota_ajuste' class="form-control" id="exampleFormControlTextarea1" rows="2"
                                                    placeholder="Agregue una observacion para el ajuste..."></textarea>

                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="ps-3">

                                                <div class="d-flex align-items-center">

                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">
                                                            <b>
                                                                Efectivo Sob./Falt.
                                                        </h6>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>
                                    @endif





                                </tbody>
                            </table>

                        </div>
                    @else
                        <h6 class="text-center">
                            <b>Recaudar Efectivo</b>
                        </h6>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Monto Limite Efectivo:</h6>
                                            <span class="text-xs font-weight-bold">{{ $monto_limite }}</span>
                                        </div>
                                    </div>
                                </li>

                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Efectivo Excedente</h6>
                                            <span class="text-xs font-weight-bold">
                                                {{ number_format($saldoAcumulado - $monto_limite, 2) }}</span>
                                        </div>
                                    </div>
                                </li>

                                <div
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">

                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Recaudo</h6>
                                            <input type="number" wire:model='recaudo' style="direction: rtl;"
                                                class="form-control my-3" placeholder="Bs...">
                                            {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                        </div>
                                    </div>
                                </div>


                            </ul>
                        </div>
                    @endif
                </div>


                <div class="modal-footer justify-content-center">
                    @if ($active1 == true)
                        <button type="button" class="btn btn-dark btn-sm mb-3" wire:click='finArqueo()'>Finalizar
                            Arqueo de Caja</button>
                    @elseif($recaudo > 0)
                        <button type="button" class="btn btn-dark btn-sm mb-3"
                            wire:click='RecaudarEfectivo()'>Recaudar y
                            Finalizar Cierre</button>
                    @else
                        <button type="button" class="btn btn-dark btn-sm mb-3"
                            wire:click='finalizarCierre({{ $usuarioSesion }})'>Finalizar
                            Cierre</button>
                    @endif
                </div>

            @endif
        </div>
    </div>
</div>