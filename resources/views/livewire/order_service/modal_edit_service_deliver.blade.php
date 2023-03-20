<div wire:ignore.self class="modal fade" id="editservicedeliver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-sm" id="exampleModalLabel">ACTUALIZAR SERVICIO: {{$this->id_order_service}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row mb-3">
                <div class="col-6">
                  <label>Responsable:</label>
                    @if($this->list_user_technicial)
                    <select wire:model="s_id_user_technicial" class="form-select">
                      @foreach($this->list_user_technicial as $u)
                      <option value="{{$u->id}}">{{$u->name}}</option>
                      @endforeach
                    </select>
                    @endif
                </div>
                <div class="col-6">
                  @if(!$this->box_status)
                  <strong class="text-sm">No aperturo caja</strong>
                  <br>
                  <a href="{{ url('cortecajas') }}" class="btn text-primary" target="_blank">
                      Ir a Corte de Caja
                  </a>
                  @else
                  <label>Tipo de Pago:</label>
                  <select wire:model="s_id_wallet" class="form-select">
                      @foreach($this->list_wallets as $w)
                      <option value="{{$w->id}}">{{$w->nombre}}</option>
                      @endforeach
                  </select>
                  @endif
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-4">
                  <label>Precio Servicio:</label>
                  <input wire:model.lazy="s_price" type="number" class="form-control">
                  @error('s_price')
                    <span class="text-danger text-xs">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-4">
                  <label>A Cuenta:</label>
                  <input wire:model.lazy="s_on_account" type="number" class="form-control">
                  @error('s_on_account')
                    <span class="text-danger text-xs">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-4 text-center">
                  <label>Saldo:</label>
                  <div class="form-control">
                    {{$this->s_balance}}
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-4">
                  <label>Costo Servicio:</label>
                  <input wire:model.lazy="s_cost" type="number" class="form-control">
                  @error('s_cost')
                    <span class="text-danger text-xs">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-8">
                  <label>Motivo Costo:</label>
                  <input wire:model.lazy="s_cost_detail" type="text" class="form-control">
                  @error('s_cost_detail')
                    <span class="text-danger text-xs">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button onclick="updateService()" type="button" class="btn bg-gradient-success">Actualizar Servicio Entregado</button>
            </div>
        </div>
    </div>
</div>
