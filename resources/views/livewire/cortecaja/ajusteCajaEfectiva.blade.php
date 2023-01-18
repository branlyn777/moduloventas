<div wire:ignore.self class="modal fade" id="ajusteCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ajuste de Efectivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>

            </div>
            <div class="modal-body">
                @if ($idcaja !== null)
                    {{-- <div class="row justify-content-center">
                        <div class="col-lg-12 mb-2">
                            <div class="row mt-2">
                                <div class="col-lg-7">
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
                                <div class="col-lg-5">
                                    
                                </div>
                            </div>
                            @if ($active1 == true)
                                <div class="row m-2">
                                    <div class="mb-2">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right">
                                                        <h6> <b> Transacciones del Dia:</b> </h6>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6> Bs. {{ $hoyTransacciones }}</h6>
                                                    </td>
                                                </tr>
                                                <tr></tr>
                                                <tr>
                                                    <td class="text-right">
                                                        <h6> <b>Esperado en Efectivo:</b> </h6>
                                                    </td>
                                                    <td class="text-right">
                                                        <h6> Bs. {{ $saldoAcumulado }}</h6>
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
                                                                data-bs-target="#contador_monedas"><i
                                                                    class="fas fa-calculator"></i></button>
                                                            <input type="text" class="form-control"
                                                                wire:model='efectivo_actual' placeholder="">
                                                        </div>
                                                    </td>
                                                </tr>

                                                <br>
                                                @if ($efectivo_actual != null)
                                                    <tr>
                                                        <td class="text-right">
                                                            <h6> <b>
                                                                    {{ $efectivo_actual > $saldoAcumulado
                                                                        ? 'Efectivo Sobrante:'
                                                                        : 'Efectivo
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Faltante: ' }}</b>
                                                            </h6>
                                                        </td>
                                                        <td class="text-right">
                                                            <h6> Bs. {{ $efectivo_actual - $saldoAcumulado }} </h5>
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
                                                    <h6 class="text-right">{{ $monto_limite }}</h6>
                                                </td>

                                            </tr>
                                            <tr>


                                                <td>
                                                    <h6 class="text-right">Efectivo Excedente:</h6>
                                                </td>
                                                <td>
                                                    <h6 class="text-right">
                                                        {{ number_format($saldoAcumulado - $monto_limite, 2) }}
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
                                                        wire:click='RecaudarEfectivo()'
                                                        {{ $recaudo == null ? "disabled='true'" : '' }}>Recaudar</button>

                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            @endif

                        </div>
                    </div> --}}

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
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Transacciones Del Dia</h6>
                                                    <h6 class="text-xs"> Bs. {{ $hoyTransacciones }}</h6>
                                                </div>
                                            </div>
                                        </li>

                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-tag text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Esperado En Efectivo</h6>
                                                    <h6 class="text-xs"> Bs. {{ $saldoAcumulado }}</h6>
                                                </div>
                                            </div>
                                        </li>

                                        <div
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-box-2 text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Efectivo Actual</h6>
                                                    <div class="input-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-outline-primary mb-0"
                                                            id="button-addon1" data-bs-toggle="modal"
                                                            data-bs-target="#contador_monedas"><i
                                                                class="fas fa-calculator"></i></button>
                                                        <input type="text" class="form-control"
                                                            wire:model='efectivo_actual'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($efectivo_actual != null)
                                            <li
                                                class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">
                                                            <h6> <b>
                                                                    {{ $efectivo_actual > $saldoAcumulado
                                                                        ? 'Efectivo Sobrante:'
                                                                        : 'Efectivo
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Faltante: ' }}</b>
                                                            </h6>

                                                        </h6>
                                                        <span class="text-xs font-weight-bold">Bs.
                                                            {{ $efectivo_actual - $saldoAcumulado }} </span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li
                                                class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Nota/Comentario</h6>
                                                        {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                                        <textarea wire:model='nota_ajuste'></textarea>
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                            <li
                                                class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">Efectivo Sob./Falt.</h6>
                                                        <span class="text-xs font-weight-bold"> Bs. 0</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @else
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
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
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
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
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-satisfied text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Recaudo</h6>
                                                    <input type="number" wire:model='recaudo' style="direction: rtl;" class="form-control">
                                                    {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-satisfied text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <button type="button" class="btn btn-danger btn-sm mb-3"
                                                        wire:click='RecaudarEfectivo()'
                                                        {{ $recaudo == null ? "disabled='true'" : '' }}>Recaudar</button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        @if ($active1 == true)
                            <button type="button" class="btn btn-dark btn-sm mb-3"
                                wire:click='finArqueo()'>Finalizar
                                Arqueo de Caja</button>
                        @else
                            <button type="button" class="btn btn-dark btn-sm mb-3"
                                wire:click='finalizarCierre()'>Finalizar Cierre</button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
