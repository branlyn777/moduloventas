<div wire:ignore.self class="modal fade" id="terminatedservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-sm" id="exampleModalLabel">TERMINAR SERVICIO: {{$this->id_order_service}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="text-sm text-uppercase">
                        <b>{{$this->s_client_name}} @if($this->s_client_cell != 0 && $this->s_client_cell != null) - {{$this->s_client_cell}} @endif @if($this->s_client_phone != 0 && $this->s_client_phone != null) - {{$this->s_client_phone}} @endif</b>
                    </span>
                    <br>
                    <span class="text-sm">
                        {{$this->s_cps}} {{$this->s_mark}} {{$this->s_model_detail}} 
                    </span>    
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label>Solución:</label>
                    <textarea wire:model.lazy="s_solution" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label>Precio:</label>
                    <input wire:model.lazy="s_price" type="number" class="form-control">
                </div>
                <div class="col-6">
                    <label>Técnico Responsable:</label>
                    @if($this->list_user_technicial)
                    <select wire:model="s_id_user_technicial" class="form-select">
                        @foreach($this->list_user_technicial as $ut)
                        <option value="{{$ut->id}}">{{$ut->name}}</option>
                        @endforeach
                    </select>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label>Costo:</label>
                    <input wire:model.lazy="s_cost" type="number" class="form-control">
                </div>
                <div class="col-8">
                    <label>Motivo Costo:</label>
                    <input wire:model.lazy="s_cost_detail" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button wire:click.prevent="terminated_service({{$this->id_service}})" type="button" class="btn bg-gradient-warning">Terminar Servicio</button>
          </div>
      </div>
    </div>
  </div>