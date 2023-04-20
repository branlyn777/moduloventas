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
                        <h6 class="text-center mt-2">
                            <b>Arqueo de Caja</b>
                        </h6>
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table main">

                                    <tbody>
                                        <tr data-bs-toggle="collapse" data-bs-target="#ingresos-detalle-ventas"
                                            class="accordion-toggle">
                                            <td class="w-85 mb-1 text-dark text-sm">Saldo s/EDSOFT</td>
                                            <td class="w-5 text-center">
                                                {{ number_format($saldoAcumulado, 2) }}
                                            </td>
                                            <td class="text-end"><button class="btn btn-primary"><i
                                                        class="fa fa-chevron-down"></i></button></td>
                                        </tr>
                                        <tr class="nohover">
                                            <td colspan="3" class="hiddenRow">
                                                <div class="accordian-body collapse" id="ingresos-detalle-ventas">
                                                    <label>Resumen de Operaciones</label>
                                                    <div class="container">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">

                                                                <tbody>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                                                    <i
                                                                                        class="ni ni-books text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Ingresos en Efectivo
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <h6 class="text-sm text-end"> Bs.
                                                                                {{ number_format($ing_efectivo, 2) }}
                                                                            </h6>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                                                    <i
                                                                                        class="ni ni-vector text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Ingresos No efectivos
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <u>
                                                                                <h6 class="text-sm text-end">
                                                                                    Bs.
                                                                                    {{ number_format($ing_dig, 2) }}
                                                                                </h6>
                                                                            </u>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                                                    <i
                                                                                        class="fas fa-check text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Total Ingresos
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <h6 class="text-sm text-end"> Bs.
                                                                                {{ number_format($subtotal_ing, 2) }}
                                                                            </h6>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                                                    <i
                                                                                        class="fas fa-check text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Ingresos en efectivo
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <h6 class="text-sm text-end"> Bs.
                                                                                {{ number_format($subtotal_ing - $ing_dig, 2) }}
                                                                            </h6>
                                                                        </td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                                                    <i
                                                                                        class="ni ni-square-pin text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Egresos Efectivos</h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <u>
                                                                                <h6 class="text-sm text-end">
                                                                                    Bs.
                                                                                    {{ number_format($egresos_efectivos, 2) }}
                                                                                </h6>
                                                                            </u>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                                                    <i
                                                                                        class="ni ni-square-pin text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Saldo</h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">

                                                                            <h6 class="text-sm text-end">
                                                                                Bs.{{ number_format($subtotal_ing - $ing_dig - $egresos_efectivos, 2) }}
                                                                            </h6>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                                                    <i
                                                                                        class="ni ni-money-coins text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Apertura de Caja</h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <u>
                                                                                <h6 class="text-sm text-end">Bs.
                                                                                    {{ number_format($aperturaCaja, 2) }}
                                                                                </h6>
                                                                            </u>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            <div class="d-flex align-items-center">
                                                                                <div
                                                                                    class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                                                    <i
                                                                                        class="fas fa-check text-white opacity-10"></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <h6 class="mb-1 text-dark text-sm">
                                                                                        Saldo s/EDSOFT</h6>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="pe-3">
                                                                            <h6 class="text-sm text-end"> Bs.
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

                                            <div class="row">
                                                <div class="col-6">



                                                    <h6 class="mb-1 text-dark text-sm">
                                                        Efectivo Actual</h6>

                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group">
                                                        <button
                                                            style="background-color: #5e72e4; color: white; border: 1px solid #5e72e4;"
                                                            data-bs-toggle="modal" data-bs-target="#contador_monedas">
                                                            <i class="fas fa-calculator mx-2"></i>
                                                        </button>

                                                        <input type="number" class="form-control"
                                                            wire:model='efectivo_actual'>
                                                    </div>
                                                    @error('efectivo_actual')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </tr>

                                        @if ($efectivo_actual != null and $efectivo_actual != $saldoAcumulado)
                                            <tr>
                                                <td class="ps-3">

                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-1 text-dark text-sm">
                                                                <h6> <b>
                                                                        {{ $efectivo_actual > $saldoAcumulado ? 'Efectivo Sobrante: ' : 'Efectivo Faltante: ' }}</b>
                                                                </h6>

                                                            </h6>

                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="ps-3">
                                                    <h6 class="text-sm text-end"">
                                                        Bs.
                                                        {{ $efectivo_actual - $saldoAcumulado }}
                                                    </h6>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" class="ps-4 pe-2">

                                                    <h6 class="mb-1 text-dark text-sm">
                                                        Nota/Comentario</h6>
                                                    {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                                    <textarea wire:model='nota_ajuste' class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>

                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="ps-3">

                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-1 text-dark text-sm">
                                                                Efectivo Sob./Falt.
                                                            </h6>
                                                            <span class="text-xs font-weight-bold">
                                                                Bs. 0</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif





                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <h5>
                            <b>Recaudar Efectivo</b>
                        </h5>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Monto Limite Efectivo:</h6>
                                            <span class="text-xs font-weight-bold">{{ $monto_limite }}</span>
                                        </div>
                                    </div>
                                </li>

                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                        </div>
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
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-satisfied text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Recaudo</h6>
                                            <input type="number" wire:model='recaudo' style="direction: rtl;"
                                                class="form-control">
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
                            wire:click='finalizarCierre()'>Finalizar
                            Cierre</button>
                    @endif
                </div>

            @endif
        </div>
    </div>
</div>
