      </div>
      <div class="modal-footer">
          <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning close-btn text-info"
              data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
          @if ($selected_id < 1)
              <button type="button" wire:click.prevent="Store()"
                  class="btn btn-warning close-btn text-info">GUARDAR</button>
          @else
              <button type="button" wire:click.prevent="Update()"
                  class="btn btn-warning close-btn text-info">ACTUALIZAR</button>
          @endif


      </div>
      </div>
      </div>
      </div>
