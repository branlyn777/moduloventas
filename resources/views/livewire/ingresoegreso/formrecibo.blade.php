<div wire:ignore.self id="modalreciboform" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-header bg-primary">
                <h4 class="text-white text-sm" id="exampleModalLabel">
                    Emitir Recibo de Caja
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label><span class="text-warning">* </span>A nombre de:</label>
                            <input type="text" required wire:model="persona_recibo" class="form-control">
                            @error('persona_recibo')
                                <span class="text-danger er" style="font-size: 0.8rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" wire:click="resetRecibo()">Cancelar</a>
                    <a wire:click='generarRecibo' class="btn btn-primary">Generar Documento</a>
                </div>

            </div>


        </div>
    </div>
</div>
