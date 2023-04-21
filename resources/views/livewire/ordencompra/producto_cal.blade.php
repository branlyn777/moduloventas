<div wire:ignore.self class="modal fade" id="modal_calculadora" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" style="font-size: 14px" id="exampleModalCenterTitle">Calcular Nuevo
                    Pedido</h5>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row mb-2">
                    <label>Tipo Pronostico</label>

                    <div class="col-12">
                       
                            <select wire:model='tipo' class="form-select mt-2">
                                <option value="null" disabled>Elegir Pronostico</option>
                                <option value="xdias">Los ultimos dias</option>
                                <option value="rango_fechas">Rango de fechas personalizado</option>

                            </select>
                       
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        @if ($tipo == 'xdias')
                            <div class="row">
                                <div class="col-4">
                                    <label class="mb-2">Introducir Dias</label>
                                    <input type="number" wire:model="ult_dias" class="form-control"
                                        placeholder="ej: 7">
                                </div>
                                <div class="col-8 align-middle">
                                    <br>
                                    <p>En promedio los ultimos {{$ult_dias}} dias has vendido {{number_format($unidxdia,2)}} unidades por dia.</p>
                                </div>
                            </div>
                        @endif
                        @if ($tipo == 'rango_fechas')
                            <div class="col-12">
                                <div class="row">

                                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                                        <div class="ms-auto my-auto">
                                            <div class="text-center">
                                                <b>Fecha Inicio</b>
                                                <div class="form-group">
                                                    <input type="date" wire:model="fromDate" class="form-control">
                                                </div>
                                            </div>

                                            <div class=" text-center">
                                                <b>Fecha Fin</b>
                                                <div class="form-group">
                                                    <input type="date" wire:model="toDate" class="form-control">
                                                </div>
                                            </div>
                                            @if ($errorDate !=null)
                                            <span class="text-danger er">{{ $errorDate }}</span>
                                            @endif
                                            <div class="align-middle">
                                                <br>
                                                <p>En promedio los ultimos {{$ult_dias}} dias has vendido {{number_format($unidxdia,2)}} unidades por dia.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Sugerir para:</label>
                        <div class="input-group mb-4">
                            <input type="number" wire:model="dias" class="form-control" placeholder="ej: 7">
                            <span class="input-group-text">
                                Dias
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center m-auto">
                    <h6 class="col-lg-12">Pronostico del proximo pedido</h6>
                    <h5>{{ $calculado }} Uds.</h5>
                </div>
                <div class="modal-footer">
                    <button wire:click="aplicarPronostico({{ $prod_exp }})" type="button" class="btn btn-primary"
                        data-bs-dismiss="modal" style="font-size: 13px">Aplicar Cantidad</button>
                </div>

            </div>
        </div>
    </div>
</div>
