<div wire:ignore.self class="modal fade" id="modalcotization" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        <b>Cotizaci&oacute;n</b>
                    </p>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            Cotización para:
                            <div class="form-control">
                                <b>{{ ucwords(strtolower($nombrecliente)) }}</b>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-12 text-center">
                            Fecha de Vencimiento:
                            <input wire:model="finaldatecotization" class="form-control" type="date">
                        </div>
                    </div>

                </div>

                
            </div>
            <div class="modal-footer">
                @if($this->total_items > 0)
                <button wire:click.prevent="generatecotization()" type="button" class="btn btn-primary">
                    Generar Cotizaci&oacute;n
                </button>
                @endif
            </div>
        </div>
    </div>
</div>