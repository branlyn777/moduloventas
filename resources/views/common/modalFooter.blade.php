    </div>
    <div class="modal-footer">
      <button wire:click.prevent="resetUI()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
        @if ($selected_id < 1)
        <button wire:click.prevent="Store()" type="button" class="btn btn-primary">
            GUARDAR
        </button>
        @else
        <button type="button" wire:click.prevent="Update()" class="btn btn-primary">
            ACTUALIZAR
        </button>
        @endif
    </div>
  </div>
</div>
</div>