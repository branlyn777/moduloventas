<div wire:ignore.self class="modal fade" id="editservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-sm" id="exampleModalLabel">ACTUALIZAR SERVICIO: {{$this->id_order_service}}</h5>
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
                    </div>
                </div>
                <div class="row mb-3">
                  <div class="col-4">
                    <label>Tipo Trabajo:</label>
                    @if($this->list_type_work)
                    <select wire:model="s_id_type_work" class="form-select">
                      @foreach($this->list_type_work as $tw)
                      <option value="{{$tw->id}}">{{$tw->name}}</option>
                      @endforeach
                    </select>
                    @endif
                  </div>
                  <div class="col-4">
                    <label>Categoría:</label>
                    @if($this->list_category)
                    <select wire:model="s_id_category" class="form-select">
                      @foreach($this->list_category as $c)
                      <option value="{{$c->id}}">{{$c->nombre}}</option>
                      @endforeach
                    </select>
                    @endif
                  </div>
                  <div class="col-4">
                    <label>Marca:</label>
                    <div class="product-search">
                      <input required  type="text" id="product-input" class="form-control">
                      <ul id="product-list"></ul>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                    <label>Modelo y Estado Equipo:</label>
                    <input wire:model.lazy="s_model_detail" type="text" class="form-control">
                    @error('s_model_detail')
                      <span class="text-danger text-xs">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-6">
                    <label>Falla Según Cliente:</label>
                    <input wire:model.lazy="s_fail_client" type="text" class="form-control">
                    @error('s_fail_client')
                      <span class="text-danger text-xs">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-6">
                    <label>Diagnóstico:</label>
                    <input wire:model.lazy="s_diagnostic" type="text" class="form-control">
                    @error('s_diagnostic')
                      <span class="text-danger text-xs">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-6">
                    <label>Solución:</label>
                    <input wire:model.lazy="s_solution" type="text" class="form-control">
                    @error('s_solution')
                      <span class="text-danger text-xs">{{ $message }}</span>
                    @enderror
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
                <div class="row mb-3">
                  <div class="col-4">
                    <label>Fecha Entrega:</label>
                    <input wire:model="s_estimated_delivery_date" type="date" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Hora:</label>
                    <input wire:model="s_estimated_delivery_time" type="time" class="form-control">
                  </div>
                  <div class="col-4">
                    <label>Responsable:</label>
                    @if($this->list_user_technicial)
                    <select wire:model="s_id_user_technicial" class="form-select">
                      @foreach($this->list_user_technicial as $u)
                      <option value="{{$u->id}}">{{$u->name}}</option>
                      @endforeach
                    </select>
                    @endif
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button onclick="updateService()" type="button" class="btn bg-gradient-success">Actualizar Servicio</button>
            </div>
        </div>
    </div>
</div>
