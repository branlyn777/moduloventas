<div wire:ignore.self class="modal fade" id="deliverservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-sm" id="exampleModalLabel">ENTREGAR SERVICIO: {{$this->id_order_service}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
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
            <div class="row mb-3 mb-3">
                <div class="col-6">
                    <label>Precio Servicio:</label>
                    <input wire:model.lazy="s_price" type="number" class="form-control">
                    @error('s_price')
                        <span class="text-danger text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-6">
                    <label>Dejado a Cuenta:</label>
                    <input wire:model.lazy="s_on_account" type="number" class="form-control">
                    @error('s_on_account')
                        <span class="text-danger text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                @if(Auth::user()->hasPermissionTo('Boton_Entregar_Servicio'))
                    @if(!$this->box_status)
                        <div class="col-3"></div>
                        <div class="col-6 text-center">
                            <strong class="text-sm">No aperturo caja</strong>
                            <br>
                            <a href="{{ url('cortecajas') }}" class="btn text-primary" target="_blank">
                                Ir a Corte de Caja
                            </a>
                        </div>
                        <div class="col-3"></div>
                    @else
                        <div class="col-2"></div>
                        <div class="col-8 text-center">
                            <label>Tipo de Pago:</label>
                            <select wire:model="s_id_wallet" class="form-select">
                                @foreach($this->list_wallets as $w)
                                <option value="{{$w->id}}">{{$w->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2"></div>
                    @endif
                @else
                <div class="col-12 text-center">
                    <span class="text-sm">
                        No tienes permiso para entregar Servicios :(
                    </span>
                </div>
                @endif
            </div>
        </div>
        @if(Auth::user()->hasPermissionTo('Boton_Entregar_Servicio'))
            @if($this->box_status)
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button wire:click.prevent="deliver_service({{$this->id_service}})" type="button" class="btn bg-gradient-success">Entregar Servicio</button>
            </div>
            @endif
          @endif
      </div>
    </div>
  </div>