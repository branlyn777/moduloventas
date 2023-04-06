<div wire:ignore.self class="modal fade" id="lotecosto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <label class="modal-title text-white" style="font-size: 14px">Lote Costo</label>
                <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5>Cambiar Costo Lote</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-3">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="number" wire:model.lazy="costo_lote" class="form-control"
                            style="text-align: right;">
                    </div>
                    <div class="col-12 col-sm-3">

                    </div>

                    <div class="col-12 text-center">
                        <br>
                        <button wire:click="actualizar_costo()" class="btn btn-success">
                            ACTUALIZAR COSTO
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
