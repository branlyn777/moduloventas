<div wire:ignore.self class="modal fade" id="ajusteCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Finalizar Sesion de Caja</h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($idcaja !== null)
                    @if ($errors->has('*'))
                        @error('efectivo_actual')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-icon text-white"><i class="fas fa-times"></i></span>
                                <span class="alert-text text-white"><strong>Error!</strong>{{ $message }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    @endif

                    <div class="row justify-content-center">
                        <div class="card">
                            <div class="card-header pb-0 p-3">
                                @if ($active1 == true)
                                    <h6 class="text-left">
                                        <b>Arqueo de Caja</b>
                                    </h6>
                                @else
                                    <h5>
                                        <b>Recaudar Efectivo</b>
                                    </h5>
                                @endif
                            </div>
                            @if ($active1 == true)
                                <table class="mt-2">
                                    <tbody>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-books text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Ingresos en Efectivo</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <h6 class="text-sm text-end"> Bs. {{ number_format($ing_efectivo, 2) }}
                                                </h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-vector text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Ingresos No efectivos</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <u>
                                                    <h6 class="text-sm text-end"> Bs. {{ number_format($ing_dig, 2) }}
                                                    </h6>
                                                </u>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                        <i class="fas fa-check text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Total Ingresos
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <h6 class="text-sm text-end"> Bs. {{ number_format($subtotal_ing, 2) }}
                                                </h6>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                        <i class="fas fa-check text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Ingresos en efectivo
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <h6 class="text-sm text-end"> Bs.
                                                    {{ number_format($subtotal_ing - $ing_dig, 2) }}</h6>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-square-pin text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Egresos Efectivos</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <u>
                                                    <h6 class="text-sm text-end"> Bs.
                                                        {{ number_format($egresos_efectivos, 2) }}</h6>
                                                </u>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-square-pin text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Saldo</h6>
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
                                                        <i class="ni ni-money-coins text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Apertura de Caja</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <u>
                                                    <h6 class="text-sm text-end">Bs.
                                                        {{ number_format($aperturaCaja, 2) }}</h6>
                                                </u>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                        <i class="fas fa-check text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Saldo s/Edsoft</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="pe-3">
                                                <h6 class="text-sm text-end"> Bs.
                                                    {{ number_format($saldoAcumulado, 2) }}
                                                </h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="fas fa-check text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Efectivo Actual</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="d-flex flex-column">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <button
                                                                style="background-color: #5e72e4; color: white; border: #5e72e4;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#contador_monedas"
                                                                class="input-group-text"><i
                                                                    class="fas fa-calculator mx-2"></i></button>
                                                            <input type="number" wire:model='efectivo_actual'>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
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
                                                    <h6 class="text-sm text-end">Bs.
                                                        {{ $efectivo_actual - $saldoAcumulado }} </h6>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" class="ps-4 pe-2">

                                                    <h6 class="mb-1 text-dark text-sm">Nota/Comentario</h6>
                                                    {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                                    <textarea wire:model='nota_ajuste' class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>

                        </div>
                        </td>
                        </tr>
                    @else
                        <tr>
                            <td class="ps-3">

                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Efectivo Sob./Falt.</h6>
                                        <span class="text-xs font-weight-bold"> Bs. 0</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                @endif


                </tbody>
                </table>



            </div>
        @else
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
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

                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
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

                    <div class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
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
    </div>

    <div class="modal-footer justify-content-center">
        @if ($active1 == true)
            <button type="button" class="btn btn-dark btn-sm mb-3" wire:click='finArqueo()'>Finalizar
                Arqueo de Caja</button>
        @elseif($recaudo > 0)
            <button type="button" class="btn btn-dark btn-sm mb-3" wire:click='RecaudarEfectivo()'> Recaudar y
                Finalizar
                Cierre</button>
        @else
            <button type="button" class="btn btn-dark btn-sm mb-3" wire:click='finalizarCierre()'>Finalizar
                Cierre</button>
        @endif
    </div>
    @endif
</div>
</div>
</div>
