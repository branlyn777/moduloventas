<div wire:ignore.self class="modal fade" id="aperturacaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Apertura de Caja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row m-3">
                @if ($idcaja !== null)


                    <h6 class="text-center mt-4">
                        <b>Arqueo de Caja</b>
                    </h6>

                    <div class="col-12">

                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1 text-dark text-sm">Efectivo s/Edsoft</h6>
                            <h6 class="text-xs"> Bs. {{ $saldoAcumulado }}</h6>
                        </div>
                    </div>

                    <div class="col-12 mt-3">

                        <div class="d-flex justify-content-between px-3">
                            <h6 class="mb-1 text-dark text-sm">Efectivo Actual</h6>
                            <div class="form-group text-end">
                                <div class="input-group">
                                    <button style="background-color: #5e72e4; color: white; border: #5e72e4;"
                                        data-bs-toggle="modal" data-bs-target="#contador_monedas"
                                        class="input-group-text"><i class="fas fa-calculator mx-2"></i></button>
                                    <input type="number" class="form-control needs-validation" novalidate
                                        id="validationCustom03" required style="padding-left: 5%;"
                                        wire:model='efectivo_actual' placeholder="Bs...">
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($efectivo_actual != null and $efectivo_actual != $saldoAcumulado)
                        <div class="col-12 d-flex align-items-center mb-3">

                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">
                                    <h6>
                                        Ajuste de Efectivo
                                    </h6>

                                </h6>
                                <span class="text-xs font-weight-bold">Bs.
                                    {{ $efectivo_actual - $saldoAcumulado < 0 ? ($efectivo_actual - $saldoAcumulado) * -1 : $efectivo_actual - $saldoAcumulado }}
                                </span>
                            </div>
                        </div>



                        <div class="col-12 mb-4">


                            <h6 class="mb-1 text-dark text-sm">Nota de Ajuste de Efectivo</h6>
                            {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                            <textarea wire:model='nota_ajuste' class="form-control" id="exampleFormControlTextarea1" rows="2"
                                placeholder="Dejar una nota para alclarar el ajuste..."></textarea>


                        </div>
                    @endif

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary"
                            wire:click='corteCaja({{ $idcaja }})'>Iniciar sesion caja</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
