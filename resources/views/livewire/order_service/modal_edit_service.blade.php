<div wire:ignore.self class="modal fade" id="editservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-sm" id="exampleModalLabel">ACTUALIZAR SERVICIO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <span class="text-sm text-uppercase">
                            <b>
                              {{ $this->s_client_name }} @if ($this->s_client_cell != 0 && $this->s_client_cell != null) - {{ $this->s_client_cell }} @endif @if ($this->s_client_phone != 0 && $this->s_client_phone != null) - {{ $this->s_client_phone }} @endif
                            </b>
                        </span>
                        <br>
                        <span class="text-sm">
                            {{ $this->s_cps }} {{ $this->s_mark }} {{ $this->s_model_detail }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                  <div class="col-4">
                    <label>Tipo Trabajo:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Categoría:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Marca:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                    <label>Modelo y Estado Equipo:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-6">
                    <label>Falla Según Cliente:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                    <label>Diagnóstico:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-6">
                    <label>Solución:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-4">
                    <label>Precio Servicio:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>A Cuenta:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Saldo:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-4">
                    <label>Costo Servicio:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-8">
                    <label>Motivo Costo:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-4">
                    <label>Fecha:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Hora:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Responsable:</label>
                    <input wire:model.lazy="s_price" type="text" class="form-control">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button wire:click.prevent="deliver_service({{ $this->id_service }})" type="button"
                    class="btn bg-gradient-success">Actualizar Servicio</button>
            </div>
        </div>
    </div>
</div>
